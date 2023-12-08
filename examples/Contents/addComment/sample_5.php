<?php
// add a comment to a text using WordFragments

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocx();

$textDocumentFragment = new WordFragment($docx, 'comment');
$textDocumentFragment->addText('custom comment', array('bold' => true, 'fontSize' => 14));
$textCommentFragment = new WordFragment($docx, 'comment');
$textCommentFragment->addText('The comment we want to insert.', array('bold' => true));

$comment = new WordFragment($docx, 'document');
$comment->addComment(
    array(
        'textDocument' => $textDocumentFragment,
        'textComment' => $textCommentFragment,
        'initials' => 'PT',
        'author' => 'PHPDocX Team',
        'date' => '10 September 2000'
    )
);

$text = array();
$text[] = array('text' => 'Here comes the ');
$text[] = $comment;
$text[] = array('text' => ' and some other text.');

$docx->addText($text);

$docx->createDocx('example_addComment_5');