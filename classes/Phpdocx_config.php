<?php
/**
 * phpdocx constants
 *
 * @category   Phpdocx
 * @package    config
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
// set default locale for numeric formats
setlocale(LC_NUMERIC, 'C');

// set error level
error_reporting(PhpdocxLogger::$errorReporting);

/**
 * The default base template folder
 */
define('PHPDOCX_BASE_FOLDER', dirname(__FILE__) . '/../templates/');
/**
 * The default base template
 * WARNING: if you choose to change this default template you should make sure
 * that certain required styles in createDocx for formatting are exported
 */
define('PHPDOCX_BASE_TEMPLATE', PHPDOCX_BASE_FOLDER . 'phpdocxBaseTemplate.docx');
/**
 * The default path to the dompdf dir
 */
define('PHPDOCX_DIR_DOMPDF', PHPDOCX_BASE_FOLDER . '/../pdf');
/**
 * The default path to the HTML parser
 */
define('PHPDOCX_DIR_PARSER', PHPDOCX_BASE_FOLDER . '/../lib/dompdfParser');
/**
 * The allowed file extensions for HTML2WordML conversion
 */
define('PHPDOCX_ALLOWED_IMAGE_EXT', 'gif,png,jpg,jpeg,bmp,svg');