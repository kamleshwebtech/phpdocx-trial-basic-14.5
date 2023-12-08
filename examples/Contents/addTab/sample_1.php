<?php
// add tabs in text contents

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

// add a tab using WordFragments
$textFragmentA = new WordFragment($docx);
$textFragmentA->addText('Text content using WordFragments:');

$tabFragment = new WordFragment($docx);
$tabFragment->addTab();

$textFragmentB = new WordFragment($docx);
$textFragmentB->addText('tab content.');

$contents = array();
$contents[] = $textFragmentA;
$contents[] = $tabFragment;
$contents[] = $textFragmentB;

$docx->addText($contents);

// the same can be done using the tab option included in addText
$text = array();
$text[] = array('text' => 'Text content using text array:');
$text[] = array('text' => 'tab content.', 'tab' => true);

$docx->addText($text);

$docx->createDocx('example_addTab_1');