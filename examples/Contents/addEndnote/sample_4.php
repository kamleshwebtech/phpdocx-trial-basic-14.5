<?php
// add an endnote using WordFragments

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$textDocumentFragment = new WordFragment($docx, 'endnote');
$textDocumentFragment->addText('custom endnote', array('bold' => true, 'fontSize' => 14));
$textEndnoteFragment = new WordFragment($docx, 'endnote');
$textEndnoteFragment->addText('The endnote we want to insert.', array('bold' => true));

$endnote = new WordFragment($docx, 'document');
$endnote->addEndnote(
    array(
        'textDocument' => $textDocumentFragment,
        'textEndnote' => $textEndnoteFragment,
    )
);

$text = array();
$text[] = array('text' => 'Here comes the ');
$text[] = $endnote;
$text[] = array('text' => ' and some other text.');

$docx->addText($text);
$docx->addText('Some other text.');

$docx->createDocx('example_addEndnote_4');