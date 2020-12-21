<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\Base\ArticleView;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\MultyLanguage;

class FormsController extends BaseController
{

    protected $article;
    protected $dnt;
    protected $frontend;

    public function __construct()
    {
		parent::__construct();
        $this->article = new ArticleView();
        $this->dnt = new Dnt();
        $this->frontend = new Frontend();
        $this->multiLanguage = new MultyLanguage();
    }

    public function run()
    {
        $id = $this->article->getStaticId();
        if ($id) {
            $data = $this->frontend->get();
            $data['dnt'] = $this->dnt;
            $data['multiLanguage'] = $this->multiLanguage;
            $this->modulConfigurator($data);
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}
