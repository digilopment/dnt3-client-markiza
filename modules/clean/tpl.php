<?php

use DntLibrary\Base\Frontend;

$data = Frontend::get();
//var_dump($data);

$postData = Frontend::getDeafult($data, "article");
if (dnt::not_html($postData['perex'])) {
    echo dnt::not_html($postData['perex']);
} else {
    echo $postData['content'];
}
?>