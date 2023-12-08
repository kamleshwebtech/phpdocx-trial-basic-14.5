<?php
// create and apply a custom list style using images as bullets

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

// custom options
$imageListOptions = array();
$imageListOptions[0]['type'] = 'bullet';
$imageListOptions[0]['image'] = array(
    'src' => '../../img/image.png',
    'height' => 200,
    'width' => 300,
);

// create the list style with name: imagec
$docx->createListStyle('imagec', $imageListOptions);

// list items
$myList = array('item 1', 'item 2', array('subitem 1', 'subitem 2'), 'item 3');

// insert the custom list into the Word document
$docx->addList($myList, 'imagec');

$docx->createDocx('example_createListStyle_5');