<?php

/**
 * Create DOCX from WordML
 *
 * @category   Phpdocx
 * @package    elements
 * @package    transform
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
class EmbedWordML extends CreateElement implements EmbedDocument
{
    /**
     *
     * @access private
     * @var int
     */
    private $_id = 0;

    /**
     *
     * @access private
     * @var mixed
     */
    private static $_instance = NULL;

    /**
     *
     * @access protected
     * @var string
     */
    protected $_xml = '';

    /**
     * Construct
     *
     * @access public
     */
    public function __construct()
    {

    }

    /**
     * Destruct
     *
     * @access public
     */
    public function __destruct()
    {

    }

    /**
     * Magic method, returns current XML
     *
     * @access public
     * @return string Return current XML
     */
    public function __toString()
    {
        return $this->_xml;
    }

    /**
     * Singleton, return instance of class
     *
     * @access public
     * @return EmbedWordML
     * @static
     */
    public static function getInstance()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new EmbedWordML();
        }
        return self::$_instance;
    }

    /**
     * Getter. Return current WordML ID
     *
     * @access public
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Embed WordML in DOCX
     *
     * @access public
     */
    public function embed($matchSource = false)
    {
        $this->_xml = '';
        $this->_id++;
        $this->generateALTCHUNK();
    }

    /**
     * Generate w:altChunk
     *
     * @access protected
     */
    public function generateALTCHUNK($matchSource = false)
    {
        $this->_xml = '<' . CreateElement::NAMESPACEWORD .
                ':altChunk r:id="rWMLId' . $this->_id . '" ' .
                'xmlns:r="http://schemas.openxmlformats.org/' .
                'officeDocument/2006/relationships" ' .
                'xmlns:w="http://schemas.openxmlformats.org/' .
                'wordprocessingml/2006/main" />';
    }

}
