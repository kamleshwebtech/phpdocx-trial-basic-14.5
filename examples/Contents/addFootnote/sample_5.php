<?php
// add a footnote with styles

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$textFootnoteFragment = new WordFragment($docx, 'footnote');
$textFootnoteFragment->addText(' The footnote to insert.');

$footnote = new WordFragment($docx, 'document');
$footnote->addFootnote(
    array(
        'textDocument' => 'footnote',
        'textFootnote' => $textFootnoteFragment,
        'footnoteMark' => array(
            'bold' => true,
            'color' => 'FF0000',
            'underline' => 'single',
            'fontSize' => 14,
        ),
        'referenceMark' => array(
            'bold' => true,
            'color' => '0000FF',
            'backgroundColor' => 'FFB703',
            'underline' => 'single',
            'fontSize' => 12,
        ),
    )
);

$text = array();
$text[] = array('text' => 'Here comes the ');
$text[] = $footnote;
$text[] = array('text' => ' and some other text.');

$docx->addText($text);
$docx->addText('Some other text.');

// set a new footnote format
$docx->modifyPageLayout('custom', array('footnotes' => array('numFmt' => 'lowerLetter')));

$docx->createDocx('example_addFootnote_5');