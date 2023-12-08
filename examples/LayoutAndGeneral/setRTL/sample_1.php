<?php
// add RTL contents

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$docx->setDefaultFont('Times New Roman');
$docx->setRTL();
$docx->addText('טקסט פשוט בעברית.');
$docx->addFootnote(
    array(
        'textDocument' => array('text' => 'הערת שוליים פשוט בעברית.'),
        'textFootnote' => 'את הטקסט של הערת השוליים.'
    )
);
$docx->addText('نص بسيط في اللغة العربية.');
$docx->addFootnote(
    array(
        'textDocument' => array('text' => 'حاشية باللغة العربية.'),
        'textFootnote' => 'نص الحاشية السفلية.'
    )
);
$valuesTable = array(
    array(
        'עמודת טקסט בעברית',
        'العمود النص العربي'
    ),
    array(
        'זהו טקסט התוכן הסלולרי',
				'هذا هو مضمون النص الخلية'
    )
);

$widthTableCols = array(
    2500,
    3000
);

$paramsTable = array(
    'TBLSTYLEval' => 'MediumShading1PHPDOCX',
    'size_col' => $widthTableCols
);

$docx->addTable($valuesTable, $paramsTable);

$docx->embedHTML('<p style="direction: rtl;">עכשיו סעיף ה-HTML פשוט מאוד.</p><p style="direction: rtl;">والفقرة HTML أخرى في اللغة العربية.</p>');

$docx->createDocx('example_setRTL_1');