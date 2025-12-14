<?php

namespace DntJobs;

use DntLibrary\App\Render;
use DntLibrary\Base\Settings;

class DatacruitJob
{

    const SERVICE = 'https://api.datacruit.com/advertising/jobAds';
    const SERVICE_DETAIL = 'https://private-anon-b3b79791f0-datacruitatsapi.apiary-proxy.com/advertising/jobAds/';
    const DEFAULT_IMAGE = 'https://static.markiza.sk/a501/image/file/1/1409/xSqc.jpg';
    const PROFESIA_URL = 'https://www.profesia.sk/send_cv.php?offer_id=';
    const STATIC_FILE = 'data/datacruit.json';

    protected Settings $settings;
    protected $error;
    protected $responseCode;
    protected array $jobCategories;
    protected array $images;
    protected array $jobsConfig;
    protected array $cleanImages;
    protected array $rawData;
    protected array $data;
    protected array $response;
    protected string $str;
    protected array $cleanCategories;
    protected array $extendedData;

    public function __construct()
    {
        $this->settings = new Settings();
    }

    protected function beforeInit()
    {
        $this->error = false;
        $this->responseCode = false;
        $this->jobCategories = [];
        $this->images = [];
        $this->jobsConfig = [];
        $this->cleanImages = [];
        $this->rawData = [];
        $this->data = [];
        $this->response = [];
    }

    protected function customConfig()
    {
        $this->jobsConfig = [
            'Brand Manager' => [
                'img' => 'https://static.markiza.sk/a501/image/file/2/1839/aElv.pozicia_bm_jpg.jpg',
                'cat' => 'default',
                'pId' => 4177907,
            ],
            '2D a 3D motion grafický dizajnér' => [
                'img' => 'https://static.markiza.sk/a501/image/file/2/1844/Q5um.2da3dmotiongrafickydizajner_jpg.jpg',
                'cat' => 'default',
                //'pId' => 4178322,
            ],
			'Koordinátor reklamných spotov' => [
                'img' => 'https://static.markiza.sk/a501/image/file/2/1846/7xyH.pozicia_koordinator_reklamnych_spotov_2_jpg.jpg',
                'cat' => 'default',
                //'pId' => 4188160,
            ],
        ];

        $this->jobCategories = [
            'staz' => 'Stáž',
            'default' => 'Ponuky práce',
        ];
    }

    protected function jobPositionImages()
    {

        $images = [];
        foreach ($this->jobsConfig as $jobTitle => $job) {
            $images[$jobTitle] = $job['img'];
            $imagesIndex[] = $job['img'];
        }
        $this->images = $images;

        $cleanImages = [];
        $i = 0;
        foreach (array_keys($this->images) as $image) {
            $cleanImages[$this->clean($image)] = $imagesIndex[$i];
            $i++;
        }
        $this->cleanImages = $cleanImages;
    }

    protected function jobCategories()
    {
        $cleanCategories = [];
        foreach (array_keys($this->jobCategories) as $category) {
            $cleanCategories[] = $this->clean($category);
        }
        $this->cleanCategories = $cleanCategories;
    }

    protected function nameUrl($str)
    {
        $this->str = $str;
        $this->str = preg_replace('/[^\pL0-9_]+/u', '-', $this->str);
        $this->str = trim($this->str, '-');
        $this->str = @iconv('utf-8', 'ASCII//TRANSLIT', $this->str);
        $this->str = strtolower($this->str);
        $this->str = preg_replace('/[^-a-z0-9_]+/', '', $this->str);
        return $this->str;
    }

    protected function clean($str)
    {
        return str_replace('-', '', $this->nameUrl($str));
    }

    protected function inString($pharse, $str)
    {
        return preg_match('/' . $pharse . '/', $str);
    }

    protected function request($id = false)
    {
        $login = $this->settings->getGlobals()->vendor['datacruitLogin'];
        $password = $this->settings->getGlobals()->vendor['datacruitPassword'];

        $curl = curl_init();

        if ($id) {
            $service = self::SERVICE_DETAIL . $id;
        } else {
            $service = self::SERVICE;
        }

        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $service,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => "$login:$password"
        ));

        $response = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);

        $rawData = [];
        if (($error != '') || ($responseCode != '200')) {
            $rawData['error'] = [
                $responseCode,
                $error
            ];
            $this->rawData = $rawData;
            $this->error = true;
            return;
        }
        if ($id) {
            return json_decode($response);
        }
        $this->responseCode = $responseCode;
        $this->rawData = json_decode($response);
    }

    protected function setImage($position)
    {
        if (in_array($this->clean($position->title), array_keys($this->cleanImages))) {
            return $this->cleanImages[$this->clean($position->title)];
        }
        return self::DEFAULT_IMAGE;
    }

    protected function setCategory($position)
    {

        foreach ($this->jobCategories as $categorySearchString => $categoryName) {
            if ($this->inString($categorySearchString, $this->clean($position->title))) {
                return $categorySearchString;
            }
        }

        foreach ($this->jobsConfig as $jobName => $jobData) {
            if (isset($jobData['cat']) && $this->clean($jobData['cat'])) {
                if ($this->clean($jobName) == $this->clean($position->title)) {
                    if (in_array($jobData['cat'], array_keys($this->jobCategories))) {
                        return $jobData['cat'];
                    }
                }
            }
        }
        return 'default';
    }

    protected function setProfesiaId($position)
    {

        foreach ($this->jobsConfig as $jobName => $jobData) {
            if (isset($jobData['pId']) && !empty($jobData['pId'])) {
                if ($this->clean($jobName) == $this->clean($position->title)) {
                    return $jobData['pId'];
                }
            }
        }
        return null;
    }

    protected function setProfesiaFormUrl($id)
    {
        if ($id) {
            return self::PROFESIA_URL . $id;
        }
        return null;
    }

    protected function setLanguage($languageId)
    {
        return match ($languageId) {
            9 => 'Angličtina',
            5 => 'Čeština',
            7 => 'Nemčina',
            14 => 'Maďarčina',
            10 => 'Španielčina',
            27 => 'Slovenčina',
            default => ''
        };
    }

    protected function setLanguageLevel($languageId)
    {
        return match ($languageId) {
            1 => 'A1',
            2 => 'A2',
            3 => 'B1',
            4 => 'B2',
            5 => 'C1',
            6 => 'C2',
            8 => 'rodný',
            default => ''
        };
    }

    protected function setEducation($educationId)
    {
        return match ($educationId) {
            1 => 'nižšie sekundárne vzdelanie',
            2 => 'stredné odborné vzdelanie s výučným listom',
            3 => 'úplné stredné odborné vzdelanie s maturitou',
            4 => 'postsekundárne vzdelanie',
            5 => 'vysokoškolské vzdelanie I. stupeň - bakalárske',
            10 => 'vysokoškolské vzdelanie II. stupeň',
            12 => 'vysokoškolské vzdelanie II. stupeň - postgraduálne',
            13 => 'vysokoškolské vzdelanie III. stupeň - doktorandské',
            default => ''
        };
    }

    protected function languages($languages)
    {
        $final = [];
        foreach ($languages as $language) {
            $final[] = $this->setLanguage($language);
        }
        return $final;
    }

    protected function formatDatetime($datetime)
    {
        $entryDate = date($datetime);
        return date('d.m.Y H:i', strtotime($entryDate));
    }

    protected function loadExtendData()
    {
        $this->extendedData = [];
        foreach ($this->rawData as $key => $val) {
            $this->extendedData[$val->id] = $this->request($val->id);
        }
    }

    protected function extendedData($val, $obj)
    {
        if (isset($this->extendedData[$val->id]->{$obj})) {
            return $this->extendedData[$val->id]->{$obj};
        }
        return $val->{$obj};
    }

    protected function setData()
    {
        $final = [];
        if (!$this->error) {
            foreach ($this->rawData as $key => $val) {
                $final[$key]['id'] = $val->id;
                $final[$key]['title'] = $val->title;
                $final[$key]['nameUrl'] = $this->nameUrl($val->title);
                $final[$key]['descriptionShort'] = $val->descriptionShort;
                $final[$key]['description'] = $val->description;
                $final[$key]['department'] = $val->clientName;
                $final[$key]['companyBranchName'] = $val->companyBranchName;
                $final[$key]['workTypes'] = $val->workTypes;
                $final[$key]['region'] = $val->region;
                $final[$key]['salary'] = $val->salary;
                $final[$key]['salaryNote'] = $val->salaryNote;
                $final[$key]['dateCreated'] = $val->dateCreated;
                $final[$key]['dateCreatedFormated'] = $this->formatDatetime($val->dateCreated);
                $final[$key]['image'] = $this->setImage($val);
                $final[$key]['education'] = $this->setEducation($val->education);
                $final[$key]['category'] = $this->setCategory($val);
                $profesiaId = $this->setProfesiaId($val);
                $final[$key]['profesiaOfferId'] = $profesiaId;
                $final[$key]['profesiaFormUrl'] = $this->setProfesiaFormUrl($profesiaId);
                $final[$key]['requirements'] = $this->extendedData($val, 'requirements');
                $final[$key]['contactFullname'] = $this->extendedData($val, 'contactFullname');
                $final[$key]['contactEmail'] = $this->extendedData($val, 'contactEmail');
                $final[$key]['brandImageURL'] = $this->extendedData($val, 'brandImageURL');
                $final[$key]['brandFacebookImageURL'] = $this->extendedData($val, 'brandFacebookImageURL');
                $final[$key]['brandLinkedInImageURL'] = $this->extendedData($val, 'brandLinkedInImageURL');
                $final[$key]['languages'] = $this->languages($this->extendedData($val, 'languages'));
            }
        }
        $this->data = $final;
    }

    protected function response()
    {
        $this->response['responseCode'] = $this->responseCode;
        $this->response['categories'] = $this->jobCategories;
        $this->response['positions'] = $this->data;
    }

    protected function writeToFile($json)
    {
        if (!$this->error) {
            file_put_contents(self::STATIC_FILE, $json);
            return new Render($json);
        }
        return new Render($json);
    }

    public function renderWithJson()
    {
        $this->writeToFile(json_encode($this->response))->renderWithJson();
    }

    public function renderWithDump()
    {
        var_dump($this->response, true);
    }

    public function init()
    {
        $this->customConfig();
        $this->jobPositionImages();
        $this->jobCategories();
        $this->request();
        $this->loadExtendData();
        $this->setData();
        $this->response();
    }

    public function run()
    {
        $this->beforeInit();
        $this->init();
        $this->renderWithJson();
    }

}
