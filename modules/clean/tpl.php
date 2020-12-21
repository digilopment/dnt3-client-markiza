<?php

use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;

$dnt = new Dnt();
$frontend = new Frontend();
$data = $frontend->get();

$postData = $frontend->getDeafult($data, "article");
if ($dnt->not_html($postData['perex'])) {
    echo $dnt->not_html($postData['perex']);
} else {
    echo $postData['content'];
}
?>