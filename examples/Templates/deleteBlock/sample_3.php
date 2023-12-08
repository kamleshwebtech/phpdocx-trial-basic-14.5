<?php
// delete an inline block content from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateBlocks_4.docx');

$docx->deleteBlock('INTERNAL', 'inline');

$docx->createDocx('example_deleteBlock_3');