<?php
// add form elements: textfield, checkbox and select

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

// add a Text field
$textFieldOptions = array(
	'fontSize' => 12,
	'italic' => true,
	'color' => '0000CC',
	'bold' => true,
	'font' => 'Arial',
	'defaultValue' => 'This is a test'
);
$docx->addFormElement('textfield', $textFieldOptions);

// add a Checkbox
$checkboxOptions = array('fontSize' => 12, 	'defaultValue' => true);
$docx->addFormElement('checkbox', $checkboxOptions);

// add a Select
$selectOptions = array(
	'selectOptions' => array('One', 'Two (selected)', 'Three', 'Four'),
	'fontSize' => 14,
	'color' => 'C90000',
	'bold' => true,
	'underline' => 'double',
	'font' => 'Algerian',
	'defaultValue' => 1
);
$docx->addFormElement('select', $selectOptions);

$docx->createDocx('example_addFormElement_1');