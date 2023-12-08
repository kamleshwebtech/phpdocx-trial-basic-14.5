<?php
// replace image variables (placeholders) in headers from an existing DOCX using an image resource. The placeholder has been added to the alt text content

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/placeholderImage.docx');

$imageResource = imagecreatefromjpeg('../../img/image.jpg');
$image_1 = array(
    'height' => '1',
    'resourceMode' => true,
    'width' => '1',
    'target' => 'header',
);

$docx->replacePlaceholderImage('HEADERIMG', $imageResource, $image_1);

$docx->createDocx('example_replacePlaceholderImage_6');