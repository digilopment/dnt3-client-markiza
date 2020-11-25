<?php

namespace DntJobs;

use DntLibrary\Base\Dnt;

class PrepareNlJob
{
   public function __construct(){
	   $this->dnt = new Dnt;
   }
    public function run()
    {
        $content = file_get_contents('https://www.newsletter.coloria.sk/voyo-mim/');
		$content = $this->dnt->minify($content);
		/*$content = str_replace('<meta name="viewport" content="width=device-width, initial-scale=1.0">', '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">', $content);
		$content = str_replace('800px', '100%', $content);
		$content = str_replace('800', '100%', $content);
		$content = str_replace('500', '100%', $content);
		$content = str_replace('500', '100%', $content);
		$content = str_replace('height="300"', 'height=""', $content);
		$content = str_replace('height="100"', 'height=""', $content);
		$content = str_replace('<td align="center" valign="top" >', '<td align="center" valign="top" style="padding:0px">', $content);
		$content = str_replace('style="background: #fff; max-width:100%"', 'style="background: #fff;max-width:100%;padding: 20px;max-width:800px"', $content);
		$content = str_replace('style="padding: 0 0 60px 0;', 'style="padding: 0 0 0px 0;', $content);*/
		
		//neww
		$content = str_replace('padding: 25px', 'padding: 18px', $content);
		//$content = str_replace('max-width: 100%;', 'max-width: 800px;', $content);
		file_put_contents('../dnt-view/data/uploads/39_b8c437758b685079e0ef41b8a87cf1cf_o.html', $content);
		echo $content;
    }

}
