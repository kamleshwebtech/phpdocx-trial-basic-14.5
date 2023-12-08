<?php
// add an image using an image resource

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$imageResource = imagecreatefromjpeg('../../img/image.jpg');
$options = array(
    'src' => $imageResource,
    'resourceMode' => true,
);

$docx->addImage($options);

$docx->createDocx('example_addImage_7');