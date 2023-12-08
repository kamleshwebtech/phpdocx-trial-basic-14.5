<?php
// replace table variables (placeholders) from an existing DOCX using WordFragments

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateComplexTable.docx');
$docx->setTemplateSymbol('@');

$link1 = new WordFragment($docx);
$linkOptions = array('url'=> 'http://www.google.com',
    'color' => '0000FF',
    'underline' => 'single',
);
$link1->addLink('link to product A', $linkOptions);

$link2 = new WordFragment($docx);
$linkOptions = array('url'=> 'http://www.google.com',
    'color' => '0000FF',
    'underline' => 'single',
);
$link2->addLink('link to product B', $linkOptions);

$link3 = new WordFragment($docx);
$linkOptions = array('url'=> 'http://www.google.com',
    'color' => '0000FF',
    'underline' => 'single',
);
$link3->addLink('link to product C', $linkOptions);

$image = new WordFragment($docx);
$imageOptions = array(
    'src' => '../../img/image.png',
    'scaling' => 50,
    );
$image->addImage($imageOptions);

$data = array(
	        array(
	            'ITEM' => $link1,
	            'REFERENCE' => $image,
	            'PRICE' => '5.45'
	        ),
	        array(
	            'ITEM' => $link2,
	            'REFERENCE' => $image,
	            'PRICE' => '30.12'
	        ),
	        array(
	            'ITEM' => $link3,
	            'REFERENCE' => $image,
	            'PRICE' => '7.00'
	        )
        );

$docx->replaceTableVariable($data);

$docx->createDocx('example_replaceTableVariable_3');