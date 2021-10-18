<?php

namespace DntJobs;

use DntLibrary\App\Render;
use DntLibrary\Base\Settings;

class DatacruitJob
{

    const SERVICE = 'https://api.datacruit.com/advertising/jobAds';
    const DEFAULT_IMAGE = 'https://static.markiza.sk/a501/image/file/1/1409/xSqc.jpg';
    const PROFESIA_URL = 'https://www.profesia.sk/send_cv.php?offer_id=';
    const STATIC_FILE = 'data/datacruit.json';

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
                'pId' => 4178322,
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

    protected function clean($str)
    {
        $this->str = $str;
        $this->str = preg_replace('/[^\pL0-9_]+/u', '-', $this->str);
        $this->str = trim($this->str, '-');
        $this->str = @iconv('utf-8', 'ASCII//TRANSLIT', $this->str);
        $this->str = strtolower($this->str);
        $this->str = preg_replace('/[^-a-z0-9_]+/', '', $this->str);
        $this->str = str_replace('-', '', $this->str);
        return $this->str;
    }

    protected function inString($pharse, $str)
    {
        return preg_match('/' . $pharse . '/', $str);
    }

    protected function request()
    {
        $login = $this->settings->getGlobals()->vendor['datacruitLogin'];
        $password = $this->settings->getGlobals()->vendor['datacruitPassword'];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::SERVICE,
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_USERPWD => "$login:$password"
        ));

        $response = curl_exec($curl);
        $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

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

    protected function formatDatetime($datetime)
    {
        $entryDate = date($datetime);
        return date('d.m.Y H:i', strtotime($entryDate));
    }

    protected function setData()
    {
        $final = [];
        if (!$this->error) {
            foreach ($this->rawData as $key => $val) {
                $final[$key]['id'] = $val->id;
                $final[$key]['title'] = $val->title;
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
                $final[$key]['category'] = $this->setCategory($val);
                $profesiaId = $this->setProfesiaId($val);
                $final[$key]['profesiaOfferId'] = $profesiaId;
                $final[$key]['profesiaFormUrl'] = $this->setProfesiaFormUrl($profesiaId);
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
