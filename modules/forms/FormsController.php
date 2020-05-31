<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\Base\ArticleView;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;

class FormsController extends BaseController
{

    protected $article;
    protected $dnt;
    protected $frontend;

    public function __construct()
    {
        $this->article = new ArticleView();
        $this->dnt = new Dnt();
        $this->frontend = new Frontend();
    }

    public function run()
    {
        $id = $this->article->getStaticId();
        if ($id) {
            $data = $this->frontend->get();
            $this->modulConfigurator($data);
        } else {
            $this->dnt->redirect(WWW_PATH . '404');
        }
    }

}
