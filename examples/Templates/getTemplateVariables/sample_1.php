<?php
// return the variables (placeholders) from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateVariables.docx');

print_r($docx->getTemplateVariables());