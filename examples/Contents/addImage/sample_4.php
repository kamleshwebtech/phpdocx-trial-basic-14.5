<?php
// add an image using a stream source

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$options = array(
    'src' => 'http://www.2mdc.com/PHPDOCX/logo_badge.png',
    'imageAlign' => 'center',
    'streamMode' => true,
);

$docx->addImage($options);

$docx->createDocx('example_addImage_4');