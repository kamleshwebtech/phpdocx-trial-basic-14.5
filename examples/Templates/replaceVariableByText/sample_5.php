<?php
// replace text variables (placeholders) with new text from an existing DOCX. Using the parse mode.
// The parse mode is slower than the default one, but it's more accurate when the template includes placeholder symbols as regular contents

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateSimpleText.docx', array('parseMode' => true));

$first = 'PHPDocX';
$multiline = 'This is the first line.\nThis is the second line of text.';

$variables = array('FIRSTTEXT' => $first, 'MULTILINETEXT' => $multiline);
// replace \n with line breaks
$options = array('parseLineBreaks' => true);

$docx->replaceVariableByText($variables, $options);

$docx->createDocx('example_replaceVariableByText_5');