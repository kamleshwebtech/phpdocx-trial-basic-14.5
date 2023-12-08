<?php
// delete a block content from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateBlocks.docx');

$docx->deleteBlock('FIRST');

$docx->createDocx('example_deleteBlock_1');