<?php
// replace text variables (placeholders) with HTML from an existing DOCX

require_once '../../../classes/CreateDocx.php';

$docx = new CreateDocxFromTemplate('../../files/TemplateHTML.docx');

$htmlSample = '
<style>
    strong {
        color: #ea5a28;
    }
</style>
<div>
<div>
    <p>At 2mdc we specialize in <strong>Rich Internet Applications</strong>. We cover the entire life process of any project, from web and <strong>graphic design</strong>, respecting the corporative image of each company, to content and text edition and <strong>multimedia</strong>, creating <strong>e-learning</strong> courses, <strong>system management</strong> and <strong>consulting</strong> on the final and operative site.</p>
    <p>We work with "scripting" languages (PHP, JSP and ASP), <strong>databases</strong> (MySQL, PostgreSQL and Oracle) and <strong>operating systems</strong> (Linux, Windows Server). We design <strong>interfaces</strong> (Front-end and Back-end) in HTML5 with multiple integrations: Google Maps, Web Services, Multimedia Flash, QuickTime Video, and so on...</p>
    <p>We have several <strong>web servers</strong> available in Spain (Hostalia), UK (RackSpace), and USA (Amazon and Google) high performance and high volume transfer.</p>
    <p>Our team is specialist in every project step. We are:
        </p><div class="cube-line mbt mt">
            <ul>
                <li><strong>Programmers</strong>, experts in web development and software, mash-ups and data management.</li>
                <li><strong>Designers</strong>, able to give shape and color to a project vision and mission.</li>
                <li><strong>System administrators</strong>, in charge of efficiently manage the performance and safety of a project.</li>
                <li><strong>Content managers</strong>, versed in composing and updating data and words of a website.</li>
                <li><strong>Analysts</strong>, trained in management, positioning, IT, and other consulting fields.</li>
            </ul>
        </div>
    <p></p>
    <p>At 2mdc we are committed to producing an effective, efficient and high quality development. Our priorities are: <strong>usability, accessibility, indexability and updating</strong>, because every website is a living project.</p>
    <p>We want our name to be the best reference, and the results to speak for themselves. For its educational, innovative quality, Macromedia honored our own web project <a href="http://www.autoescuela.tv" target="_blank">www.autoescuela.tv</a>, with the prestigious <em>e-learning innovation award</em>. It was the first project made in Spain to receive it.</p>
</div>
</div>';

// do an inline replacement
$docx->replaceVariableByHTML('ADDRESS', 'inline', '<p style="font-family: verdana; font-size: 11px">phpdocx by <b>2mdc</b></p>');
// do a block replacement
$docx->replaceVariableByHTML('CHUNK_1', 'block', $htmlSample);

$htmlSample = '<h1 style="color: #b70000">An embedHTML() example</h1>
  <p>We draw a table with border and rawspans and colspans:</p>
  <table border="1" style="border-collapse: collapse" width="200">
    <tbody>
        <tr>
            <td style="background-color: yellow">1_1</td>
            <td rowspan="3" colspan="2">1_2</td>
        </tr>
        <tr>
            <td>Some random text.</td>
        </tr>
        <tr>
            <td>
                <ul>
                    <li>One</li>
                    <li>Two <b>and a half</b></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td>3_2</td>
            <td>3_3</td>
            <td>3_3</td>
        </tr>
    </tbody>
  </table>';

// do a block replacement
$docx->replaceVariableByHTML('CHUNK_2', 'block', $htmlSample);

$docx->createDocx('example_replaceTemplateVariableByHTML_1');