<?php
// change the symbol used to wrap blocks and delete MYBLOCK_1 from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateBlocksCustomSymbol.docx');

$docx->setTemplateBlockSymbol('MYBLOCK');

$docx->deleteTemplateBlock('1');

$docx->createDocx('example_setTemplateBlockSymbol_1');