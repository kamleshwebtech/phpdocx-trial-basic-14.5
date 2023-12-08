<?php
// add multiple footnotes

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$footnote = new WordFragment($docx, 'document');

$footnote->addFootnote(
    array(
        'textDocument' => 'footnote',
        'textFootnotes' => array(
            array(
                'textFootnote'=> ' The footnote we want to insert.',
            ),
            array(
                'textFootnote'=> ' The 2nd footnote we want to insert.',
            ),
        )
    )
);

$text = array();
$text[] = array('text' => 'Here comes the ');
$text[] = $footnote;
$text[] = array('text' => ' and some other text.');

$docx->addText($text);
$docx->addText('Some other text.');

$docx->createDocx('example_addFootnote_3');