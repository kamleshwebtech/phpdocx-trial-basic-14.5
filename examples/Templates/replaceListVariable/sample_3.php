<?php
// replace list variables (placeholders) in headers, footers and document from an existing DOCX using WordFragments

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateList_header_footer.docx');

$link = new WordFragment($docx);
$linkOptions = array('url'=> 'http://www.google.com',
    'color' => '0000FF',
    'underline' => 'single',
);
$link->addLink('link to Google', $linkOptions);

$image = new WordFragment($docx);
$imageOptions = array(
    'src' => '../../img/image.png',
    'scaling' => 50,
    );
$image->addImage($imageOptions);

$text = new WordFragment($docx);
$textOptions = array(
    'bold' => true,
    );
$text->addText('Lorem ipsum', $textOptions);

$itemsHeader = array($link, $image, $text);
$itemsBody = array('First item', 'Second item', 'Third item');
$itemsFooter = array($image, $text, $link);

// replace the list variable in headers
$docx->replaceListVariable('LISTVAR_HEADER', $itemsHeader, array('target' => 'header'));
// replace the list variable in the document
$docx->replaceListVariable('LISTVAR_BODY', $itemsBody);
// replace the list variable in footers
$docx->replaceListVariable('LISTVAR_FOOTER', $itemsFooter, array('target' => 'footer'));

$docx->createDocx('example_replaceListVariable_3');