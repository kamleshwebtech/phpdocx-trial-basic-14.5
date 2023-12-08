<?php

/**
 * Handle temp directory
 *
 * @category   Phpdocx
 * @package    utilities
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
class TempDir
{
    /**
     * Return temp dir
     *
     * @access public
     * @return string
     * @static
     */
    public static function getTempDir()
    {
        $phpdocxconfig = PhpdocxUtilities::parseConfig();

        if (isset($phpdocxconfig['settings']['temp_path']) && !empty($phpdocxconfig['settings']['temp_path'])) {
            $tempPath = $phpdocxconfig['settings']['temp_path'];
        } else {
            $tempPath = sys_get_temp_dir();
        }

        return $tempPath;
    }
}