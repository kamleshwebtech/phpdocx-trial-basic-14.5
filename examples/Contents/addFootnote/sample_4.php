<?php
// add a footnote using WordFragments

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$textDocumentFragment = new WordFragment($docx, 'footnote');
$textDocumentFragment->addText('custom footnote', array('bold' => true, 'fontSize' => 14));
$textFootnoteFragment = new WordFragment($docx, 'footnote');
$textFootnoteFragment->addText('The footnote we want to insert.', array('bold' => true));

$footnote = new WordFragment($docx, 'document');
$footnote->addFootnote(
    array(
        'textDocument' => $textDocumentFragment,
        'textFootnote' => $textFootnoteFragment,
    )
);

$text = array();
$text[] = array('text' => 'Here comes the ');
$text[] = $footnote;
$text[] = array('text' => ' and some other text.');

$docx->addText($text);
$docx->addText('Some other text.');

$docx->createDocx('example_addFootnote_4');