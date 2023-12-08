<?php

/**
 * Logger
 *
 * @category   Phpdocx
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
class PhpdocxLogger
{
    /**
     * Error reporting config
     *
     * @var int
     */
    public static $errorReporting = E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED;

    /**
     *
     * @access private
     * @static
     * @var mixed
     */
    private static $_disableLogger = true;

    /**
     *
     * @access private
     * @static
     * @var mixed
     */
    private static $_log = NULL;

    /**
     * Singleton, return instance of class
     *
     * @access public
     * @param $message Message to send to logging framework
     * @param $level Allowed values: trace, debug, info, warn, error, fatal
     * @static
     * @throws Exception fatal level
     */
    public static function logger($message, $level)
    {
        $levels = array(
            'debug',
            'info',
            'notice',
            'warning',
            'error',
            'fatal',
        );

        // Exception if fatal level
        if ($level == 'fatal') {
            throw new Exception($message);
        }

        if (self::$_disableLogger === false) {
            // only some levels are valid
            if (in_array($level, $levels)) {
                $stringLevel = strtolower($level);
                if (self::$_log) {
                    self::$_log->$stringLevel($message);
                }
            }
        }
    }

    /**
     * Disable the logger.
     *
     * @access public
     * @static
     */
    public static function disableLogger()
    {
        self::$_disableLogger = true;
    }

    /**
     * Enable the logger.
     *
     * @access public
     * @static
     */
    public static function enableLogger()
    {
        self::$_disableLogger = false;
    }

    /**
     * Set a custom logger. It must follow the PSR3 messages.
     *
     * @access public
     * @param mixed $logger Custom logger
     * @static
     */
    public static function setLogger($logger)
    {
        self::$_log = $logger;
    }
}
