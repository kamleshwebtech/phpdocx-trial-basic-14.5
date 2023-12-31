<?php

/**
 * Create lists
 *
 * @category   Phpdocx
 * @package    elements
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
class CreateList extends CreateElement
{
    /**
     * Max depth
     */
    const MAXDEPTH = 8;

    /**
     *
     * @var mixed
     * @access public
     */
    public $list;

    /**
     *
     * @var array
     * @access public
     */
    public $val;

    /**
     *
     * @var string
     * @access public
     */
    public $font;

    /**
     *
     * @var array
     * @access public
     */
    public $data;

    /**
     * @access private
     * @var mixed
     * @static
     */
    private static $_instance = NULL;

    /**
     *
     * @access private
     * @var int
     * @static
     */
    private static $_numericList = -1;

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
     *
     * @access public
     * @return string
     */
    public function __toString()
    {
        $this->cleanTemplate();
        return $this->_xml;
    }

    /**
     *
     * @access public
     * @return CreateList
     * @static
     */
    public static function getInstance()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new CreateList();
        }
        return self::$_instance;
    }

    /**
     * Create list
     *
     * @access public
     */
    public function createList()
    {
        $this->_xml = '';
        $args = func_get_args();
        $this->list = '';
        if (!isset($args[1]['font'])) {
            $args[1]['font'] = '';
        }
        if ($args[1]['val'] == 2) {
            self::$_numericList++;
            $this->runArray(
                    $args[0], $args[1]['val'], 0, //before it was 1: changed
                    $args[1]
            );
        } else {
            $this->runArray($args[0], $args[1]['val'], 0, $args[1]);
        }

        $this->_xml = $this->list;
    }

    /**
     * Init list
     *
     * @access public
     */
    public function initList()
    {
        $args = func_get_args();
        $this->val = $args[0][1]['val'];
        $this->data = $args[0][0];
    }

    /**
     * Add list
     *
     * @param string $list
     * @access protected
     */
    protected function add2List($list)
    {
        $this->_xml = str_replace('__PHX=__GENERATER__', $list, $this->_xml);
    }

    /**
     * Generate w:ilfo
     *
     * @param int $val
     * @access protected
     */
    protected function generateILFO($val = 0)
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':ilfo ' . CreateElement::NAMESPACEWORD .
                ':val="' . $val .
                '"></' . CreateElement::NAMESPACEWORD .
                ':ilfo>';
        $this->_xml = str_replace('__PHX=__GENERATEILFO__', $xml, $this->_xml);
    }

    /**
     * Generate w:ilvl
     *
     * @param mixed $val
     * @access protected
     */
    protected function generateILVL($val = '')
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':ilvl ' . CreateElement::NAMESPACEWORD .
                ':val="' . $val . '"></' . CreateElement::NAMESPACEWORD .
                ':ilvl>__PHX=__GENERATEPSTYLE__';
        $this->_xml = str_replace('__PHX=__GENERATEPSTYLE__', $xml, $this->_xml);
    }

    /**
     * Generate w:ind
     *
     * @access protected
     */
    protected function generateIND($left = '720')
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':ind w:left="' . $left . '" w:hanging="360"/>';

        $this->_xml = str_replace('__PHX=__GENERATEIND__', $xml, $this->_xml);
    }

    /**
     * Generate w:listpr
     *
     * @access protected
     */
    protected function generateLISTPR()
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':listPr>__PHX=__GENERATEILVL____PHX=__GENERATEILFO__</' .
                CreateElement::NAMESPACEWORD . ':listPr>__PHX=__GENERATER__';
        $this->_xml = str_replace('__PHX=__GENERATER__', $xml, $this->_xml);
    }

    /**
     * Generate w:lvl
     *
     * @access protected
     */
    protected function generateLVL($current)
    {
        $this->_xml = '<' . CreateElement::NAMESPACEWORD . ':lvl
                w:ilvl="' . $current . '" w:tplc="0C0A0001">__PHX=__GENERATESTART__</' .
                CreateElement::NAMESPACEWORD . ':lvl>';
    }

    /**
     * Generate w:lvlJc
     *
     * @access protected
     */
    protected function generateLVLJC($align = 'left')
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':lvlJc w:val="'.$align.'"/>__PHX=__GENERATEPPRS__';

        $this->_xml = str_replace('__PHX=__GENERATELVLJC__', $xml, $this->_xml);
    }

    /**
     * Generate w:lvlText
     *
     * @access protected
     */
    protected function generateLVLTEXT($bullet = '')
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':lvlText w:val="' . $bullet . '"/>__PHX=__GENERATELVLJC__';

        $this->_xml = str_replace('__PHX=__GENERATELVLTEXT__', $xml, $this->_xml);
    }

    /**
     * Generate w:numFmt
     *
     * @access protected
     */
    protected function generateNUMFMT()
    {
        $xml = '<' . CreateElement::NAMESPACEWORD . ':numFmt ' .
                CreateElement::NAMESPACEWORD .
                ':val="bullet"/>__PHX=__GENERATELVLTEXT__';

        $this->_xml = str_replace('__PHX=__GENERATENUMFMT__', $xml, $this->_xml);
    }

    /**
     * Generate w:numid
     *
     * @param int $val
     * @param array $options
     * @access protected
     */
    protected function generateNUMID($val, $options = null)
    {
        if ($val === null) {
            $val = 1;
        }
        if ($val == 2) {
            $val = CreateDocx::$numOL;
        } else if ($val === 0) {
            $val = '';
        } else if ($val == 1) {
            $val = CreateDocx::$numUL;
        }

        // force a numID
        if ($options !== null && is_array($options) && isset($options['numId'])) {
            $val = $options['numId'];
        }

        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':numId ' . CreateElement::NAMESPACEWORD .
                ':val="' . $val . '"></' . CreateElement::NAMESPACEWORD .
                ':numId>';
        $this->_xml = str_replace('__PHX=__GENERATEPSTYLE__', $xml, $this->_xml);
    }

    /**
     * Generate w:numpr
     *
     * @access protected
     */
    protected function generateNUMPR()
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':numPr>__PHX=__GENERATEPSTYLE__</' . CreateElement::NAMESPACEWORD .
                ':numPr>';
        $this->_xml = str_replace('__PHX=__GENERATEPSTYLE__', $xml, $this->_xml);
    }

    /**
     * Generate w:outlineLvl
     *
     * @param mixed $val
     * @access protected
     */
    protected function generateOUTLINELVL($val = '0')
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':outlineLvl ' . CreateElement::NAMESPACEWORD . ':val="' . $val .
                '"/>__PHX=__GENERATEPSTYLE__';
        $this->_xml = str_replace('__PHX=__GENERATEPSTYLE__', $xml, $this->_xml);
    }

    /**
     * Generate w:ppr
     *
     * @access protected
     */
    protected function generatePPRS()
    {
        $xml = '<' . CreateElement::NAMESPACEWORD . ':pPr>__PHX=__GENERATEIND__</' .
                CreateElement::NAMESPACEWORD . ':pPr>__PHX=__GENERATRPR__';

        $this->_xml = str_replace('__PHX=__GENERATEPPRS__', $xml, $this->_xml);
    }

    /**
     * Generate w:pstyle
     *
     * @param string $val
     * @access protected
     */
    protected function generatePSTYLE($val = 'Textonotaalfinal')
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':pStyle ' . CreateElement::NAMESPACEWORD . ':val="' . $val .
                '"/>__PHX=__GENERATEPSTYLE__';
        $this->_xml = str_replace('__PHX=__GENERATEPPR__', $xml, $this->_xml);
    }

    /**
     * Generate w:rfonts
     *
     * @param string $font
     * @access protected
     */
    protected function generateRFONTSTYLE($font = 'Symbol')
    {
        $xml = '<' . CreateElement::NAMESPACEWORD .
                ':rFonts ' . CreateElement::NAMESPACEWORD .
                ':ascii="' . $font . '" ' . CreateElement::NAMESPACEWORD .
                ':hAnsi="' . $font . '" ' . CreateElement::NAMESPACEWORD .
                ':hint="default"/>';

        $this->_xml = str_replace('__PHX=__GENERATERFONTS__', $xml, $this->_xml);
    }

    /**
     * Generate w:rpr
     *
     * @access protected
     */
    protected function generateRPRS()
    {
        $xml = '<' . CreateElement::NAMESPACEWORD . ':rPr>__PHX=__GENERATERFONTS__</' .
                CreateElement::NAMESPACEWORD . ':rPr>';

        $this->_xml = str_replace('__PHX=__GENERATRPR__', $xml, $this->_xml);
    }

    /**
     * Recursive generation of lists
     *
     * @param array $dat
     * @param string $val
     * @param int $depth
     * @param array $options
     * @access protected
     */
    protected function runArray($dat, $val, $depth, $options = array())
    {
        foreach ($dat as $cont) {
            $valuesData = $cont;
            $styleData = $val;
            if (is_array($cont) && isset($cont['data'])) {
                // values with styles
                $valuesData = $cont['data'];
                if (isset($cont['style'])) {
                    $styleData = CreateDocx::$customLists[$cont['style']]['id'];
                }
            }

            if (is_array($valuesData)) {
                $newDepth = $depth + 1;
                $this->runArray($valuesData, $styleData, $newDepth, $options);
            } else {
                $this->generateP();
                $this->generatePPR();
                if (isset($options['pStyle'])) {
                    $this->generatePSTYLE($options['pStyle']);
                } elseif (isset($options['useWordFragmentStyles']) &&
                            $options['useWordFragmentStyles'] == true &&
                            $valuesData instanceof WordFragment) {
                    // get WordFragment style
                    $namespaces = 'xmlns:ve="http://schemas.openxmlformats.org/markup-compatibility/2006" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:m="http://schemas.openxmlformats.org/officeDocument/2006/math" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing" xmlns:w10="urn:schemas-microsoft-com:office:word" xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml" ';
                    $wordML = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?><w:root ' . $namespaces . '>' . (string)$cont . '</w:root>';
                    if (PHP_VERSION_ID < 80000) {
                        $optionEntityLoader = libxml_disable_entity_loader(true);
                    }
                    $simpleXMLCont = simplexml_load_string($wordML, null, 0, 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                    if (@isset($simpleXMLCont->p->pPr->pStyle[0]['val'])) {
                        $this->generatePSTYLE($simpleXMLCont->p->pPr->pStyle[0]['val']);
                    } else {
                        $this->generatePSTYLE($options['pStyle']);
                    }
                    if (PHP_VERSION_ID < 80000) {
                        libxml_disable_entity_loader($optionEntityLoader);
                    }
                } else {
                    $this->generatePSTYLE('ListParagraphPHPDOCX');
                }
                if (isset($options['outlineLvl'])) {
                    $this->generateOUTLINELVL((int)$options['outlineLvl']);
                }
                $this->generateNUMPR();
                //$this->generateLISTPR();
                $this->generateILFO();
                $this->generateILVL($depth);
                $this->generateNUMID($styleData, $options);
                if ($valuesData instanceof WordFragment) {
                    $runContent = $cont->inlineWordML();
                    $this->add2List((string) $runContent);
                    $this->list .= $this->_xml;
                } else {
                    if (count($options) == 1) {
                        $this->generateR();
                        $this->generateT($valuesData);

                        $this->list .= $this->_xml;
                    } else {
                        $wf = new WordFragment();
                        $wf->addText($valuesData, $options);
                        $runContent = $wf->inlineWordML();
                        $this->add2List((string) $runContent);
                        $this->list .= $this->_xml;
                    }
                }
            }
        }
    }

    /**
     * Generate w:start
     *
     * @access protected
     */
    protected function generateSTART($x = null, $y = null)
    {
        $xml = '<' . CreateElement::NAMESPACEWORD . ':start ' .
                CreateElement::NAMESPACEWORD . ':val="1"/>__PHX=__GENERATENUMFMT__';

        $this->_xml = str_replace('__PHX=__GENERATESTART__', $xml, $this->_xml);
    }

}
