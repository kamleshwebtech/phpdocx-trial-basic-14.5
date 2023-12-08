<?php
// add an endnote with styles

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$textEndnoteFragment = new WordFragment($docx, 'endnote');
$textEndnoteFragment->addText(' The endnote to insert.');

$endnote = new WordFragment($docx, 'document');
$endnote->addEndnote(
    array(
        'textDocument' => 'endnote',
        'textEndnote' => $textEndnoteFragment,
        'endnoteMark' => array(
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
$text[] = $endnote;
$text[] = array('text' => ' and some other text.');

$docx->addText($text);
$docx->addText('Some other text.');

// set a new endnote format
$docx->modifyPageLayout('custom', array('endnotes' => array('numFmt' => 'lowerLetter')));

$docx->createDocx('example_addEndnote_5');