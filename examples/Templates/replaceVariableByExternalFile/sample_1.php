<?php
// replace a text variable (placeholder) with an external file from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateExternalFile.docx');

$docx->replaceVariableByExternalFile(array('EXTERNAL' => '../../files/External.docx'), array('matchSource' => true));

$docx->createDocx('example_replaceVariableByExternalFile_1');