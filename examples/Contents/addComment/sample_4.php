<?php
// add multiple comments to a text

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$comment = new WordFragment($docx, 'document');

$comment->addComment(
    array(
        'textDocument' => 'comment',
        'textComments' => array(
            array(
                'textComment' => 'First comment.',
                'initials' => 'PT',
                'author' => 'PHPDocX Team',
                'date' => '10 September 2000',
            ),
            array(
                'textComment' => 'Second comment.',
                'initials' => 'OT',
                'author' => 'Other Team',
                'date' => '20 September 2021',
            ),
            array(
                'textComment' => 'New comment.',
                'initials' => 'NT',
                'author' => 'New Team',
                'date' => '20 October 2021',
            ),
        )
    )
);

$text = array();
$text[] = array('text' => 'Here comes the ');
$text[] = $comment;
$text[] = array('text' => ' and some other text.');

$docx->addText($text);

$docx->createDocx('example_addComment_4');