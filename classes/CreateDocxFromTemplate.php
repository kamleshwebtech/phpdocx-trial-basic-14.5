<?php

/**
 * Use an existing DOCX as the document template
 *
 * @category   Phpdocx
 * @package    create
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
class CreateDocxFromTemplate extends CreateDocx
{
    /**
     *
     * @access public
     * @var boolean
     */
    public $_parseMode = false;

    /**
     *
     * @access public
     * @var boolean
     */
    public $_preprocessed = false;

    /**
     *
     * @access public
     * @var mixed
     */
    public $_uniqueTemplateSymbol = true;

    /**
     *
     * @access public
     * @var mixed
     */
    public $_distinctTemplateSymbol = false;

    /**
     *
     * @access public
     * @var string
     */
    public $_templateSymbolStart = '$';

    /**
     *
     * @access public
     * @var string
     */
    public $_templateSymbolEnd = '$';

    /**
     *
     * @access public
     * @var mixed
     */
    public $_templateSymbolMergeFieldMode = false;

    /**
     *
     * @access public
     * @var string
     */
    public $_templateBlockSymbol = 'BLOCK_';

    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $regExprVariableParse = '(.*)';

    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $regExprVariableSymbols = '\$(?:\{|[^{$]*\>\{)[^}$]*\}';

    /**
     * Construct
     * @param mixed $docxTemplatePath path to the template to use or DOCXStructure
     * @param array $options
     * The available keys and values are:
     *  'baseTemplatePath' (string) set the base template path
     *  'parseMode' (bool) if true uses the parse mode to repair and get variables. Default value is false
     *  'preprocessed' (bool) if true the variables will not be 'repaired'. Default value is false
     * @access public
     * @throws Exception empty template
     */
    public function __construct($docxTemplatePath, $options = array())
    {
        $this->_preprocessed = false;
        $this->_parseMode = false;
        if (empty($docxTemplatePath)) {
            PhpdocxLogger::logger('The template path can not be empty', 'fatal');
        }
        $baseTemplatePath = PHPDOCX_BASE_TEMPLATE;
        if (isset($options['baseTemplatePath']) && !empty($options['baseTemplatePath'])) {
            $baseTemplatePath = $options['baseTemplatePath'];
        }
        parent::__construct($baseTemplatePath, $docxTemplatePath);
        if (isset($options['preprocessed']) && $options['preprocessed']) {
            $this->_preprocessed = true;
        }
        if (isset($options['parseMode']) && $options['parseMode']) {
            $this->_parseMode = true;
        }
        $this->xmlUtilities = new XmlUtilities();
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
     * Getter preprocessed
     *
     * @access public
     * @return bool
     */
    public function getPreprocessed()
    {
        return $this->_preprocessed;
    }

    /**
     * Setter preprocessed
     *
     * @access public
     * @param bool $preprocessed
     */
    public function setPreprocessed($preprocessed)
    {
        $this->_preprocessed = $preprocessed;
    }

    /**
     * Getter parseMode
     *
     * @access public
     * @return bool
     */
    public function getParseMode()
    {
        return $this->_parseMode;
    }

    /**
     * Setter parseMode
     *
     * @access public
     * @param bool $parseMode
     */
    public function setParseMode($parseMode)
    {
        $this->_parseMode = $parseMode;
    }

    /**
     * Getter. Return template symbol
     *
     * @access public
     * @return string|array
     */
    public function getTemplateSymbol()
    {
        if ($this->_templateSymbolStart == $this->_templateSymbolEnd && strlen($this->_templateSymbolStart) == 1) {
            return $this->_templateSymbolStart;
        } else {
            return array($this->_templateSymbolStart, $this->_templateSymbolEnd);
        }
    }

    /**
     * Setter. Set template symbol
     *
     * @access public
     * @param string $templateSymbolStart
     * @param string $templateSymbolEnd use $templateSymbolStart if null
     */
    public function setTemplateSymbol($templateSymbolStart = '$', $templateSymbolEnd = null)
    {
        // disable mergefield mode as default, if needed it's enabled in this same method
        $this->_templateSymbolMergeFieldMode = false;

        // normalize end symbols to keep the needed workflow
        if (is_null($templateSymbolEnd) && strlen($templateSymbolStart) > 1) {
            $templateSymbolEnd = $templateSymbolStart;
        }

        if (is_null($templateSymbolEnd)) {
            $this->_templateSymbolStart = $templateSymbolStart;
            $this->_templateSymbolEnd = $templateSymbolStart;
        } else {
            $this->_templateSymbolStart = $templateSymbolStart;
            $this->_templateSymbolEnd = $templateSymbolEnd;

            // generate a new CreateDocxFromTemplate::$regExprVariableSymbols automatically from the new placeholders
            if ($this->_templateSymbolStart == '${' && $this->_templateSymbolEnd == '}') {
                // default ${ }
                self::$regExprVariableSymbols = '\$(?:\{|[^{$]*\>\{)[^}$]*\}';
            } else {
                // new placeholder symbols
                $templateSymbolContents = $this->parseSymbolsTemplate();
                $templateSymbolContents = array_merge($templateSymbolContents['start'], $templateSymbolContents['end']);

                $templateSymbolContentQuoted = array();
                foreach ($templateSymbolContents as $templateSymbolContent) {
                    $templateSymbolContentQuoted[] = preg_quote($templateSymbolContent, '/');
                }
                $matchesPlaceholders = array();
                $templateSymbolXPathRegExpr = implode('(.*)', $templateSymbolContentQuoted);

                self::$regExprVariableSymbols = $templateSymbolXPathRegExpr;
            }
        }

        // mergefield mode
        if ($templateSymbolStart == 'mergefield') {
            $this->_templateSymbolStart = '«';
            $this->_templateSymbolEnd = '»';
            $this->_templateSymbolMergeFieldMode = true;
        }
    }

    /**
     * Getter. Return template block symbol
     *
     * @access public
     * @return string
     */
    public function getTemplateBlockSymbol()
    {
        return $this->_templateBlockSymbol;
    }

    /**
     * Setter. Set template symbol
     *
     * @access public
     * @param string $templateBlockSymbol
     */
    public function setTemplateBlockSymbol($templateBlockSymbol = 'BLOCK_')
    {
        $this->_templateBlockSymbol = $templateBlockSymbol;
    }

    /**
     * Clear all the placeholders variables which start with the block template symbol
     *
     * @access public
     */
    public function clearBlocks()
    {
        if (!$this->_preprocessed) {
            $variables = $this->getTemplateVariables();
            $this->processTemplate($variables);
        }

        $loadContent = $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>';
        $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);

        //Use XPath to find all paragraphs that include a BLOCK variable name
        $name = $this->_templateSymbolStart . $this->_templateBlockSymbol;
        $xpath = new DOMXPath($domDocument);
        $xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $query = '//w:p[w:r/w:t[text()[contains(.,"' . $name . '")]]]';
        $affectedNodes = $xpath->query($query);
        foreach ($affectedNodes as $node) {
            $paragraphContents = $node->ownerDocument->saveXML($node);
            $paragraphText = strip_tags($paragraphContents);
            if (($pos = strpos($paragraphText, $name, 0)) !== false) {
                //If we remove a paragraph inside a table cell we need to take special care
                if ($node->parentNode->nodeName == 'w:tc') {
                    $tcChilds = $node->parentNode->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'p');
                    if ($tcChilds->length > 1) {
                        $node->parentNode->removeChild($node);
                    } else {
                        $emptyP = $domDocument->createElement('w:p');
                        $node->parentNode->appendChild($emptyP);
                        $node->parentNode->removeChild($node);
                    }
                } else {
                    $node->parentNode->removeChild($node);
                }
            }
        }
        $stringDoc = $domDocument->saveXML();
        $bodyTag = explode('<w:body>', $stringDoc);
        $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
    }

    /**
     * Clones an existing block
     *
     * @access public
     * @param string $blockName Block name
     * @param int $occurrence Block occurrence
     * @param array $variablesBlock Variables to be replaced
     *  keys: variable names
     *  values: text string, WordFragment and images to be inserted
     * @param array $options
     * 'removeBlockPlaceholder' (bool) false as default. If true, remove block placeholders from the cloned content
     * 'type' (string) inline (default) or block; used by WordFragment values with $variablesBlock
     * @throws Exception method not available
     */
    public function cloneBlock($blockName, $occurrence = 1, $variablesBlock = array(), $options = array())
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        if (!$this->_preprocessed) {
            $variables = $this->getTemplateVariables();
            $this->processTemplate($variables);
        }

        // each block has two placeholders, so get the first position of the occurrence
        $occurrence *= 2;
        $occurrence--;

        $target = 'document';
        list($domDocument, $domXpath) = $this->getWordContentDOM($target);

        $contentNodesReferencedWordContent = $domXpath->query('(//w:p[w:r/w:t[text()[contains(.,"'.$this->_templateSymbolStart.$this->_templateBlockSymbol.$blockName.$this->_templateSymbolEnd.'")]]])[' . $occurrence . ']/following-sibling::*');

        $contentNodeReferencedToWordContent = $domXpath->query('(//w:p[w:r/w:t[text()[contains(.,"'.$this->_templateSymbolStart.$this->_templateBlockSymbol.$blockName.$this->_templateSymbolEnd.'")]]])[' . ($occurrence + 1) . ']');

        $contentNodeReferencedToWordContentParent = $domXpath->query('(//w:p[w:r/w:t[text()[contains(.,"'.$this->_templateSymbolStart.$this->_templateBlockSymbol.$blockName.$this->_templateSymbolEnd.'")]]])[' . ($occurrence + 1) . ']/..');

        if ($contentNodesReferencedWordContent->length > 0 && $contentNodeReferencedToWordContent->length > 0) {
            $cursor = $domDocument->createElement('cursor', 'WordFragment');
            $contentNodeReferencedToWordContentParent->item(0)->insertBefore($cursor, $contentNodeReferencedToWordContent->item(0)->nextSibling);
            $stringDoc = $domDocument->saveXML();
            $bodyTag = explode('<w:body>', $stringDoc);
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);

            $referenceWordContentXML = $domDocument->saveXML($contentNodeReferencedToWordContent->item(0));
            foreach ($contentNodesReferencedWordContent as $contentNodeReferencedWordContent) {
                if ($contentNodeReferencedWordContent->nodeValue == $this->_templateSymbolStart.$this->_templateBlockSymbol.$blockName.$this->_templateSymbolEnd) {
                    break;
                }
                $referenceWordContentXML .= $domDocument->saveXML($contentNodeReferencedWordContent);
            }
            $referenceWordContentXML .= $domDocument->saveXML($contentNodeReferencedToWordContent->item(0));

            // update id and name attributes in wp:docPr tags
            $referenceWordContentDOM = $this->xmlUtilities->generateDomDocument($this->_documentXMLElement . $referenceWordContentXML . '</w:document>');
            $docPrNodes = $referenceWordContentDOM->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing', 'docPr');
            if ($docPrNodes->length > 0) {
                foreach ($docPrNodes as $docPrNode) {
                    $decimalNumber = self::uniqueNumberId(999, 99999999);
                    $docPrNode->setAttribute('id', $decimalNumber);
                    $docPrNode->setAttribute('name', uniqid((string)mt_rand(999, 9999)));
                }

                if ($referenceWordContentDOM->firstChild->hasChildNodes()) {
                    $newReferenceWordContentXML = '';
                    foreach ($referenceWordContentDOM->firstChild->childNodes as $childNode) {
                        $newReferenceWordContentXML .= $childNode->ownerDocument->saveXML($childNode);
                    }

                    $referenceWordContentXML = $newReferenceWordContentXML;
                }
            }

            if (is_array($variablesBlock) && count($variablesBlock) > 0) {
                $newContentToBeAdded = '';
                // iterate variables to generate as many blocks as needed
                foreach ($variablesBlock as $variablesPositionBlock) {
                    // get and keep variables per type: string, WordFragment to get the best performance when doing the replacements
                    $variablesTextString = array();
                    $variablesWordFragment = array();
                    // keep original cloned content to be appened
                    $referenceWordContentXMLReplaced = $referenceWordContentXML;
                    foreach ($variablesPositionBlock as $variableBlockKey => $variableBlockValue) {
                        if ($variableBlockValue instanceof WordFragment) {
                            $variablesWordFragment[$variableBlockKey] = $variableBlockValue;
                        } else {
                            $variablesTextString[$variableBlockKey] = $variableBlockValue;
                        }
                    }
                    // image replacements
                    if (isset($variablesTextString['images']) && is_array($variablesTextString['images']) && count($variablesTextString['images'])) {
                        foreach ($variablesTextString['images'] as $variableImageReplacementKey => $variableImageReplacementValue) {
                            $referenceWordContentXMLReplaced = $this->_documentXMLElement . '<w:body>' . $referenceWordContentXMLReplaced . '</w:body></w:document>';
                            $domReplaced = $this->Image4Image($variableImageReplacementKey, $variableImageReplacementValue, $referenceWordContentXMLReplaced, $options);
                            $stringDocReplaced = $domReplaced->saveXML();
                            $bodyTagReplaced = explode('<w:body>', $stringDocReplaced);
                            $referenceWordContentXMLReplaced = str_replace('</w:body></w:document>', '', $bodyTagReplaced[1]);
                        }
                        // these key is not needed anymore
                        unset($variablesTextString['images']);
                    }
                    if (count($variablesTextString) > 0) {
                        // replace text string placeholders
                        $referenceWordContentXMLReplaced = $this->_documentXMLElement . '<w:body>' . $referenceWordContentXMLReplaced . '</w:body></w:document>';
                        $domReplaced = $this->variable2Text($variablesTextString, $referenceWordContentXMLReplaced, $options);
                        $stringDocReplaced = $domReplaced->asXML();
                        $bodyTagReplaced = explode('<w:body>', $stringDocReplaced);
                        $referenceWordContentXMLReplaced = str_replace('</w:body></w:document>', '', $bodyTagReplaced[1]);
                    }
                    if (count($variablesWordFragment) > 0) {
                        // replace WordFragment placeholders
                        if (!isset($options['type'])) {
                            $options['type'] = 'inline';
                        }
                        $referenceWordContentXMLReplaced = $this->_documentXMLElement . '<w:body>' . $referenceWordContentXMLReplaced . '</w:body></w:document>';
                        $stringDocReplaced = $this->variable4WordFragment($variablesWordFragment, $options['type'], $referenceWordContentXMLReplaced, false, $options);
                        $bodyTagReplaced = explode('<w:body>', $stringDocReplaced);
                        $referenceWordContentXMLReplaced = str_replace('</w:body></w:document>', '', $bodyTagReplaced[1]);
                    }

                    $newContentToBeAdded .= $referenceWordContentXMLReplaced;
                }
                // replace the reference content with the new cloned contents
                $referenceWordContentXML = $newContentToBeAdded;
            }

            if (isset($options['removeBlockPlaceholder']) && $options['removeBlockPlaceholder']) {
                // remove block placeholders from the content cloned
                $referenceWordContentXML = $this->_documentXMLElement . '<w:body>' . $referenceWordContentXML . '</w:body></w:document>';
                $stringDocCleaned = $this->removeVariableBlock($this->_templateBlockSymbol.$blockName, $referenceWordContentXML);
                $bodyTagCleaned = explode('<w:body>', $stringDocCleaned);
                $referenceWordContentXML = str_replace('</w:body></w:document>', '', $bodyTagCleaned[1]);
            }

            $this->_wordDocumentC = str_replace('<cursor>WordFragment</cursor>', $referenceWordContentXML, $this->_wordDocumentC);
        }
    }

    /**
     * Removes all content between two block variables
     *
     * @param string $blockName
     * @deprecated
     * @see deleteBlock
     */
    public function deleteTemplateBlock($blockName)
    {
        $this->deleteBlock($blockName);
    }

    /**
     * Removes all content between two block variables
     *
     * @access public
     * @param string $blockName block name
     * @param string $type block (default), inline
     */
    public function deleteBlock($blockName, $type = 'block')
    {
        $aType = array($this->_templateBlockSymbol);
        foreach ($aType as $blockType) {
            $variableName = $blockType . $blockName;
            $loadContent = $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>';
            if (!$this->_preprocessed) {
                $loadContent = $this->repairVariables(array($variableName => ''), $loadContent);
            }
            if ($type == 'block') {
                $loadContent = preg_replace('/\\' . $this->_templateSymbolStart . $blockType . $blockName . '\\' . $this->_templateSymbolEnd . '[.|\s|\S]*?\\' . $this->_templateSymbolStart . $blockType . $blockName . '\\' . $this->_templateSymbolEnd . '/ms', $this->_templateSymbolStart . $variableName . $this->_templateSymbolEnd, $loadContent);
                $name = $this->_templateSymbolStart . $variableName . $this->_templateSymbolEnd;
                // use XPath to find all paragraphs that include the variable name
                $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);
                $xpath = new DOMXPath($domDocument);
                $xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                $query = '//w:p[w:r/w:t[text()[contains(.,"' . $variableName . '")]]]';
                $affectedNodes = $xpath->query($query);
                foreach ($affectedNodes as $node) {
                    $paragraphContents = $node->ownerDocument->saveXML($node);
                    $paragraphText = strip_tags($paragraphContents);
                    if (($pos = strpos($paragraphText, $name, 0)) !== false) {
                        //If we remove a paragraph inside a table cell we need to take special care
                        if ($node->parentNode->nodeName == 'w:tc') {
                            $tcChilds = $node->parentNode->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'p');
                            if ($tcChilds->length > 1) {
                                $node->parentNode->removeChild($node);
                            } else {
                                $emptyP = $domDocument->createElement('w:p');
                                $node->parentNode->appendChild($emptyP);
                                $node->parentNode->removeChild($node);
                            }
                        } else {
                            $node->parentNode->removeChild($node);
                        }
                    }
                }
                $bodyTag = explode('<w:body>', $domDocument->saveXML());
                $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            } else if ($type == 'inline') {
                $loadContent = preg_replace('/\\' . $this->_templateSymbolStart . $blockType . $blockName . '\\' . $this->_templateSymbolEnd . '[.|\s|\S]*?\\' . $this->_templateSymbolStart . $blockType . $blockName . '\\' . $this->_templateSymbolEnd . '/ms', '', $loadContent);
                $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);
                $bodyTag = explode('<w:body>', $domDocument->saveXML());
                $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            }
        }
    }

    /**
     * Returns the template variables
     *
     * @access public
     * @param string $target may be all (default), document, header, footer, footnotes, endnotes or comments
     * @param array $prefixes
     * @param array $variables
     * @return array
     */
    public function getTemplateVariables($target = 'all', $prefixes = array(), $variables = array())
    {
        $targetTypes = array('document', 'header', 'footer', 'footnotes', 'endnotes', 'comments');

        if (!$this->_parseMode) {
            // default mode
            if ($target == 'document') {
                if ($this->_templateSymbolStart == $this->_templateSymbolEnd && strlen($this->_templateSymbolStart) == 1) {
                    $documentSymbol = explode($this->_templateSymbolStart, $this->_wordDocumentC);
                    $variables = $this->extractVariables($target, $documentSymbol, $variables);
                } else {
                    $variables = $this->extractVariablesDistinctSymbols($target, $this->_wordDocumentC, $variables);
                }
            } else if ($target == 'header') {
                $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
                $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
                foreach ($xpathHeadersResults as $headersResults) {
                    $header = substr($headersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($header);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                        $loadContent = $this->_modifiedHeadersFooters[$header];
                    }
                    if (!empty($loadContent)) {
                        if ($this->_templateSymbolStart == $this->_templateSymbolEnd && strlen($this->_templateSymbolStart) == 1) {
                            $documentSymbol = explode($this->_templateSymbolStart, $loadContent);
                            $variables = $this->extractVariables($target, $documentSymbol, $variables);
                        } else {
                            $variables = $this->extractVariablesDistinctSymbols($target, $loadContent, $variables);
                        }
                    }
                }
            } else if ($target == 'footer') {
                $xpathFooters = simplexml_import_dom($this->_contentTypeT);
                $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
                foreach ($xpathFootersResults as $footersResults) {
                    $footer = substr($footersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($footer);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                        $loadContent = $this->_modifiedHeadersFooters[$footer];
                    }
                    if (!empty($loadContent)) {
                        if ($this->_templateSymbolStart == $this->_templateSymbolEnd && strlen($this->_templateSymbolStart) == 1) {
                            $documentSymbol = explode($this->_templateSymbolStart, $loadContent);
                            $variables = $this->extractVariables($target, $documentSymbol, $variables);
                        } else {
                            $variables = $this->extractVariablesDistinctSymbols($target, $loadContent, $variables);
                        }
                    }
                }
            } else if ($target == 'footnotes') {
                if ($this->_templateSymbolStart == $this->_templateSymbolEnd && strlen($this->_templateSymbolStart) == 1) {
                    $documentSymbol = explode($this->_templateSymbolStart, $this->_wordFootnotesT->saveXML());
                    $variables = $this->extractVariables($target, $documentSymbol, $variables);
                } else {
                    $variables = $this->extractVariablesDistinctSymbols($target, $this->_wordFootnotesT->saveXML(), $variables);
                }
            } else if ($target == 'endnotes') {
                if ($this->_templateSymbolStart == $this->_templateSymbolEnd && strlen($this->_templateSymbolStart) == 1) {
                    $documentSymbol = explode($this->_templateSymbolStart, $this->_wordEndnotesT->saveXML());
                    $variables = $this->extractVariables($target, $documentSymbol, $variables);
                } else {
                    $variables = $this->extractVariablesDistinctSymbols($target, $this->_wordEndnotesT->saveXML(), $variables);
                }
            } else if ($target == 'comments') {
                if ($this->_templateSymbolStart == $this->_templateSymbolEnd && strlen($this->_templateSymbolStart) == 1) {
                    $documentSymbol = explode($this->_templateSymbolStart, $this->_wordCommentsT->saveXML());
                    $variables = $this->extractVariables($target, $documentSymbol, $variables);
                } else {
                    $variables = $this->extractVariablesDistinctSymbols($target, $this->_wordCommentsT->saveXML(), $variables);
                }
            } else if ($target == 'all') {
                foreach ($targetTypes as $targets) {
                    $variables = $this->getTemplateVariables($targets, $prefixes, $variables);
                }
            }
        } else {
            // parse mode
            if ($target == 'document') {
                $variables = $this->extractVariablesParseMode($target, $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>', $variables);
            } else if ($target == 'header') {
                $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
                $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
                foreach ($xpathHeadersResults as $headersResults) {
                    $header = substr($headersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($header);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                        $loadContent = $this->_modifiedHeadersFooters[$header];
                    }
                    if (!empty($loadContent)) {
                        $variables = $this->extractVariablesParseMode($target, $loadContent, $variables);
                    }
                }
            } else if ($target == 'footer') {
                $xpathFooters = simplexml_import_dom($this->_contentTypeT);
                $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
                foreach ($xpathFootersResults as $footersResults) {
                    $footer = substr($footersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($footer);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                        $loadContent = $this->_modifiedHeadersFooters[$footer];
                    }
                    if (!empty($loadContent)) {
                        $variables = $this->extractVariablesParseMode($target, $loadContent, $variables);
                    }
                }
            } else if ($target == 'footnotes') {
                $variables = $this->extractVariablesParseMode($target, $this->_wordFootnotesT->saveXML(), $variables);
            } else if ($target == 'endnotes') {
                $variables = $this->extractVariablesParseMode($target, $this->_wordEndnotesT->saveXML(), $variables);
            } else if ($target == 'comments') {
                $variables = $this->extractVariablesParseMode($target, $this->_wordCommentsT->saveXML(), $variables);
            } else if ($target == 'all') {
                foreach ($targetTypes as $targets) {
                    $variables = $this->getTemplateVariables($targets, $prefixes, $variables);
                }
            }
        }

        return $variables;
    }

    /**
     * Returns the template variables and their types
     *
     * @access public
     * @param string $target may be all (default), document, header, footer, footnotes, endnotes or comments
     * @param array $prefixes
     * @param array $variables
     * @return array
     * @throws Exception method not available
     */
    public function getTemplateVariablesType($target = 'all', $prefixes = array(), $variables = array())
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPathStyles.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        // get existing variables to analyze them
        $variables = $this->getTemplateVariables($target, $prefixes, $variables);
        $variablesTypes = array();

        // iterate variables to get their types
        foreach ($variables as $variablesTargetKey => $variablesTargetValue) {
            if (is_array($variablesTargetValue) && count($variablesTargetValue) > 0) {
                $variablesTypes[$variablesTargetKey] = array();
                foreach ($variablesTargetValue as $variableTargetValue) {
                    $variableTargetValueSymbols = $this->_templateSymbolStart . $variableTargetValue . $this->_templateSymbolEnd;
                    $docxpathStyles = new DOCXPathStyles();

                    $variableType = null;
                    if ($variablesTargetKey == 'document') {
                        $variableType = $docxpathStyles->analyzeVariable($variableTargetValueSymbols, $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>');
                    } else if ($variablesTargetKey == 'header') {
                        $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
                        $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                        $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
                        foreach ($xpathHeadersResults as $headersResults) {
                            $header = substr($headersResults['PartName'], 1);
                            $loadContent = $this->getFromZip($header);
                            if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                                $loadContent = $this->_modifiedHeadersFooters[$header];
                            }
                            if (!empty($loadContent)) {
                                $variableType = $docxpathStyles->analyzeVariable($variableTargetValueSymbols, $loadContent);
                            }
                        }
                    } else if ($variablesTargetKey == 'footer') {
                        $xpathFooters = simplexml_import_dom($this->_contentTypeT);
                        $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                        $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
                        foreach ($xpathFootersResults as $footersResults) {
                            $footer = substr($footersResults['PartName'], 1);
                            $loadContent = $this->getFromZip($footer);
                            if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                                $loadContent = $this->_modifiedHeadersFooters[$footer];
                            }
                            if (!empty($loadContent)) {
                                $variableType = $docxpathStyles->analyzeVariable($variableTargetValueSymbols, $loadContent);
                            }
                        }
                    } else if ($variablesTargetKey == 'footnotes') {
                        $variableType = $docxpathStyles->analyzeVariable($variableTargetValueSymbols, $this->_wordFootnotesT->saveXML());
                    } else if ($variablesTargetKey == 'endnotes') {
                        $variableType = $docxpathStyles->analyzeVariable($variableTargetValueSymbols, $this->_wordEndnotesT->saveXML());
                    } else if ($variablesTargetKey == 'comments') {
                        $variableType = $docxpathStyles->analyzeVariable($variableTargetValueSymbols, $this->_wordCommentsT->saveXML());
                    }

                    if (isset($variableType)) {
                        $variablesTypes[$variablesTargetKey][] = array(
                            'variable' => $variableTargetValue,
                            'type' => $variableType,
                        );
                    }
                }
            }
        }

        return $variablesTypes;
    }

    /**
     * Modifies the value of an input field
     *
     * @access public
     * @param array $data with the key the name of the variable and the value of the input text
     * @param array $options
     * 'target' document (default), header, footer
     */
    public function modifyInputFields($data, $options = array())
    {
        if (isset($options['target'])) {
            $target = $options['target'];
        } else {
            $target = 'document';
        }

        if ($target == 'document') {
            $loadContent = $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>';
            $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);
            $docXPath = new DOMXPath($domDocument);
            $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
            $docXPath->registerNamespace('w14', 'http://schemas.microsoft.com/office/word/2010/wordml');
            foreach ($data as $var => $value) {
                //check for legacy checkboxes
                $queryDoc = '//w:ffData[w:name[@w:val="' . $var . '"]]';
                $affectedNodes = $docXPath->query($queryDoc);
                foreach ($affectedNodes as $node) {
                    //get the parent p Node
                    $pNode = $node->parentNode->parentNode->parentNode;
                    //we should take into account that there could be more than one field per paragraph
                    $preliminaryQuery = './/w:r[descendant::w:ffData and count(preceding-sibling::w:r[descendant::w:name[@w:val = "' . $var . '"]]) < 1]';
                    $previousInputs = $docXPath->query($preliminaryQuery, $pNode)->length;
                    $position = $previousInputs - 1;
                    $query = './/w:r[count(preceding-sibling::w:r[descendant::w:fldChar[@w:fldCharType = "separate"]]) >= ' . ($position + 1);
                    $query .= ' and count(preceding-sibling::w:r[descendant::w:fldChar[@w:fldCharType = "end"]]) < ' . ($position + 1);
                    $query .= ' and not(descendant::w:fldChar)]';
                    $rNodes = $docXPath->query($query, $pNode);
                    $rCount = 0;
                    foreach ($rNodes as $rNode) {
                        if ($rCount == 0) {
                            $rNode->getElementsByTagName('t')->item(0)->nodeValue = htmlspecialchars($value);
                        } else {
                            $rNode->setAttribute('w:remove', 1);
                        }
                        $rCount++;
                    }
                    //remove the unwanted rNodes
                    $query = './/w:r[@w:remove="1"]';
                    $removeNodes = $docXPath->query($query, $pNode);
                    $length = $removeNodes->length;
                    for ($j = $length - 1; $j > -1; $j--) {
                        $removeNodes->item($j)->parentNode->removeChild($removeNodes->item($j));
                    }
                }
                $queryDoc = '//w:sdtPr[w:tag[@w:val="' . $var . '"]]';
                $affectedNodes = $docXPath->query($queryDoc);
                foreach ($affectedNodes as $node) {
                    $sdtNode = $node->parentNode;
                    $query = './/w:t[1]';
                    $tNode = $docXPath->query($query, $sdtNode)->item(0)->nodeValue = htmlspecialchars($value);
                }
            }

            $stringDoc = $domDocument->saveXML();
            $bodyTag = explode('<w:body>', $stringDoc);
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        } else if ($target == 'header' || $target == 'footer') {
            $xpathHeadersFooters = simplexml_import_dom($this->_contentTypeT);
            $xpathHeadersFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
            if ($target == 'header') {
                $contentTypeScope = 'ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]';
            } else if ($target == 'footer') {
                $contentTypeScope = 'ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]';
            }
            $xpathHeadersFootersResults = $xpathHeadersFooters->xpath($contentTypeScope);
            foreach ($xpathHeadersFootersResults as $xpathHeadersFootersResult) {
                $headerFooter = substr($xpathHeadersFootersResult['PartName'], 1);
                $loadContent = $this->getFromZip($headerFooter);
                if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$headerFooter])) {
                    $loadContent = $this->_modifiedHeadersFooters[$headerFooter];
                }
                if (!empty($loadContent)) {
                    $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);
                    $docXPath = new DOMXPath($domDocument);
                    $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                    $docXPath->registerNamespace('w14', 'http://schemas.microsoft.com/office/word/2010/wordml');
                    foreach ($data as $var => $value) {
                        //check for legacy checkboxes
                        $queryDoc = '//w:ffData[w:name[@w:val="' . $var . '"]]';
                        $affectedNodes = $docXPath->query($queryDoc);
                        foreach ($affectedNodes as $node) {
                            //get the parent p Node
                            $pNode = $node->parentNode->parentNode->parentNode;
                            //we should take into account that there could be more than one field per paragraph
                            $preliminaryQuery = './/w:r[descendant::w:ffData and count(preceding-sibling::w:r[descendant::w:name[@w:val = "' . $var . '"]]) < 1]';
                            $previousInputs = $docXPath->query($preliminaryQuery, $pNode)->length;
                            $position = $previousInputs - 1;
                            $query = './/w:r[count(preceding-sibling::w:r[descendant::w:fldChar[@w:fldCharType = "separate"]]) >= ' . ($position + 1);
                            $query .= ' and count(preceding-sibling::w:r[descendant::w:fldChar[@w:fldCharType = "end"]]) < ' . ($position + 1);
                            $query .= ' and not(descendant::w:fldChar)]';
                            $rNodes = $docXPath->query($query, $pNode);
                            $rCount = 0;
                            foreach ($rNodes as $rNode) {
                                if ($rCount == 0) {
                                    $rNode->getElementsByTagName('t')->item(0)->nodeValue = htmlspecialchars($value);
                                } else {
                                    $rNode->setAttribute('w:remove', 1);
                                }
                                $rCount++;
                            }
                            //remove the unwanted rNodes
                            $query = './/w:r[@w:remove="1"]';
                            $removeNodes = $docXPath->query($query, $pNode);
                            $length = $removeNodes->length;
                            for ($j = $length - 1; $j > -1; $j--) {
                                $removeNodes->item($j)->parentNode->removeChild($removeNodes->item($j));
                            }
                        }
                        $queryDoc = '//w:sdtPr[w:tag[@w:val="' . $var . '"]]';
                        $affectedNodes = $docXPath->query($queryDoc);
                        foreach ($affectedNodes as $node) {
                            $sdtNode = $node->parentNode;
                            $query = './/w:t[1]';
                            $tNode = $docXPath->query($query, $sdtNode)->item(0)->nodeValue = htmlspecialchars($value);
                        }
                    }
                    $newContent = $domDocument->saveXML();
                    $this->_modifiedHeadersFooters[$headerFooter] = $newContent;
                    $this->saveToZip($newContent, $headerFooter);
                }
            }
        }
    }

    /**
     * Modifies the value of merge fields
     *
     * @access public
     * @param array $data with the key the name of the variable and the value the value of the merge field
     * @param array $options
     * 'target' document (default), header, footer
     * @throws Exception method not available
     */
    public function modifyMergeFields($data, $options = array())
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        if (is_array($data)) {
            if (isset($options['target'])) {
                $target = $options['target'];
            } else {
                $target = 'document';
            }

            if ($target == 'document') {
                $loadContent = $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>';
                $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);
                $docXPath = new DOMXPath($domDocument);
                $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                $docXPath->registerNamespace('w14', 'http://schemas.microsoft.com/office/word/2010/wordml');
                foreach ($data as $var => $value) {
                    // w:fldSimple tags, get all MERGEFIELD nodes to avoid XPath issues when working with some special characters
                    $queryFldSimple = '//w:fldSimple[contains(@w:instr, "MERGEFIELD")]';
                    $nodesFldSimple = $docXPath->query($queryFldSimple);
                    foreach ($nodesFldSimple as $nodeFldSimple) {
                        if ($nodeFldSimple->hasAttribute('w:instr') && strstr($nodeFldSimple->getAttribute('w:instr'), '"' . $var . '"')) {
                            // get w:t tag
                            $nodesTFldSimple = $nodeFldSimple->getElementsByTagName('t');
                            if ($nodesTFldSimple->length > 0) {
                                $nodesTFldSimple->item(0)->nodeValue = htmlspecialchars($value);
                            }
                        }
                    }

                    // w:instrText tags, get all MERGEFIELD nodes to avoid XPath issues when working with some special characters
                    $queryInstrText = '//w:instrText[contains(text(), "MERGEFIELD")]';
                    $nodesInstrText = $docXPath->query($queryInstrText);
                    foreach ($nodesInstrText as $nodeInstrText) {
                        if (strstr($nodeInstrText->nodeValue, '"' . $var . '"')) {
                            // get w:t tag in the w:fldChar scope
                            $nodesInstrText = $nodeInstrText->parentNode->nextSibling->nextSibling->getElementsByTagName('t');
                            if ($nodesInstrText->length > 0) {
                                $nodesInstrText->item(0)->nodeValue = htmlspecialchars($value);
                            }
                        }
                    }
                }
                $stringDoc = $domDocument->saveXML();
                $bodyTag = explode('<w:body>', $stringDoc);
                $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            } else if ($target == 'header' || $target == 'footer') {
                $xpathHeadersFooters = simplexml_import_dom($this->_contentTypeT);
                $xpathHeadersFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                if ($target == 'header') {
                    $contentTypeScope = 'ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]';
                } else if ($target == 'footer') {
                    $contentTypeScope = 'ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]';
                }
                $xpathHeadersFootersResults = $xpathHeadersFooters->xpath($contentTypeScope);
                foreach ($xpathHeadersFootersResults as $xpathHeadersFootersResult) {
                    $headerFooter = substr($xpathHeadersFootersResult['PartName'], 1);
                    $loadContent = $this->getFromZip($headerFooter);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$headerFooter])) {
                        $loadContent = $this->_modifiedHeadersFooters[$headerFooter];
                    }
                    if (!empty($loadContent)) {
                        $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);
                        $docXPath = new DOMXPath($domDocument);
                        $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $docXPath->registerNamespace('w14', 'http://schemas.microsoft.com/office/word/2010/wordml');
                        foreach ($data as $var => $value) {
                            // w:fldSimple tags, get all MERGEFIELD nodes to avoid XPath issues when working with some special characters
                            $queryFldSimple = '//w:fldSimple[contains(@w:instr, "MERGEFIELD")]';
                            $nodesFldSimple = $docXPath->query($queryFldSimple);
                            foreach ($nodesFldSimple as $nodeFldSimple) {
                                if ($nodeFldSimple->hasAttribute('w:instr') && strstr($nodeFldSimple->getAttribute('w:instr'), '"' . $var . '"')) {
                                    // get w:t tag
                                    $nodesTFldSimple = $nodeFldSimple->getElementsByTagName('t');
                                    if ($nodesTFldSimple->length > 0) {
                                        $nodesTFldSimple->item(0)->nodeValue = htmlspecialchars($value);
                                    }
                                }
                            }

                            // w:instrText tags, get all MERGEFIELD nodes to avoid XPath issues when working with some special characters
                            $queryInstrText = '//w:instrText[contains(text(), "MERGEFIELD")]';
                            $nodesInstrText = $docXPath->query($queryInstrText);
                            foreach ($nodesInstrText as $nodeInstrText) {
                                if (strstr($nodeInstrText->nodeValue, '"' . $var . '"')) {
                                    // get w:t tag in the w:fldChar scope
                                    $nodesInstrText = $nodeInstrText->parentNode->nextSibling->nextSibling->getElementsByTagName('t');
                                    if ($nodesInstrText->length > 0) {
                                        $nodesInstrText->item(0)->nodeValue = htmlspecialchars($value);
                                    }
                                }
                            }
                        }
                        $newContent = $domDocument->saveXML();
                        $this->_modifiedHeadersFooters[$headerFooter] = $newContent;
                        $this->saveToZip($newContent, $headerFooter);
                    }
                }
            }
        }
    }

    /**
     * Processes the template to repair all listed variables
     *
     * @access public
     * @param array $variables an array of arrays of variables that should be repaired.
     * Posible keys and values are:
     *  'document' array of variables within the main document
     *  'headers' or 'header' array of variables within the headers
     *  'footers' or 'footer' array of variables within the footers
     *  'footnotes' or 'footnote' array of variables within the footnotes
     *  'endnotes' or 'endnote' array of variables within the endnotes
     *  'comments' or 'comment' array of variables within the comments
     * If the array is empty the variables will be tried to be extracted automatically.
     */
    public function processTemplate($variables = array())
    {
        $this->_preprocessed = true;
        if (is_array($variables) && count($variables) == 0) {
            $variables = $this->getTemplateVariables();
        }
        foreach ($variables as $target => $varList) {
            $variableList = array_flip($varList);
            if ($target == 'document') {
                $loadContent = $this->_documentXMLElement . '<w:body>' .
                        $this->_wordDocumentC . '</w:body></w:document>';
                $stringDoc = $this->repairVariables($variableList, $loadContent);
                $bodyTag = explode('<w:body>', $stringDoc);
                $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            } else if ($target == 'footnotes' || $target == 'footnote') {
                $content = $this->_wordFootnotesT->saveXML();
                $XML = $this->repairVariables($variableList, $content);
                $this->_wordFootnotesT = $this->xmlUtilities->generateDomDocument($XML);
            } else if ($target == 'endnotes' || $target == 'endnote') {
                $content = $this->_wordEndnotesT->saveXML();
                $XML = $this->repairVariables($variableList, $content);
                $this->_wordEndnotesT = $this->xmlUtilities->generateDomDocument($XML);
            } else if ($target == 'comments' || $target == 'comment') {
                $content = $this->_wordCommentsT->saveXML();
                $XML = $this->repairVariables($variableList, $content);
                $this->_wordCommentsT = $this->xmlUtilities->generateDomDocument($XML);
            } else if ($target == 'headers' || $target == 'header') {
                $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
                $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
                foreach ($xpathHeadersResults as $headersResults) {
                    $header = substr($headersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($header);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                        $loadContent = $this->_modifiedHeadersFooters[$header];
                    }
                    if (!empty($loadContent)) {
                        $XML = $this->repairVariables($variableList, $loadContent);
                        $this->_modifiedHeadersFooters[$header] = $XML;
                        $this->saveToZip($XML, $header);
                    }
                }
            } else if ($target == 'footers' || $target == 'footer') {
                $xpathFooters = simplexml_import_dom($this->_contentTypeT);
                $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
                foreach ($xpathFootersResults as $footersResults) {
                    $footer = substr($footersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($footer);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                        $loadContent = $this->_modifiedHeadersFooters[$footer];
                    }
                    if (!empty($loadContent)) {
                        $XML = $this->repairVariables($variableList, $loadContent);
                        $this->_modifiedHeadersFooters[$footer] = $XML;
                        $this->saveToZip($XML, $footer);
                    }
                }
            }
        }
    }

    /**
     * Removes a template variable with its container paragraph
     *
     * @access public
     * @param string $variableName
     * @param string $type can be block or inline
     * @param string $target it can be document (default value), header, footer, footnote, endnote, comment
     */
    public function removeTemplateVariable($variableName, $type = 'block', $target = 'document')
    {
        if ($type == 'inline') {
            $this->replaceVariableByText(array($variableName => ''), array('target' => $target));
        } else {
            if ($target == 'document') {
                $loadContent = $this->_documentXMLElement . '<w:body>' .
                        $this->_wordDocumentC . '</w:body></w:document>';
                $stringDoc = $this->removeVariableBlock($variableName, $loadContent);
                $bodyTag = explode('<w:body>', $stringDoc);
                $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            } else if ($target == 'footnote') {
                $dom = $this->removeVariableBlock($variableName, $this->_wordFootnotesT->saveXML());
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $this->_wordFootnotesT->loadXML($dom);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
            } else if ($target == 'endnote') {
                $dom = $this->removeVariableBlock($variableName, $this->_wordEndnotesT->saveXML());
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $this->_wordEndnotesT->loadXML($dom);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
            } else if ($target == 'comment') {
                $dom = $this->removeVariableBlock($variableName, $this->_wordCommentsT->saveXML());
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $this->_wordCommentsT->loadXML($dom);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
            } else if ($target == 'header') {
                $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
                $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
                foreach ($xpathHeadersResults as $headersResults) {
                    $header = substr($headersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($header);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                        $loadContent = $this->_modifiedHeadersFooters[$header];
                    }
                    if (!empty($loadContent)) {
                        $dom = $this->removeVariableBlock($variableName, $loadContent);
                        if (is_string($dom)) {
                            $this->_modifiedHeadersFooters[$header] = $dom;
                        } else {
                            $this->_modifiedHeadersFooters[$header] = $dom->saveXML();
                        }
                        $this->saveToZip($dom, $header);
                    }
                }
            } else if ($target == 'footer') {
                $xpathFooters = simplexml_import_dom($this->_contentTypeT);
                $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
                foreach ($xpathFootersResults as $footersResults) {
                    $footer = substr($footersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($footer);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                        $loadContent = $this->_modifiedHeadersFooters[$footer];
                    }
                    if (!empty($loadContent)) {
                        $dom = $this->removeVariableBlock($variableName, $loadContent);
                        if (is_string($dom)) {
                            $this->_modifiedHeadersFooters[$footer] = $dom;
                        } else {
                            $this->_modifiedHeadersFooters[$footer] = $dom->saveXML();
                        }
                        $this->saveToZip($dom, $footer);
                    }
                }
            }
        }
    }

    /**
     * Replaces all content between two block variables
     *
     * @access public
     * @param string $blockName block name
     * @param string|WordFragment $value new content
     * @param string $type block (default), inline
     * @throws Exception method not available
     */
    public function replaceBlock($blockName, $value, $type = 'block')
    {
        if (!file_exists(dirname(__FILE__) . '/DOCXPath.php')) {
            PhpdocxLogger::logger('This method is not available for your license.', 'fatal');
        }

        $aType = array($this->_templateBlockSymbol);
        foreach ($aType as $blockType) {
            $variableName = $blockType . $blockName;
            $loadContent = $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>';
            if (!$this->_preprocessed) {
                $loadContent = $this->repairVariables(array($variableName => ''), $loadContent);
            }

            // add a random string replacing the block. This string will be replaced by the new contents
            $uniquePlaceholder = 'VAR_BLOCK_' . uniqid((string)mt_rand(999, 9999));
            $uniqueKey = $this->_templateSymbolStart . $uniquePlaceholder . $this->_templateSymbolEnd;
            $loadContent = preg_replace('/\\' . $this->_templateSymbolStart . $blockType . $blockName . '\\' . $this->_templateSymbolEnd . '[.|\s|\S]*?\\' . $this->_templateSymbolStart . $blockType . $blockName . '\\' . $this->_templateSymbolEnd . '/ms', $uniqueKey, $loadContent);
            $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);
            $bodyTag = explode('<w:body>', $domDocument->saveXML());
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            if ($value instanceof WordFragment) {
                // WordFragment replacement
                $this->replaceVariableByWordFragment(array($uniquePlaceholder => $value), array('type' => $type));
            } else {
                // string replacement
                $this->replaceVariableByText(array($uniquePlaceholder => $value));
            }
        }
    }

    /**
     * Replaces a single variable within a list by a list of items
     *
     * @access public
     * @param string $variable
     * @param array $listValues
     * @param array $options
     * 'target': document (default), header, footer
     * 'firstMatch' (bool) if true it only replaces the first variable match. Default is set to false.
     * 'parseLineBreaks' (bool) if true (default is false) parses the line breaks to include them in the Word document
     * 'type' (string) inline (default) or block; used by WordFragment values
     */
    public function replaceListVariable($variable, $listValues, $options = array())
    {
        if (isset($options['firstMatch'])) {
            $firstMatch = $options['firstMatch'];
        } else {
            $firstMatch = false;
        }

        $type = 'inline';
        if (isset($options['type'])) {
            $type = $options['type'];
        }

        if (isset($options['target'])) {
            $target = $options['target'];
        } else {
            $target = 'document';
        }

        if ($target == 'document') {
            $loadContent = $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>';
            if (!$this->_preprocessed) {
                $loadContent = $this->repairVariables(array($variable => ''), $loadContent);
            }
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $dom = simplexml_load_string($loadContent);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
            $dom->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
            $search = $this->_templateSymbolStart . $variable . $this->_templateSymbolEnd;
            $query = '//w:p[w:r/w:t[text()[contains(., "' . $search . '")]]]';
            if ($firstMatch) {
                $query = '(' . $query . ')[1]';
            }

            // if the content has WordFragments, replace each WordFragment by a plain placeholder. This holder
            // is replaced by the WordFragment value using the replaceVariableByWordFragment method
            $wordFragmentsValues = array();
            $this->replaceListWordFragments($wordFragmentsValues, $listValues);

            $foundNodes = $dom->xpath($query);
            foreach ($foundNodes as $node) {
                $domNode = dom_import_simplexml($node);
                $numIlvlNode = $domNode->getElementsByTagName('ilvl');
                if ($numIlvlNode->length > 0) {
                    $this->replaceListValues($search, $domNode, $listValues, (int)$numIlvlNode->item(0)->getAttribute('w:val'), $options);
                } else {
                    $this->replaceListValues($search, $domNode, $listValues, 0, $options);
                }
                $domNode->parentNode->removeChild($domNode);
            }
            $stringDoc = $dom->asXML();
            $bodyTag = explode('<w:body>', $stringDoc);
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                $this->_wordDocumentC = str_replace('__PHX=__LINEBREAK__', '</w:t><w:br/><w:t xml:space="preserve">', $this->_wordDocumentC);
            }

            // replace existing WordFragment placeholders
            if (count($wordFragmentsValues) > 0) {
                $this->replaceVariableByWordFragment($wordFragmentsValues, array('type' => $type));
            }
        } elseif ($target == 'header') {
            // if the content has WordFragments, replace each WordFragment by a plain placeholder. This holder
            // is replaced by the WordFragment value using the replaceVariableByWordFragment method
            $wordFragmentsValues = array();
            $this->replaceListWordFragments($wordFragmentsValues, $listValues);

            $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
            $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
            $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
            foreach ($xpathHeadersResults as $headersResults) {
                $header = substr($headersResults['PartName'], 1);
                $loadContent = $this->getFromZip($header);
                if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                    $loadContent = $this->_modifiedHeadersFooters[$header];
                }
                if (!empty($loadContent)) {
                    if (!$this->_preprocessed) {
                        $loadContent = $this->repairVariables(array($variable => ''), $loadContent);
                    }
                    if (PHP_VERSION_ID < 80000) {
                        $optionEntityLoader = libxml_disable_entity_loader(true);
                    }
                    $dom = simplexml_load_string($loadContent);
                    if (PHP_VERSION_ID < 80000) {
                        libxml_disable_entity_loader($optionEntityLoader);
                    }
                    $dom->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                    $search = $this->_templateSymbolStart . $variable . $this->_templateSymbolEnd;
                    $query = '//w:p[w:r/w:t[text()[contains(., "' . $search . '")]]]';
                    if ($firstMatch) {
                        $query = '(' . $query . ')[1]';
                    }

                    $foundNodes = $dom->xpath($query);
                    foreach ($foundNodes as $node) {
                        $domNode = dom_import_simplexml($node);
                        $numIlvlNode = $domNode->getElementsByTagName('ilvl');
                        if ($numIlvlNode->length > 0) {
                            $this->replaceListValues($search, $domNode, $listValues, (int)$numIlvlNode->item(0)->getAttribute('w:val'), $options);
                        } else {
                            $this->replaceListValues($search, $domNode, $listValues, 0, $options);
                        }
                        $domNode->parentNode->removeChild($domNode);
                    }
                    $stringDoc = $dom->asXML();
                    if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                        $stringDoc = str_replace('__PHX=__LINEBREAK__', '</w:t><w:br/><w:t xml:space="preserve">', $stringDoc);
                        $dom = simplexml_load_string($stringDoc);
                    }

                    $this->_modifiedHeadersFooters[$header] = $stringDoc;
                    $this->saveToZip($dom, $header);
                }
            }

            // replace existing WordFragment placeholders
            if (count($wordFragmentsValues) > 0) {
                $this->replaceVariableByWordFragment($wordFragmentsValues, array('type' => $type, 'target' => 'header'));
            }
        } elseif ($target == 'footer') {
            // if the content has WordFragments, replace each WordFragment by a plain placeholder. This holder
            // is replaced by the WordFragment value using the replaceVariableByWordFragment method
            $wordFragmentsValues = array();
            $this->replaceListWordFragments($wordFragmentsValues, $listValues);

            $xpathFooters = simplexml_import_dom($this->_contentTypeT);
            $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
            $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
            foreach ($xpathFootersResults as $footersResults) {
                $footer = substr($footersResults['PartName'], 1);
                $loadContent = $this->getFromZip($footer);
                if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                    $loadContent = $this->_modifiedHeadersFooters[$footer];
                }
                if (!empty($loadContent)) {
                    if (!$this->_preprocessed) {
                        $loadContent = $this->repairVariables(array($variable => ''), $loadContent);
                    }
                    if (PHP_VERSION_ID < 80000) {
                        $optionEntityLoader = libxml_disable_entity_loader(true);
                    }
                    $dom = simplexml_load_string($loadContent);
                    if (PHP_VERSION_ID < 80000) {
                        libxml_disable_entity_loader($optionEntityLoader);
                    }
                    $dom->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                    $search = $this->_templateSymbolStart . $variable . $this->_templateSymbolEnd;
                    $query = '//w:p[w:r/w:t[text()[contains(., "' . $search . '")]]]';
                    if ($firstMatch) {
                        $query = '(' . $query . ')[1]';
                    }

                    $foundNodes = $dom->xpath($query);
                    foreach ($foundNodes as $node) {
                        $domNode = dom_import_simplexml($node);
                        $numIlvlNode = $domNode->getElementsByTagName('ilvl');
                        if ($numIlvlNode->length > 0) {
                            $this->replaceListValues($search, $domNode, $listValues, (int)$numIlvlNode->item(0)->getAttribute('w:val'), $options);
                        } else {
                            $this->replaceListValues($search, $domNode, $listValues, 0, $options);
                        }
                        $domNode->parentNode->removeChild($domNode);
                    }
                    $stringDoc = $dom->asXML();
                    if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                        $stringDoc = str_replace('__PHX=__LINEBREAK__', '</w:t><w:br/><w:t xml:space="preserve">', $stringDoc);
                        $dom = simplexml_load_string($stringDoc);
                    }

                    $this->_modifiedHeadersFooters[$footer] = $stringDoc;
                    $this->saveToZip($dom, $footer);
                }
            }

            // replace existing WordFragment placeholders
            if (count($wordFragmentsValues) > 0) {
                $this->replaceVariableByWordFragment($wordFragmentsValues, array('type' => $type, 'target' => 'footer'));
            }
        }
    }

    /**
     * Replaces list values in a recursive way
     *
     * @access public
     * @param string $search
     * @param DOMNode $domNode
     * @param array $listValues
     * @param int $level
     * @param array $options
     */
    protected function replaceListValues($search, $domNode, $listValues, $level = 0, $options = array()) {
        foreach ($listValues as $key => $value) {
            if (is_array($value)) {
                $this->replaceListValues($search, $domNode, $value, $level + 1, $options);
            } else {
                $newNode = $domNode->cloneNode(true);
                $textNodes = $newNode->getElementsBytagName('t');
                foreach ($textNodes as $text) {
                    $sxText = simplexml_import_dom($text);
                    $strNode = (string) $sxText;
                    if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                        //parse $val for \n\r, \r\n, \n or \r and carriage returns
                        $value = str_replace(array('\n\r', '\r\n', '\n', '\r', "\n\r", "\r\n", "\n", "\r"), '__PHX=__LINEBREAK__', $value);
                    }
                    $strNodeReplaced = str_replace($search, $value, $strNode);
                    $sxText[0] = $strNodeReplaced;
                }
                $numIlvlNode = $newNode->getElementsByTagName('ilvl');
                if ($numIlvlNode->length > 0) {
                    $numIlvlNode->item(0)->setAttribute('w:val', $level);
                }
                $domNode->parentNode->insertBefore($newNode, $domNode);
            }
        }
    }

    /**
     * Replaces list WordFragment values in a recursive way
     *
     * @access public
     * @param array $wordFragmentsValues
     * @param array $listValues
     */
    protected function replaceListWordFragments(&$wordFragmentsValues, &$listValues) {
        foreach ($listValues as $listKey => &$listValue) {
            if (is_array($listValue)) {
                $this->replaceListWordFragments($wordFragmentsValues, $listValue);
            } else if ($listValue instanceof WordFragment) {
                $uniqueId = uniqid((string)mt_rand(999, 9999));
                $uniqueKey = $this->_templateSymbolStart . $uniqueId . $this->_templateSymbolEnd;
                $wordFragmentsValues[$uniqueId] = $listValues[$listKey];
                $listValues[$listKey] = $uniqueKey;
            }
        }
    }

    /**
     * Replaces a placeholder image by an external image
     *
     * @access public
     * @param string $variable this variable uniquely identifies the image we want to replace
     * @param mixed $src path to the image, stream, base64 or resource
     * @param array $options
     * 'firstMatch' (bool) if true it only replaces the first variable match. Default is set to false.
     * 'target' (string) document, header, footer, footnote, endnote, comment
     * 'width' (mixed) the value in cm (float) or 'auto' (use image size), 0 to not change the previous size
     * 'height' (mixed) the value in cm (float) or 'auto' (use image size), 0 to not change the previous size
     * 'dpi' (int) dots per inch. This parameter is only taken into account if width or height are set to auto.
     * 'mime' (string) forces a mime (image/jpg, image/jpeg, image/png, image/gif)
     * 'replaceShapes' (bool): default as false. If true, replace images in shapes too
     * 'resourceMode' (bool) if true, uses src as image resource. The image resource is transformed to PNG automatically. Default as false
     * 'streamMode' (bool) if true, uses src path as stream. PHP 5.4 or greater needed to autodetect the mime type; otherwise set it using mime option. Default as false
     * If any of these formatting parameters is not set, the width and/or height of the placeholder image will be preserved
     */
    public function replacePlaceholderImage($variable, $src, $options = array())
    {
        if (isset($options['target'])) {
            $target = $options['target'];
        } else {
            $target = 'document';
        }

        if ($target == 'document') {
            $loadContent = $this->_documentXMLElement . '<w:body>' .
                    $this->_wordDocumentC . '</w:body></w:document>';
            $stringDoc = $this->Image4Image($variable, $src, $loadContent, $options)->saveXML();
            $bodyTag = explode('<w:body>', $stringDoc);
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        } else if ($target == 'footnote') {
            $dom = $this->Image4Image($variable, $src, $this->_wordFootnotesT->saveXML(), $options, $target)->saveXML();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $this->_wordFootnotesT->loadXML($dom);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
        } else if ($target == 'endnote') {
            $dom = $this->Image4Image($variable, $src, $this->_wordEndnotesT->saveXML(), $options, $target)->saveXML();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $this->_wordEndnotesT->loadXML($dom);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
        } else if ($target == 'comment') {
            $dom = $this->Image4Image($variable, $src, $this->_wordCommentsT->saveXML(), $options, $target)->saveXML();
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $this->_wordCommentsT->loadXML($dom);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
        } else if ($target == 'header') {
            $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
            $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
            $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
            foreach ($xpathHeadersResults as $headersResults) {
                $header = substr($headersResults['PartName'], 1);
                $rels = substr($header, 5);
                $rels = substr($rels, 0, -4);
                $loadContent = $this->getFromZip($header);
                if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                    $loadContent = $this->_modifiedHeadersFooters[$header];
                }
                if (!empty($loadContent)) {
                    $dom = $this->Image4Image($variable, $src, $loadContent, $options, $rels);
                    $this->_modifiedHeadersFooters[$header] = $dom->saveXML();
                    $this->saveToZip($dom, $header);
                }
            }
        } else if ($target == 'footer') {
            $xpathFooters = simplexml_import_dom($this->_contentTypeT);
            $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
            $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
            foreach ($xpathFootersResults as $footersResults) {
                $footer = substr($footersResults['PartName'], 1);
                $rels = substr($footer, 5);
                $rels = substr($rels, 0, -4);
                $loadContent = $this->getFromZip($footer);
                if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                    $loadContent = $this->_modifiedHeadersFooters[$footer];
                }
                if (!empty($loadContent)) {
                    $dom = $this->Image4Image($variable, $src, $loadContent, $options, $rels);
                    $this->_modifiedHeadersFooters[$footer] = $dom->saveXML();
                    $this->saveToZip($dom, $footer);
                }
            }
        }
    }

    /**
     * Do the actual substitution of the variables in a 'table set of rows'
     *
     * @access public
     * @param array $vars
     * @param array $options
     * 'target': document (default), header, footer
     * 'firstMatch' (bool) if true it only replaces the first variable match. Default is set to false.
     * 'parseLineBreaks' (bool) if true (default is false) parses the line breaks to include them in the Word document
     * 'type' (string) inline or block (default); used by WordFragment values
     * 'addExtraSiblingNodes' (bool) if true (default is false) parses and adds nodes between placeholders that don't have placeholders
     */
    public function replaceTableVariable($vars, $options = array())
    {
        if (isset($options['firstMatch'])) {
            $firstMatch = $options['firstMatch'];
        } else {
            $firstMatch = false;
        }

        $type = 'block';
        if (isset($options['type'])) {
            $type = $options['type'];
        }

        if (isset($options['target'])) {
            $target = $options['target'];
        } else {
            $target = 'document';
        }

        if ($target == 'document') {
            $varKeys = array_keys($vars[0]);
            // build an array to clean the table variables
            $toRepair = array();
            foreach ($varKeys as $key => $value) {
                $toRepair[$value] = '';
            }
            $loadContent = $this->_documentXMLElement . '<w:body>' .
                    $this->_wordDocumentC . '</w:body></w:document>';
            if (!$this->_preprocessed) {
                $loadContent = $this->repairVariables($toRepair, $loadContent);
            }
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $dom = simplexml_load_string($loadContent);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
            $dom->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
            $search = array();
            for ($j = 0; $j < count($varKeys); $j++) {
                $search[$j] = $this->_templateSymbolStart . $varKeys[$j] . $this->_templateSymbolEnd;
            }
            $queryArray = array();
            for ($j = 0; $j < count($search); $j++) {
                $queryArray[$j] = '//w:tr[w:tc/w:p/w:r/w:t[text()[contains(., "' . $search[$j] . '")]]]';
            }
            $query = join(' | ', $queryArray);
            $foundNodes = $dom->xpath($query);
            $tableCounter = 0;
            $referenceNode = '';
            $parentNode = '';

            // if the content has WordFragments, replace each WordFragment by a plain placeholder. This holder
            // is replaced by the WordFragment value using the replaceVariableByWordFragment method
            $wordFragmentsValues = array();
            foreach ($vars as &$varsRow) {
                foreach ($varsRow as $varKeyRow => $varValueRow) {
                    if ($varValueRow instanceof WordFragment) {
                        $uniqueId = uniqid((string)mt_rand(999, 9999));
                        $uniqueKey = $this->_templateSymbolStart . $uniqueId . $this->_templateSymbolEnd;
                        $wordFragmentsValues[$uniqueId] = $varsRow[$varKeyRow];
                        $varsRow[$varKeyRow] = $uniqueKey;
                    }
                }
            }

            if (isset($options['addExtraSiblingNodes']) && $options['addExtraSiblingNodes']) {
                $foundDomNodes = array();
                foreach ($foundNodes as $node) {
                    $domNode = dom_import_simplexml($node);
                    if (!$parentNode || !$domNode->parentNode->isSameNode($parentNode)) {
                        $parentNode = $domNode->parentNode;
                    } else {
                        while (!($domNode->isSameNode($previousNextNode))) {
                            $foundDomNodes[] = $previousNextNode;
                            $previousNextNode = $previousNextNode->nextSibling;
                        }
                    }
                    $previousNextNode = $domNode->nextSibling;
                    $foundDomNodes[] = $domNode;
                }
                $foundNodes = $foundDomNodes;
            }

            foreach ($vars as $key => $rowValue) {
                $tableCounter = 0;
                foreach ($foundNodes as $node) {
                    $domNode = dom_import_simplexml($node);
                    if (!is_object($referenceNode) || !$domNode->parentNode->isSameNode($parentNode)) {
                        $referenceNode = $domNode;
                        $parentNode = $domNode->parentNode;
                        $tableCounter++;
                    }
                    if (!$firstMatch || ($firstMatch && $tableCounter < 2)) {
                        $newNode = $domNode->cloneNode(true);
                        $textNodes = $newNode->getElementsBytagName('t');
                        foreach ($textNodes as $text) {
                            for ($k = 0; $k < count($search); $k++) {
                                $sxText = simplexml_import_dom($text);
                                $strNode = (string) $sxText;
                                if (!empty($rowValue[$varKeys[$k]]) ||
                                        $rowValue[$varKeys[$k]] === 0 ||
                                        $rowValue[$varKeys[$k]] === "0") {
                                    if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                                        //parse $val for \n\r, \r\n, \n or \r and carriage returns
                                        $rowValue[$varKeys[$k]] = str_replace(array('\n\r', '\r\n', '\n', '\r', "\n\r", "\r\n", "\n", "\r"), '__PHX=__LINEBREAK__', $rowValue[$varKeys[$k]]);
                                    }
                                    $strNode = str_replace($search[$k], $rowValue[$varKeys[$k]], $strNode);
                                } else {
                                    $strNode = str_replace($search[$k], '', $strNode);
                                }
                                $sxText[0] = $strNode;
                            }
                        }
                        $parentNode->insertBefore($newNode, $referenceNode);
                    }
                }
            }
            //Remove the original nodes
            $tableCounter2 = 0;
            foreach ($foundNodes as $node) {
                $domNode = dom_import_simplexml($node);
                if ($firstMatch && !$domNode->parentNode->isSameNode($parentNode)) {
                    $parentNode = $domNode->parentNode;
                    $tableCounter2++;
                }
                if ($tableCounter2 < 2) {
                    $domNode->parentNode->removeChild($domNode);
                }
            }

            $stringDoc = $dom->asXML();
            $bodyTag = explode('<w:body>', $stringDoc);
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                $this->_wordDocumentC = str_replace('__PHX=__LINEBREAK__', '</w:t><w:br/><w:t xml:space="preserve">', $this->_wordDocumentC);
            }

            // replace existing WordFragment placeholders
            if (count($wordFragmentsValues) > 0) {
                $this->replaceVariableByWordFragment($wordFragmentsValues, array('type' => $type));
            }
        } elseif ($target == 'header') {
            $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
            $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
            $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
            foreach ($xpathHeadersResults as $headersResults) {
                $header = substr($headersResults['PartName'], 1);
                $loadContent = $this->getFromZip($header);
                if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                    $loadContent = $this->_modifiedHeadersFooters[$header];
                }
                if (!empty($loadContent)) {
                    $varKeys = array_keys($vars[0]);
                    //We build an array to clean the table variables
                    $toRepair = array();
                    foreach ($varKeys as $key => $value) {
                        $toRepair[$value] = '';
                    }

                    if (!$this->_preprocessed) {
                        $loadContent = $this->repairVariables($toRepair, $loadContent);
                    }
                    if (PHP_VERSION_ID < 80000) {
                        $optionEntityLoader = libxml_disable_entity_loader(true);
                    }
                    $dom = simplexml_load_string($loadContent);
                    if (PHP_VERSION_ID < 80000) {
                        libxml_disable_entity_loader($optionEntityLoader);
                    }
                    $dom->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                    $search = array();
                    for ($j = 0; $j < count($varKeys); $j++) {
                        $search[$j] = $this->_templateSymbolStart . $varKeys[$j] . $this->_templateSymbolEnd;
                    }
                    $queryArray = array();
                    for ($j = 0; $j < count($search); $j++) {
                        $queryArray[$j] = '//w:tr[w:tc/w:p/w:r/w:t[text()[contains(., "' . $search[$j] . '")]]]';
                    }
                    $query = join(' | ', $queryArray);
                    $foundNodes = $dom->xpath($query);
                    $tableCounter = 0;
                    $referenceNode = '';
                    $parentNode = '';

                    // if the content has WordFragments, replace each WordFragment by a plain placeholder. This holder
                    // is replaced by the WordFragment value using the replaceVariableByWordFragment method
                    $wordFragmentsValues = array();
                    foreach ($vars as &$varsRow) {
                        foreach ($varsRow as $varKeyRow => $varValueRow) {
                            if ($varValueRow instanceof WordFragment) {
                                $uniqueId = uniqid((string)mt_rand(999, 9999));
                                $uniqueKey = $this->_templateSymbolStart . $uniqueId . $this->_templateSymbolEnd;
                                $wordFragmentsValues[$uniqueId] = $varsRow[$varKeyRow];
                                $varsRow[$varKeyRow] = $uniqueKey;
                            }
                        }
                    }

                    foreach ($vars as $key => $rowValue) {
                        foreach ($foundNodes as $node) {
                            $domNode = dom_import_simplexml($node);
                            if (!is_object($referenceNode) || !$domNode->parentNode->isSameNode($parentNode)) {
                                $referenceNode = $domNode;
                                $parentNode = $domNode->parentNode;
                                $tableCounter++;
                            }
                            if (!$firstMatch || ($firstMatch && $tableCounter < 2)) {
                                $newNode = $domNode->cloneNode(true);
                                $textNodes = $newNode->getElementsBytagName('t');
                                foreach ($textNodes as $text) {
                                    for ($k = 0; $k < count($search); $k++) {
                                        $sxText = simplexml_import_dom($text);
                                        $strNode = (string) $sxText;
                                        if (!empty($rowValue[$varKeys[$k]]) ||
                                                $rowValue[$varKeys[$k]] === 0 ||
                                                $rowValue[$varKeys[$k]] === "0") {
                                            if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                                                //parse $val for \n\r, \r\n, \n or \r and carriage returns
                                                $rowValue[$varKeys[$k]] = str_replace(array('\n\r', '\r\n', '\n', '\r', "\n\r", "\r\n", "\n", "\r"), '__PHX=__LINEBREAK__', $rowValue[$varKeys[$k]]);
                                            }
                                            $strNode = str_replace($search[$k], $rowValue[$varKeys[$k]], $strNode);
                                        } else {
                                            $strNode = str_replace($search[$k], '', $strNode);
                                        }
                                        $sxText[0] = $strNode;
                                    }
                                }
                                $parentNode->insertBefore($newNode, $referenceNode);
                            }
                        }
                    }
                    //Remove the original nodes
                    $tableCounter2 = 0;
                    foreach ($foundNodes as $node) {
                        $domNode = dom_import_simplexml($node);
                        if ($firstMatch && !$domNode->parentNode->isSameNode($parentNode)) {
                            $parentNode = $domNode->parentNode;
                            $tableCounter2++;
                        }
                        if ($tableCounter2 < 2) {
                            $domNode->parentNode->removeChild($domNode);
                        }
                    }

                    $stringDoc = $dom->asXML();
                    if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                        $stringDoc = str_replace('__PHX=__LINEBREAK__', '</w:t><w:br/><w:t xml:space="preserve">', $stringDoc);
                        $dom = simplexml_load_string($stringDoc);
                    }

                    $this->_modifiedHeadersFooters[$header] = $stringDoc;
                    $this->saveToZip($dom, $header);

                    // replace existing WordFragment placeholders
                    if (count($wordFragmentsValues) > 0) {
                        $this->replaceVariableByWordFragment($wordFragmentsValues, array('type' => $type, 'target' => 'header'));
                    }
                }
            }
        } elseif ($target == 'footer') {
            $varKeys = array_keys($vars[0]);
            //We build an array to clean the table variables
            $toRepair = array();
            foreach ($varKeys as $key => $value) {
                $toRepair[$value] = '';
            }

            $xpathFooters = simplexml_import_dom($this->_contentTypeT);
            $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
            $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
            foreach ($xpathFootersResults as $footersResults) {
                $footer = substr($footersResults['PartName'], 1);
                $loadContent = $this->getFromZip($footer);
                if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                    $loadContent = $this->_modifiedHeadersFooters[$footer];
                }
                if (!empty($loadContent)) {
                    $varKeys = array_keys($vars[0]);
                    //We build an array to clean the table variables
                    $toRepair = array();
                    foreach ($varKeys as $key => $value) {
                        $toRepair[$value] = '';
                    }

                    if (!$this->_preprocessed) {
                        $loadContent = $this->repairVariables($toRepair, $loadContent);
                    }
                    if (PHP_VERSION_ID < 80000) {
                        $optionEntityLoader = libxml_disable_entity_loader(true);
                    }
                    $dom = simplexml_load_string($loadContent);
                    if (PHP_VERSION_ID < 80000) {
                        libxml_disable_entity_loader($optionEntityLoader);
                    }
                    $dom->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                    $search = array();
                    for ($j = 0; $j < count($varKeys); $j++) {
                        $search[$j] = $this->_templateSymbolStart . $varKeys[$j] . $this->_templateSymbolEnd;
                    }
                    $queryArray = array();
                    for ($j = 0; $j < count($search); $j++) {
                        $queryArray[$j] = '//w:tr[w:tc/w:p/w:r/w:t[text()[contains(., "' . $search[$j] . '")]]]';
                    }
                    $query = join(' | ', $queryArray);
                    $foundNodes = $dom->xpath($query);
                    $tableCounter = 0;
                    $referenceNode = '';
                    $parentNode = '';

                    // if the content has WordFragments, replace each WordFragment by a plain placeholder. This holder
                    // is replaced by the WordFragment value using the replaceVariableByWordFragment method
                    $wordFragmentsValues = array();
                    foreach ($vars as &$varsRow) {
                        foreach ($varsRow as $varKeyRow => $varValueRow) {
                            if ($varValueRow instanceof WordFragment) {
                                $uniqueId = uniqid((string)mt_rand(999, 9999));
                                $uniqueKey = $this->_templateSymbolStart . $uniqueId . $this->_templateSymbolEnd;
                                $wordFragmentsValues[$uniqueId] = $varsRow[$varKeyRow];
                                $varsRow[$varKeyRow] = $uniqueKey;
                            }
                        }
                    }

                    foreach ($vars as $key => $rowValue) {
                        foreach ($foundNodes as $node) {
                            $domNode = dom_import_simplexml($node);
                            if (!is_object($referenceNode) || !$domNode->parentNode->isSameNode($parentNode)) {
                                $referenceNode = $domNode;
                                $parentNode = $domNode->parentNode;
                                $tableCounter++;
                            }
                            if (!$firstMatch || ($firstMatch && $tableCounter < 2)) {
                                $newNode = $domNode->cloneNode(true);
                                $textNodes = $newNode->getElementsBytagName('t');
                                foreach ($textNodes as $text) {
                                    for ($k = 0; $k < count($search); $k++) {
                                        $sxText = simplexml_import_dom($text);
                                        $strNode = (string) $sxText;
                                        if (!empty($rowValue[$varKeys[$k]]) ||
                                                $rowValue[$varKeys[$k]] === 0 ||
                                                $rowValue[$varKeys[$k]] === "0") {
                                            if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                                                //parse $val for \n\r, \r\n, \n or \r and carriage returns
                                                $rowValue[$varKeys[$k]] = str_replace(array('\n\r', '\r\n', '\n', '\r', "\n\r", "\r\n", "\n", "\r"), '__PHX=__LINEBREAK__', $rowValue[$varKeys[$k]]);
                                            }
                                            $strNode = str_replace($search[$k], $rowValue[$varKeys[$k]], $strNode);
                                        } else {
                                            $strNode = str_replace($search[$k], '', $strNode);
                                        }
                                        $sxText[0] = $strNode;
                                    }
                                }
                                $parentNode->insertBefore($newNode, $referenceNode);
                            }
                        }
                    }
                    //Remove the original nodes
                    $tableCounter2 = 0;
                    foreach ($foundNodes as $node) {
                        $domNode = dom_import_simplexml($node);
                        if ($firstMatch && !$domNode->parentNode->isSameNode($parentNode)) {
                            $parentNode = $domNode->parentNode;
                            $tableCounter2++;
                        }
                        if ($tableCounter2 < 2) {
                            $domNode->parentNode->removeChild($domNode);
                        }
                    }

                    $stringDoc = $dom->asXML();
                    if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                        $stringDoc = str_replace('__PHX=__LINEBREAK__', '</w:t><w:br/><w:t xml:space="preserve">', $stringDoc);
                        $dom = simplexml_load_string($stringDoc);
                    }

                    $this->_modifiedHeadersFooters[$footer] = $stringDoc;
                    $this->saveToZip($dom, $footer);

                    // replace existing WordFragment placeholders
                    if (count($wordFragmentsValues) > 0) {
                        $this->replaceVariableByWordFragment($wordFragmentsValues, array('type' => $type, 'target' => 'footer'));
                    }
                }
            }
        }
    }

    /**
     * Replaces an array of variables by external files
     *
     * @access public
     * @param array $variables
     *  keys: variable names
     *  values: path to the external DOCX, RTF, HTML or MHT file
     * @param array $options
     * 'firstMatch' (bool) if true it only replaces the first variable match. Default is set to false.
     * 'matchSource' (bool) if true (default value)tries to preserve as much as posible the styles of the docx to be included
     * 'preprocess' (bool) if true does some preprocessing on the docx file to add
     * @throws Exception the file doesn't exist, invalid file extension
     */
    public function replaceVariableByExternalFile($variables, $options = array())
    {
        foreach ($variables as $key => $value) {
            $options['src'] = $value;
            $extension = strtoupper($this->getFileExtension($value));
            switch ($extension) {
                case 'DOCX':
                    if (!isset($options['matchSource'])) {
                        $options['matchSource'] = true;
                    }
                    $file = new WordFragment($this);
                    $file->addDOCX($options);
                    $this->replaceVariableByWordFragment(array($key => $file), $options);
                    break;
                case 'HTML':
                    $options['html'] = file_get_contents($value);
                    $file = new WordFragment($this);
                    $file->addHTML($options);
                    $this->replaceVariableByWordFragment(array($key => $file), $options);
                    break;
                case 'RTF':
                    $file = new WordFragment($this);
                    $file->addRTF($options);
                    $this->replaceVariableByWordFragment(array($key => $file), $options);
                    break;
                case 'MHT':
                    $file = new WordFragment($this);
                    $file->addMHT($options);
                    $this->replaceVariableByWordFragment(array($key => $file), $options);
                    break;
                default:
                    PhpdocxLogger::logger('Invalid file extension', 'fatal');
            }
        }
    }

    /**
     * Replace a template variable with WordML obtained from HTML via the
     * embedHTML method.
     *
     * @access public
     * @param string $var Value of the variable.
     * @param $type inline, block (default) or inline-block (available only in Premium licenses, replaces the variable keeping block elements and the placeholder styles)
     * @param string $html HTML source
     * @param array $options:
     * 'isFile' (bool),
     * 'addDefaultStyles' (bool) true as default, if false prevents adding default styles when strictWordStyles is false
     * 'baseURL' (string)
     * 'cssEntityDecode' (bool) Default as false. If true, use html_entity_decode to parse CSS, useful when using font families with not standard names such as chinese, japanese, korean and others
     * 'customListStyles' (bool) if true try to use the predefined custom lists
     * 'downloadImages' (bool),
     * 'embedFonts' (bool) default as false. If true download and embed TTF fonts from font-face styles
     * 'filter' (string) could be an string denoting the id, class or tag to be filtered.
     * If you want only a class introduce .classname, #idName for an id or <htmlTag> for a particular tag. One can also use
     * standard XPath expresions supported by PHP.
     * 'firstMatch' (bool) if true it only replaces the first variable match. Default is set to false
     * 'forceNotTidy' (bool) False as default. If true, avoid using Tidy. Only recommended if Tidy can't be installed
     * 'generateCustomListStyles' (bool) default as true. If true generates automatically the custom list styles from the list styles (decimal, lower-alpha, lower-latin, lower-roman, upper-alpha, upper-latin, upper-roman)
     * 'parseAnchors' (bool),
     * 'parseDivs' (paragraph, table): parses divs as paragraphs or tables,
     * 'parseFloats' (bool),
     * 'removeLineBreaks' (bool), if true removes line breaks that can be generated when transforming HTML,
     * 'strictWordStyles' (bool) if true ignores all CSS styles and uses the styles set via the wordStyles option (see next)
     * 'stylesReplacementType' (string) usePlaceholderStyles (keep placeholder styles, styles from the imported HTML are ignored), mixPlaceholderStyles (mix placeholder styles, placeholder styles overwrite HTML styles with the same name). Applies to the following styles: pPr, rPr
     * 'stylesReplacementTypeIgnore' (array) styles to be ignored from the imported HTML. Use with mixPlaceholderStyles
     * 'stylesReplacementTypeOverwrite' (bool) if true, overwrite the placeholder styles don't set in stylesReplacementTypeIgnore. Use with mixPlaceholderStyles. Default as false
     * 'target': document, header, footer, footnote, endnote, comment
     * 'useHTMLExtended' (bool)  if true uses HTML extended tags. Default as false
     * 'wordStyles' (array) associates a particular class, id or HTML tag to a Word style
     * @throws Exception PHP Tidy is not available and forceNotTidy is false
     */
    public function replaceVariableByHTML($var, $type = 'block', $html = '<html><body></body></html>', $options = array())
    {
        if (!isset($options['forceNotTidy'])) {
            $options['forceNotTidy'] = false;
        }

        if (!extension_loaded('tidy') && !$options['forceNotTidy']) {
            throw new Exception('Install and enable Tidy for PHP (https://php.net/manual/en/book.tidy.php) to transform HTML to DOCX.');
        }

        if (isset($options['target'])) {
            $target = $options['target'];
        } else {
            $target = 'document';
        }
        if (isset($options['firstMatch'])) {
            $firstMatch = $options['firstMatch'];
        } else {
            $firstMatch = false;
        }
        $options['type'] = $type;
        $htmlFragment = new WordFragment($this, $target);
        $htmlFragment->embedHTML($html, $options);

        $this->replaceVariableByWordFragment(array($var => $htmlFragment), $options);
    }

    /**
     * Replaces an array of variables by their values
     *
     * @access public
     * @param array $variables
     *  keys: variable names
     *  values: text we want to insert
     * @param array $options
     * 'target': document (default), header, footer, footnote, endnote, comment
     * 'firstMatch' (bool) if true it only replaces the first variable match. Default is set to false.
     * 'parseLineBreaks' (bool) if true (default is false) parses the line breaks to include them in the Word document
     * 'raw' (bool) if true (default is false) replaces the variable by a string regardless the variable scope (tag values, attributes...).
     *     Only allows to replace a variable by a plain string. Use with caution
     */
    public function replaceVariableByText($variables, $options = array())
    {
        if (isset($options['target'])) {
            $target = $options['target'];
        } else {
            $target = 'document';
        }

        if (isset($options['raw']) && $options['raw'] === true) {
            foreach ($variables as $keyVariable => $valueVariable) {
                if ($target == 'document') {
                    $this->_wordDocumentC = str_replace($this->_templateSymbolStart . $keyVariable . $this->_templateSymbolEnd, $valueVariable, $this->_wordDocumentC);
                } else if ($target == 'footnote') {
                    $newFootnotesTXML = str_replace($this->_templateSymbolStart . $keyVariable . $this->_templateSymbolEnd, $valueVariable, $this->_wordFootnotesT->saveXML());
                    $this->_wordFootnotesT->loadXML($newFootnotesTXML);
                } else if ($target == 'endnote') {
                    $newEndnotesTXML = str_replace($this->_templateSymbolStart . $keyVariable . $this->_templateSymbolEnd, $valueVariable, $this->_wordEndnotesT->saveXML());
                    $this->_wordEndnotesT->loadXML($newEndnotesTXML);
                } else if ($target == 'comment') {
                    $newCommentsTXML = str_replace($this->_templateSymbolStart . $keyVariable . $this->_templateSymbolEnd, $valueVariable, $this->_wordCommentsT->saveXML());
                    $this->_wordCommentsT->loadXML($newCommentsTXML);
                } else if ($target == 'header') {
                    $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
                    $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                    $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
                    foreach ($xpathHeadersResults as $headersResults) {
                        $header = substr($headersResults['PartName'], 1);
                        $loadContent = $this->getFromZip($header);
                        if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                            $loadContent = $this->_modifiedHeadersFooters[$header];
                        }
                        if (!empty($loadContent)) {
                            $newHeaderTXML = str_replace($this->_templateSymbolStart . $keyVariable . $this->_templateSymbolEnd, $valueVariable, $loadContent);
                            $this->_modifiedHeadersFooters[$header] = $newHeaderTXML;
                            $this->saveToZip($newHeaderTXML, $header);
                        }
                    }
                } else if ($target == 'footer') {
                    $xpathFooters = simplexml_import_dom($this->_contentTypeT);
                    $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                    $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
                    foreach ($xpathFootersResults as $footersResults) {
                        $footer = substr($footersResults['PartName'], 1);
                        $loadContent = $this->getFromZip($footer);
                        if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                            $loadContent = $this->_modifiedHeadersFooters[$footer];
                        }
                        if (!empty($loadContent)) {
                            $newFooterTXML = str_replace($this->_templateSymbolStart . $keyVariable . $this->_templateSymbolEnd, $valueVariable, $loadContent);
                            $this->_modifiedHeadersFooters[$footer] = $newFooterTXML;
                            $this->saveToZip($newFooterTXML, $footer);
                        }
                    }
                }
            }
        } else {
            if ($target == 'document') {
                $loadContent = $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>';
                $dom = $this->variable2Text($variables, $loadContent, $options);
                $stringDoc = $dom->asXML();
                $bodyTag = explode('<w:body>', $stringDoc);
                $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
            } else if ($target == 'footnote') {
                $dom = $this->variable2Text($variables, $this->_wordFootnotesT->saveXML(), $options)->saveXML();
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $this->_wordFootnotesT->loadXML($dom);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
            } else if ($target == 'endnote') {
                $dom = $this->variable2Text($variables, $this->_wordEndnotesT->saveXML(), $options)->saveXML();
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $this->_wordEndnotesT->loadXML($dom);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
            } else if ($target == 'comment') {
                $dom = $this->variable2Text($variables, $this->_wordCommentsT->saveXML(), $options)->saveXML();
                if (PHP_VERSION_ID < 80000) {
                    $optionEntityLoader = libxml_disable_entity_loader(true);
                }
                $this->_wordCommentsT->loadXML($dom);
                if (PHP_VERSION_ID < 80000) {
                    libxml_disable_entity_loader($optionEntityLoader);
                }
            } else if ($target == 'header') {
                $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
                $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
                foreach ($xpathHeadersResults as $headersResults) {
                    $header = substr($headersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($header);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$header])) {
                        $loadContent = $this->_modifiedHeadersFooters[$header];
                    }
                    if (!empty($loadContent)) {
                        $dom = $this->variable2Text($variables, $loadContent, $options);
                        $this->_modifiedHeadersFooters[$header] = $dom->saveXML();
                        $this->saveToZip($dom, $header);
                    }
                }
            } else if ($target == 'footer') {
                $xpathFooters = simplexml_import_dom($this->_contentTypeT);
                $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
                $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
                foreach ($xpathFootersResults as $footersResults) {
                    $footer = substr($footersResults['PartName'], 1);
                    $loadContent = $this->getFromZip($footer);
                    if (empty($loadContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                        $loadContent = $this->_modifiedHeadersFooters[$footer];
                    }
                    if (!empty($loadContent)) {
                        $dom = $this->variable2Text($variables, $loadContent, $options);
                        $this->_modifiedHeadersFooters[$footer] = $dom->saveXML();
                        $this->saveToZip($dom, $footer);
                    }
                }
            }
        }
    }

    /**
     * Replaces an array of variables by Word Fragments
     *
     * @access public
     * @param array $variables
     *  keys: variable names
     *  values: instances of the WordFragment or DOCXPath result objects
     * @param array $options
     * 'target' (string) document (default), header, footer, footnote, endnote or comment
     * 'firstMatch' (bool) if true it only replaces the first variable match. Default is set to false.
     * 'stylesReplacementType' (string) usePlaceholderStyles (keep placeholder styles, styles from the imported HTML are ignored), mixPlaceholderStyles (mix placeholder styles, placeholder styles overwrite HTML styles with the same name). Applies to the following styles: pPr, rPr
     * 'stylesReplacementTypeIgnore' (array) styles to be ignored from the imported WordFragment. Use with mixPlaceholderStyles
     * 'stylesReplacementTypeOverwrite' (bool) if true, overwrite the placeholder styles don't set in stylesReplacementTypeIgnore. Use with mixPlaceholderStyles. Default as false
     * 'type' (string) inline (only replaces the variable), block (default, removes the variable and its containing paragraph), inline-block (available only in Premium licenses, replaces the variable keeping block elements and the placeholder styles)
     */
    public function replaceVariableByWordFragment($variables, $options = array())
    {
        if (isset($options['firstMatch'])) {
            $firstMatch = $options['firstMatch'];
        } else {
            $firstMatch = false;
        }
        if (isset($options['target'])) {
            $target = $options['target'];
        } else {
            $target = 'document';
        }
        if (isset($options['type'])) {
            $type = $options['type'];
        } else {
            $type = 'block';
        }

        if ($target == 'document') {
            $loadContent = $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>';
            $stringDoc = $this->variable4WordFragment($variables, $type, $loadContent, $firstMatch, $options);
            $bodyTag = explode('<w:body>', $stringDoc);
            $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
        } else if ($target == 'footnote') {
            $stringDoc = $this->variable4WordFragment($variables, $type, $this->_wordFootnotesT->saveXML(), $firstMatch, $options);
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $this->_wordFootnotesT->loadXML($stringDoc);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
        } else if ($target == 'endnote') {
            $stringDoc = $this->variable4WordFragment($variables, $type, $this->_wordEndnotesT->saveXML(), $firstMatch, $options);
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $this->_wordEndnotesT->loadXML($stringDoc);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
        } else if ($target == 'comment') {
            $stringDoc = $this->variable4WordFragment($variables, $type, $this->_wordCommentsT->saveXML(), $firstMatch, $options);
            if (PHP_VERSION_ID < 80000) {
                $optionEntityLoader = libxml_disable_entity_loader(true);
            }
            $this->_wordCommentsT->loadXML($stringDoc);
            if (PHP_VERSION_ID < 80000) {
                libxml_disable_entity_loader($optionEntityLoader);
            }
        } else if ($target == 'header') {
            $xpathHeaders = simplexml_import_dom($this->_contentTypeT);
            $xpathHeaders->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
            $xpathHeadersResults = $xpathHeaders->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"]');
            foreach ($xpathHeadersResults as $headersResults) {
                foreach ($variables as $keyVariable => $valueVariable) {
                    $header = substr($headersResults['PartName'], 1);
                    $headerContent = $this->getFromZip($header);
                    if (empty($headerContent) && isset($this->_modifiedHeadersFooters[$header])) {
                        $headerContent = $this->_modifiedHeadersFooters[$header];
                    }
                    if (!empty($headerContent)) {
                        $headerName = explode('/', $header);
                        $domHeader = $this->variableHeaderFooterByWordFragments(array($keyVariable => $valueVariable), $type, $headerName[1], $headerContent, $firstMatch, $options);
                        $this->_modifiedHeadersFooters[$header] = $domHeader;
                        $this->saveToZip($domHeader, $header);
                    }
                }
            }
        } else if ($target == 'footer') {
            $xpathFooters = simplexml_import_dom($this->_contentTypeT);
            $xpathFooters->registerXPathNamespace('ns', 'http://schemas.openxmlformats.org/package/2006/content-types');
            $xpathFootersResults = $xpathFooters->xpath('ns:Override[@ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"]');
            foreach ($xpathFootersResults as $footersResults) {
                foreach ($variables as $keyVariable => $valueVariable) {
                    $footer = substr($footersResults['PartName'], 1);
                    $footerContent = $this->getFromZip($footer);
                    if (empty($footerContent) && isset($this->_modifiedHeadersFooters[$footer])) {
                        $footerContent = $this->_modifiedHeadersFooters[$footer];
                    }
                    if (!empty($footerContent)) {
                        $footerName = explode('/', $footer);
                        $domFooter = $this->variableHeaderFooterByWordFragments(array($keyVariable => $valueVariable), $type, $footerName[1], $footerContent, $firstMatch, $options);
                        $this->_modifiedHeadersFooters[$footer] = $domFooter;
                        $this->saveToZip($domFooter, $footer);
                    }
                }
            }
        }
    }

    /**
     * Replaces an array of variables by plain WordML
     * WARNING: the system does not validate the WordML against any scheme so
     * you have to make sure by your own that the used WORDML is correctly encoded
     * and moreover has NO relationships that require to modify the rels files.
     *
     * @access public
     * @param array $variables
     *  keys: variable names
     *  values: WordML code
     * @param array $options
     * 'firstMatch' (bool) if true it only replaces the first variable match. Default is set to false.
     * 'type': inline (only replaces the variable) or block (removes the variable and its containing paragraph)
     * 'target': document (default). By the time being header, footer, footnote, endnote, comment are not supported
     */
    public function replaceVariableByWordML($variables, $options = array('type' => 'block'))
    {
        $counter = 0;
        foreach ($variables as $key => $value) {
            ${'wf_' . $counter} = new WordFragment();
            ${'wf_' . $counter}->addRawWordML($value);
            $variables[$key] = ${'wf_' . $counter};
            $counter++;
        }
        $this->replaceVariableByWordFragment($variables, $options);
    }

    /**
     * Checks or unchecks template checkboxes
     *
     * @access public
     * @param array $variables
     *  keys: variable names
     *  values: 1 (check), 0 (uncheck)
     */
    public function tickCheckboxes($variables)
    {
        $loadContent = $this->_documentXMLElement . '<w:body>' . $this->_wordDocumentC . '</w:body></w:document>';
        $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);
        $docXPath = new DOMXPath($domDocument);
        $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $docXPath->registerNamespace('w14', 'http://schemas.microsoft.com/office/word/2010/wordml');
        foreach ($variables as $var => $value) {
            if (empty($value)) {
                $value = 0;
            } else {
                $value = 1;
            }
            //First we check for legacy checkboxes
            $searchTerm = $this->_templateSymbolStart . $var . $this->_templateSymbolEnd;
            $queryDoc = '//w:ffData[w:statusText[@w:val="' . $searchTerm . '"]]';
            $affectedNodes = $docXPath->query($queryDoc);
            foreach ($affectedNodes as $node) {
                $nodeVals = $node->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'default');
                $nodeVals->item(0)->setAttribute('w:val', $value);
            }
            //Now we look for Word 2010 sdt checkboxes
            $queryDoc = '//w:sdtPr[w:tag[@w:val="' . $searchTerm . '"]]';
            $affectedNodes = $docXPath->query($queryDoc);
            foreach ($affectedNodes as $node) {
                $nodeVals = $node->getElementsByTagNameNS('http://schemas.microsoft.com/office/word/2010/wordml', 'checked');
                $nodeVals->item(0)->setAttribute('w14:val', $value);
                //Now change the selected symbol for checked or unchecked
                $sdt = $node->parentNode;
                $txt = $sdt->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 't');
                if ($value == 1) {
                    $txt->item(0)->nodeValue = '☒';
                } else {
                    $txt->item(0)->nodeValue = '☐';
                }
            }
        }

        $stringDoc = $domDocument->saveXML();
        $bodyTag = explode('<w:body>', $stringDoc);
        $this->_wordDocumentC = str_replace('</w:body></w:document>', '', $bodyTag[1]);
    }

    /**
     * Extract the PHPDocX type variables from an existing template
     *
     * @access private
     */
    private function extractVariables($target, $documentSymbol, $variables)
    {
        $i = 0;
        $prefixes = array();
        foreach ($documentSymbol as $documentSymbolValue) {
            // avoid first and last values and even positions
            if ($i == 0 || $i == count($documentSymbol) || $i % 2 == 0) {
                $i++;
                continue;
            } else {
                $i++;
                if (empty($prefixes)) {
                    $variables[$target][] = strip_tags($documentSymbolValue);
                } else {
                    foreach ($prefixes as $value) {
                        if (($pos = strpos($documentSymbolValue, $value, 0)) !== false) {
                            $variables[$target][] = strip_tags($documentSymbolValue);
                        }
                    }
                }
            }
        }

        return $variables;
    }

    /**
     * Extract the PHPDocX type variables that use distinct symbols from an existing template
     *
     * @access private
     */
    private function extractVariablesDistinctSymbols($target, $content, $variables)
    {
        $matches = array();
        preg_match_all('/'.self::$regExprVariableSymbols.'/msiU', $content, $matches);

        foreach ($matches[0] as $variable) {
            $variables[$target][] = str_replace(array($this->_templateSymbolStart, $this->_templateSymbolEnd), '', strip_tags($variable));
        }

        return $variables;
    }

    /**
     * Extract the PHPDocX type variables using the parse mode
     *
     * @access private
     */
    private function extractVariablesParseMode($target, $content, $variables)
    {
        $docDOM = $this->xmlUtilities->generateDomDocument($content);
        $docXPath = new DOMXPath($docDOM);
        $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $docXPath->registerNamespace('wp', 'http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing');

        $templateSymbolContents = $this->parseSymbolsTemplate();
        $templateSymbolStartContents = $templateSymbolContents['start'];
        $templateSymbolEndContents = $templateSymbolContents['end'];

        // strings
        $templateSymbolContents = array_merge($templateSymbolStartContents, $templateSymbolEndContents);
        $templateSymbolXPathQueryP = '//w:p[contains(., "'.array_shift($templateSymbolContents).'")';
        foreach ($templateSymbolContents as $templateSymbolContent) {
            $templateSymbolXPathQueryP .= ' and contains(., "'.$templateSymbolContent.'")';
        }
        $templateSymbolXPathQueryP .= ']';
        $nodesP = $docXPath->query($templateSymbolXPathQueryP);

        foreach ($nodesP as $nodeP) {
            // exclude extra txbxcontent tag in text boxes to avoid duplicated placeholders from textboxes
            if (isset($nodeP->parentNode) && $nodeP->parentNode->nodeName == 'w:txbxContent') {
                continue;
            }
            $matches = array();
            preg_match_all('/'.preg_quote($this->_templateSymbolStart, '/').self::$regExprVariableParse.preg_quote($this->_templateSymbolEnd, '/').'/msiU', $nodeP->nodeValue, $matches);
            foreach ($matches[0] as $variableMatch) {
                $variables[$target][] = str_replace(array($this->_templateSymbolStart, $this->_templateSymbolEnd), '', $variableMatch);
            }
        }

        // images
        $templateSymbolContents = array_merge($templateSymbolStartContents, $templateSymbolEndContents);
        $firstSymbol = array_shift($templateSymbolContents);
        $templateSymbolXPathQueryDocPr = '//wp:docPr[contains(@title, "'.$firstSymbol.'")';
        foreach ($templateSymbolContents as $templateSymbolContent) {
            $templateSymbolXPathQueryDocPr .= ' and contains(@title, "'.$templateSymbolContent.'")';
        }
        $templateSymbolXPathQueryDocPr .= ']|';
        $templateSymbolContents = array_merge($templateSymbolStartContents, $templateSymbolEndContents);
        $firstSymbol = array_shift($templateSymbolContents);
        $templateSymbolXPathQueryDocPr .= '//wp:docPr[contains(@descr, "'.$firstSymbol.'")';
        foreach ($templateSymbolContents as $templateSymbolContent) {
            $templateSymbolXPathQueryDocPr .= ' and contains(@descr, "'.$templateSymbolContent.'")';
        }
        $templateSymbolXPathQueryDocPr .= ']';
        $nodesDocPr = $docXPath->query($templateSymbolXPathQueryDocPr);
        foreach ($nodesDocPr as $nodeDocPr) {
            if ($nodeDocPr->hasAttribute('title')) {
                $matches = array();
                preg_match_all('/'.preg_quote($this->_templateSymbolStart, '/').self::$regExprVariableParse.preg_quote($this->_templateSymbolEnd, '/').'/msiU', $nodeDocPr->getAttribute('title'), $matches);

                foreach ($matches[0] as $variableMatch) {
                    $variables[$target][] = str_replace(array($this->_templateSymbolStart, $this->_templateSymbolEnd), '', $variableMatch);
                }
            }
            if ($nodeDocPr->hasAttribute('descr')) {
                $matches = array();
                preg_match_all('/'.preg_quote($this->_templateSymbolStart, '/').self::$regExprVariableParse.preg_quote($this->_templateSymbolEnd, '/').'/msiU', $nodeDocPr->getAttribute('descr'), $matches);

                foreach ($matches[0] as $variableMatch) {
                    $variables[$target][] = str_replace(array($this->_templateSymbolStart, $this->_templateSymbolEnd), '', $variableMatch);
                }
            }
        }

        // free DOMDocument resources
        $docDOM = null;

        return $variables;
    }

    /**
     * Gets jpg image dpi
     *
     * @access private
     * @param string $filename
     * @return array
     */
    private function getDpiJpg($filename)
    {
        $a = fopen($filename, 'r');
        $string = fread($a, 20);
        fclose($a);
        $type = hexdec(bin2hex(substr($string, 13, 1)));
        $data = bin2hex(substr($string, 14, 4));
        if ($type == 1) {
            $x = substr($data, 0, 4);
            $y = substr($data, 4, 4);
            return array(hexdec($x), hexdec($y));
        } else if ($type == 2) {
            $x = floor(hexdec(substr($data, 0, 4)) / 2.54);
            $y = floor(hexdec(substr($data, 4, 4)) / 2.54);
            return array($x, $y);
        } else {
            return array(96, 96);
        }
    }

    /**
     * Gets png image dpi
     *
     * @access private
     * @param string $filename
     * @return array
     */
    private function getDpiPng($filename)
    {
        $a = fopen($filename, 'r');

        $dpi = false;

        $buf = array();

        $x = 0;
        $y = 0;
        $units = 0;

        while (!feof($a)) {
            array_push($buf, ord(fread($a, 1)));
            if (count($buf) > 13) {
                array_shift($buf);
            }
            if (count($buf) < 13) {
                continue;
            }
            if ($buf[0] == ord('p') && $buf[1] == ord('H') && $buf[2] == ord('Y') && $buf[3] == ord('s')) {
                $x = ($buf[4] << 24) + ($buf[5] << 16) + ($buf[6] << 8) + $buf[7];
                $y = ($buf[8] << 24) + ($buf[9] << 16) + ($buf[10] << 8) + $buf[11];
                $units = $buf[12];
                break;
            }
        }

        fclose($a);

        if ($x == $y) {
            $dpi = $x;
        }

        if ($dpi != false && $units == 1) {
            // meters
            $dpi = round($dpi * 0.0254);
        }

        if ($dpi) {
            return array($dpi, $dpi);
        } else {
            return array(96, 96);
        }
    }

    /**
     * Gets the file extension
     *
     * @access private
     * @param string $filename
     * @return string
     */
    private function getFileExtension($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        return $extension;
    }

    /**
     * Replaces a placeholder images by external images
     *
     * @access public
     * @param string $variable this variable uniquely identifies the image we want to replace
     * @param mixed $src path to the substitution image or stream or base64 image
     * @param array $options
     * 'target': document, header, footer, footnote, endnote, comment
     * 'width' (mixed): the value in cm (float) or 'auto' (use image size), 0 to not change the previous size
     * 'height' (mixed): the value in cm (float) or 'auto' (use image size), 0 to not change the previous size
     * 'dpi' (int): dots per inch. This parameter is only taken into account if width or height are set to auto
     * 'replaceShapes' (bool): default as false. If true, replace images in shapes too
     * 'resourceMode' (bool) if true, uses src as image resource. The image resource is transformed to PNG automatically. Default is false
     * 'streamMode' (bool) if true, use src path as stream. Default is false
     * If any of these formatting parameters is not set, the width and/or height of the placeholder image will be preserved
     * @param string $loadContent st
     * @param string $rels
     * @return DOMDocument Object
     * @throws Exception image path is not valid, image does not exist, getimagesizefromstring not available using streamMode and mime/height/width values are not set
     */
    private function Image4Image($variable, $src, $loadContent, $options = array(), $rels = 'document')
    {
        if ((!isset($options['streamMode']) || !$options['streamMode']) && (!isset($options['resourceMode']) || !$options['resourceMode']) && !file_exists($src) && !strstr($src, 'base64,')) {
            PhpdocxLogger::logger('The ' . $src . ' path seems not to be correct. Unable to obtain image file.', 'fatal');
        }

        if (isset($options['firstMatch'])) {
            $firstMatch = $options['firstMatch'];
        } else {
            $firstMatch = false;
        }

        if (!isset($options['replaceShapes'])) {
            $options['replaceShapes'] = false;
        }

        $cx = 0;
        $cy = 0;
        $isBase64 = false;
        $isResourceMode = false;
        $extension = 'png';
        $imageStream = '';

        // file image
        if ((!isset($options['streamMode']) || !$options['streamMode']) && (!isset($options['resourceMode']) || !$options['resourceMode'])) {
            if (strstr($src, 'base64,')) {
                // check if base64
                $descrArray = explode(';base64,', $src);
                $arrayExtension = explode('/', $descrArray[0]);
                $extension = $arrayExtension[1];
                $arrayMime = explode(':', $descrArray[0]);
                $mimeType = $arrayMime[1];
                $imageStream = base64_decode($descrArray[1]);
                $isBase64 = true;
            } else if (file_exists($src)) {
                // get the name and extension of the replacement image
                $imageNameArray = explode('/', $src);
                if (count($imageNameArray) > 1) {
                    $imageName = array_pop($imageNameArray);
                } else {
                    $imageName = $src;
                }
                $imageExtensionArray = explode('.', $src);
                $extension = strtolower(array_pop($imageExtensionArray));
            } else {
                PhpdocxLogger::logger('Image does not exist.', 'fatal');
            }
        }

        // stream image
        if (isset($options['streamMode']) && $options['streamMode'] == true) {
            if (function_exists('getimagesizefromstring')) {
                $imageStream = file_get_contents($src);
                $attrImage = getimagesizefromstring($imageStream);
                $mimeType = $attrImage['mime'];

                switch ($mimeType) {
                    case 'image/gif':
                        $extension = 'gif';
                        break;
                    case 'image/jpg':
                        $extension = 'jpg';
                        break;
                    case 'image/jpeg':
                        $extension = 'jpeg';
                        break;
                    case 'image/png':
                        $extension = 'png';
                        break;
                    case 'image/bmp':
                        $extension = 'bmp';
                        break;
                    default:
                        break;
                }
            } else {
                if (!isset($options['mime']) || !isset($options['height']) || !isset($options['width'])) {
                    PhpdocxLogger::logger('getimagesizefromstring function is not available. Set mime, width and height options or use the file mode.', 'fatal');
                }
                $imageStream = file_get_contents($src);
                $attrImage = array(
                    $options['width'],
                    $options['height'],
                );
                $mimeType = $options['mime'];

                switch ($mimeType) {
                    case 'image/gif':
                        $dir['extension'] = 'gif';
                        break;
                    case 'image/jpg':
                        $dir['extension'] = 'jpg';
                        break;
                    case 'image/jpeg':
                        $dir['extension'] = 'jpeg';
                        break;
                    case 'image/png':
                        $dir['extension'] = 'png';
                        break;
                    case 'image/bmp':
                        $dir['extension'] = 'bmp';
                        break;
                    default:
                        break;
                }
            }
        }

        // resource image
        if (isset($options['resourceMode']) && $options['resourceMode']) {
            if (function_exists('getimagesizefromstring')) {
                // transform to PNG
                $extension = 'png';
                $mimeType = 'image/png';
                ob_start();
                imagepng($src);
                $imageStream = ob_get_contents();
                ob_end_clean();

                $isResourceMode = true;
            }  else {
                if (!isset($options['width']) || !isset($options['height'])) {
                    PhpdocxLogger::logger('getimagesizefromstring function is not available. Set width and height values.', 'fatal');
                }
                $extension = 'png';
                $mimeType = 'image/png';
                ob_start();
                imagepng($options['src']);
                $imageStream = ob_get_contents();
                ob_end_clean();
                $attrImage = array(
                    $options['width'],
                    $options['height'],
                );

                $isResourceMode = true;
            }
        }

        if (isset($options['mime']) && !empty($options['mime'])) {
            $mimeType = $options['mime'];
        }

        $wordScaleFactor = 360000;
        if (isset($options['dpi'])) {
            $dpiX = $options['dpi'];
            $dpiY = $options['dpi'];
        } else {
            if ((isset($options['width']) && $options['width'] == 'auto') ||
                    (isset($options['height']) && $options['height'] == 'auto')) {
                if ($extension == 'jpg' || $extension == 'jpeg') {
                    list($dpiX, $dpiY) = $this->getDpiJpg($src);
                } else if ($extension == 'png') {
                    if (isset($options['resourceMode']) && $options['resourceMode']) {
                        $dpiX = 96;
                        $dpiY = 96;
                    } else {
                        list($dpiX, $dpiY) = $this->getDpiPng($src);
                    }
                } else {
                    $dpiX = 96;
                    $dpiY = 96;
                }
                if ($dpiX == 0) {
                    $dpiX = 96;
                }
                if ($dpiY == 0) {
                    $dpiY = 96;
                }
            }
        }

        // check if a width and height have been set
        $width = 0;
        $height = 0;
        if (isset($options['width']) && $options['width'] != 'auto') {
            $cx = (int) round($options['width'] * $wordScaleFactor);
        }
        if (isset($options['height']) && $options['height'] != 'auto') {
            $cy = (int) round($options['height'] * $wordScaleFactor);
        }
        // proceed to compute the sizes if the width or height are set to auto
        if ((isset($options['width']) && $options['width'] == 'auto') ||
                (isset($options['height']) && $options['height'] == 'auto')) {
            if ((!isset($options['streamMode']) || !$options['streamMode']) && (!isset($options['resourceMode']) || !$options['resourceMode'])) {
                if ($isBase64) {
                    // base64
                    if (function_exists('getimagesizefromstring')) {
                        $realSize = getimagesizefromstring($imageStream);
                    } else {
                        if (!isset($options['width']) || !isset($options['height'])) {
                            PhpdocxLogger::logger('getimagesizefromstring function is not available. Set width and height options or use the file mode.', 'fatal');

                            $realSize = array($options['width'], $options['height']);
                        }
                    }
                } else {
                    // file content
                    $realSize = getimagesize($src);
                }
            } else {
                // stream mode or resource mode
                if (function_exists('getimagesizefromstring')) {
                    $realSize = getimagesizefromstring($imageStream);
                } else {
                    if (!isset($options['width']) || !isset($options['height'])) {
                        PhpdocxLogger::logger('getimagesizefromstring function is not available. Set width and height options or use the file mode.', 'fatal');

                        $realSize = array($options['width'], $options['height']);
                    }
                }
            }
        }
        if (isset($options['width']) && $options['width'] == 'auto') {
            $cx = (int) round($realSize[0] * 2.54 / $dpiX * $wordScaleFactor);
        }
        if (isset($options['height']) && $options['height'] == 'auto') {
            $cy = (int) round($realSize[1] * 2.54 / $dpiY * $wordScaleFactor);
        }
        $docDOM = $this->xmlUtilities->generateDomDocument($loadContent);
        $xpathImage = new DOMXPath($docDOM);
        $xpathImage->registerNamespace('wp', 'http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing');
        $domImages = $xpathImage->query('//wp:docPr[@descr="'.$this->_templateSymbolStart . $variable . $this->_templateSymbolEnd.'" or @title="'.$this->_templateSymbolStart . $variable . $this->_templateSymbolEnd.'"]');

        $imageCounter = 0;
        //create a new Id
        $id = uniqid((string)rand(99,9999999), true);
        $ind = 'rId' . $id;
        $relsCounter = 0;
        for ($i = 0; $i < $domImages->length; $i++) {
            if ($imageCounter == 0) {
                //generate new relationship
                $relString = '<Relationship Id="' . $ind . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/img' . $id . '.' . $extension . '" />';
                if ($rels == 'document') {
                    if ($relsCounter == 0) {
                        $this->generateRELATIONSHIP($ind, 'image', 'media/img' . $id . '.' . $extension);
                        $relsCounter++;
                    }
                } else if ($rels == 'footnote' || $rels == 'endnote' || $rels == 'comment') {
                    self::$_relsNotesImage[$rels][] = array('rId' => 'rId' . $id, 'name' => $id, 'extension' => $extension);
                } else {
                    $relsXML = $this->getFromZip('word/_rels/' . $rels . '.xml.rels');
                    if (empty($relsXML)){
                      $relsXML = $this->_modifiedRels['word/_rels/' . $rels . '.xml.rels'];
                    }
                    $relationship = '<Relationship Target="media/img' . $id . '.' . $extension . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Id="rId' . $id . '"/>';
                    $relsXML = str_replace('</Relationships>', $relationship . '</Relationships>', $relsXML);
                    $this->_modifiedRels['word/_rels/' . $rels . '.xml.rels'] = $relsXML;
                    $this->saveToZip($relsXML, 'word/_rels/' . $rels . '.xml.rels');
                }
                //generate content type if it does not exist yet
                $this->generateDEFAULT($extension, 'image/' . $extension);
                //modify the image data to modify the r:embed attribute
                $domImages->item($i)->parentNode
                        ->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/main', 'blip')
                        ->item(0)->setAttribute('r:embed', $ind);
                if ($cx != 0) {
                    $domImages->item($i)->parentNode
                            ->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing', 'extent')
                            ->item(0)->setAttribute('cx', $cx);
                    $xfrmNode = $domImages->item($i)->parentNode
                                    ->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/main', 'xfrm')->item(0);
                    $xfrmNode->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/main', 'ext')
                            ->item(0)->setAttribute('cx', $cx);
                }
                if ($cy != 0) {
                    $domImages->item($i)->parentNode
                            ->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing', 'extent')
                            ->item(0)->setAttribute('cy', $cy);
                    $xfrmNode = $domImages->item($i)->parentNode
                                    ->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/main', 'xfrm')->item(0);
                    $xfrmNode->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/main', 'ext')
                            ->item(0)->setAttribute('cy', $cy);
                }
                if (isset($options['firstMatch']) && $options['firstMatch']) {
                    $imageCounter++;
                    $domImages->item($i)->setAttribute('descr', '');
                    $domImages->item($i)->setAttribute('title', '');
                }
                $domImages->item($i)->setAttribute('id', rand(999999, 999999999));
            }
        }

        if (isset($options['replaceShapes']) && $options['replaceShapes']) {
            $domImagesShapes = $docDOM->getElementsByTagNameNS('urn:schemas-microsoft-com:vml', 'shape');

            $imageShapeCounter = 0;
            for ($i = 0; $i < $domImagesShapes->length; $i++) {
                if ($domImagesShapes->item($i)->getAttribute('alt') == $this->_templateSymbolStart . $variable . $this->_templateSymbolEnd && $imageShapeCounter == 0) {
                    //generate new relationship
                    $relString = '<Relationship Id="' . $ind . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/img' . $id . '.' . $extension . '" />';
                    if ($rels == 'document') {
                        if ($relsCounter == 0) {
                            $this->generateRELATIONSHIP($ind, 'image', 'media/img' . $id . '.' . $extension);
                            $relsCounter++;
                        }
                    } else if ($rels == 'footnote' || $rels == 'endnote' || $rels == 'comment') {
                        self::$_relsNotesImage[$rels][] = array('rId' => 'rId' . $id, 'name' => $id, 'extension' => $extension);
                    } else {
                        $relsXML = $this->getFromZip('word/_rels/' . $rels . '.xml.rels');
                        if (empty($relsXML)){
                          $relsXML = $this->_modifiedRels['word/_rels/' . $rels . '.xml.rels'];
                        }
                        $relationship = '<Relationship Target="media/img' . $id . '.' . $extension . '" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Id="rId' . $id . '"/>';
                        $relsXML = str_replace('</Relationships>', $relationship . '</Relationships>', $relsXML);
                        $this->_modifiedRels['word/_rels/' . $rels . '.xml.rels'] = $relsXML;
                        $this->saveToZip($relsXML, 'word/_rels/' . $rels . '.xml.rels');
                    }
                    //generate content type if it does not exist yet
                    $this->generateDEFAULT($extension, 'image/' . $extension);
                    // modify the shape data to modify the r:id attribute
                    $imageDataItem = $domImagesShapes->item($i)->getElementsByTagNameNS('urn:schemas-microsoft-com:vml', 'imagedata');
                    if ($imageDataItem) {
                        $imageDataItem->item(0)->setAttribute('r:id', $ind);

                        if (isset($options['firstMatch']) && $options['firstMatch']) {
                            $imageShapeCounter++;
                            $domImagesShapes->item($i)->setAttribute('alt', '');
                        }
                    }
                }
            }
        }

        // copy the image in the (base) template with the new name
        if ($isBase64 || $isResourceMode) {
            $this->_zipDocx->addContent('word/media/img' . $id . '.' . $extension, $imageStream);
        } else {
            $this->_zipDocx->addFile('word/media/img' . $id . '.' . $extension, $src);
        }

        return $docDOM;
    }

    /**
     * Parses the symbols used in the template
     *
     * @access private
     */
    private function parseSymbolsTemplate()
    {
        // get the placeholder symbols to parse them
        if (function_exists('mb_str_split')) {
            $templateSymbolStartContents = mb_str_split($this->_templateSymbolStart);
            $templateSymbolEndContents = mb_str_split($this->_templateSymbolEnd);
        } else {
            if (function_exists('mb_strlen')) {
                $length = mb_strlen($this->_templateSymbolStart);
                $templateSymbolStartContents = array();
                for ($i = 0; $i < $length; $i++) {
                    $templateSymbolStartContents[] = mb_substr($this->_templateSymbolStart, $i, 1);
                }
                $length = mb_strlen($this->_templateSymbolEnd);
                $templateSymbolEndContents = array();
                for ($i = 0; $i < $length; $i++) {
                    $templateSymbolEndContents[] = mb_substr($this->_templateSymbolEnd, $i, 1);
                }
            } else {
                $templateSymbolStartContents = str_split($this->_templateSymbolStart);
                $templateSymbolEndContents = str_split($this->_templateSymbolEnd);
            }
        }

        return array('start' => $templateSymbolStartContents, 'end' => $templateSymbolEndContents);
    }

    /**
     * Removes tags in string contents
     */
    private function removeTagsInContent($matches) {
        return strip_tags($matches[0]);
    }

    /**
     * Removes a template variable with its container paragraph
     *
     * @access private
     * @param string $variableName
     * @param string $loadContent
     */
    private function removeVariableBlock($variableName, $loadContent)
    {
        if (!$this->_preprocessed) {
            $loadContent = $this->repairVariables(array($variableName => ''), $loadContent);
        }
        $domDocument = $this->xmlUtilities->generateDomDocument($loadContent);
        //Use XPath to find all paragraphs that include the variable name
        $name = $this->_templateSymbolStart . $variableName . $this->_templateSymbolEnd;
        $xpath = new DOMXPath($domDocument);
        $xpath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        $query = '//w:p[w:r/w:t[text()[contains(.,"' . $variableName . '")]]]';
        $affectedNodes = $xpath->query($query);
        foreach ($affectedNodes as $node) {
            $paragraphContents = $node->ownerDocument->saveXML($node);
            $paragraphText = strip_tags($paragraphContents);
            if (($pos = strpos($paragraphText, $name, 0)) !== false) {
                //If we remove a paragraph inside a table cell we need to take special care
                if ($node->parentNode->nodeName == 'w:tc') {
                    $tcChilds = $node->parentNode->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'p');
                    if ($tcChilds->length > 1) {
                        $node->parentNode->removeChild($node);
                    } else {
                        $emptyP = $domDocument->createElement('w:p');
                        $node->parentNode->appendChild($emptyP);
                        $node->parentNode->removeChild($node);
                    }
                } else {
                    $node->parentNode->removeChild($node);
                }
            }
        }
        $stringDoc = $domDocument->saveXML();
        return $stringDoc;
    }

    /**
     * Prepares a single PHPDocX variable for substitution
     *
     * @access private
     * @param array $variables
     * @param string $content
     * @return string
     */
    private function repairVariables($variables, $content)
    {
        if (!$this->_parseMode) {
            // default mode
            if ($this->_templateSymbolStart == $this->_templateSymbolEnd && strlen($this->_templateSymbolStart) == 1) {
                // force using preserve settings
                $preserve = true;
                // old repair code, using the same symbol for start and end
                $documentSymbol = explode($this->_templateSymbolStart, $content);
                foreach ($variables as $var => $value) {
                    foreach ($documentSymbol as $documentSymbolValue) {
                        $tempSearch = trim(strip_tags($documentSymbolValue));
                        if ($tempSearch == $var) {
                            $pos = strpos($content, $documentSymbolValue);
                            if ($pos !== false) {
                                $content = substr_replace($content, $var, $pos, strlen($documentSymbolValue));
                            }
                        }
                        if (strpos($documentSymbolValue, 'xml:space="preserve"')) {
                            $preserve = true;
                        }
                    }
                    if (isset($preserve) && $preserve) {
                        $query = '//w:t[text()[contains(., "' . $this->_templateSymbolStart . $var . $this->_templateSymbolStart . '")]]';
                        $docDOM = $this->xmlUtilities->generateDomDocument($content);
                        $docXPath = new DOMXPath($docDOM);
                        $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $affectedNodes = $docXPath->query($query);
                        foreach ($affectedNodes as $node) {
                            $space = $node->getAttribute('xml:space');
                            if (isset($space) && $space == 'preserve') {
                                //Do nothing
                            } else {
                                $str = $node->nodeValue;
                                $firstChar = $str[0];
                                if ($firstChar == ' ') {
                                    $node->nodeValue = substr($str, 1);
                                }
                                $node->setAttribute('xml:space', 'preserve');
                            }
                        }
                        $content = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . $docDOM->saveXML($docDOM->documentElement);
                        //$content = html_entity_decode($content, ENT_NOQUOTES, 'UTF-8');
                    }
                }

                return $content;
            } else {
                // new repair code, using distinct symbols for start and end
                $content = $this->repairVariablesDistinctSymbols($variables, $content);

                // force using preserve settings
                $preserve = true;
                if (isset($preserve) && $preserve) {
                    foreach ($variables as $var => $value) {
                        $query = '//w:t[text()[contains(., "' . $this->_templateSymbolStart . $var . $this->_templateSymbolEnd . '")]]';
                        $docDOM = $this->xmlUtilities->generateDomDocument($content);
                        $docXPath = new DOMXPath($docDOM);
                        $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $affectedNodes = $docXPath->query($query);
                        foreach ($affectedNodes as $node) {
                            $space = $node->getAttribute('xml:space');
                            if (isset($space) && $space == 'preserve') {
                                //Do nothing
                            } else {
                                $str = $node->nodeValue;
                                $firstChar = $str[0];
                                if ($firstChar == ' ') {
                                    $node->nodeValue = substr($str, 1);
                                }
                                $node->setAttribute('xml:space', 'preserve');
                            }
                        }
                        $content = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . $docDOM->saveXML($docDOM->documentElement);
                    }
                }

                return $content;
            }
        } else {
            // parse mode
            $docDOM = $this->xmlUtilities->generateDomDocument($content);
            $docXPath = new DOMXPath($docDOM);
            $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');

            $templateSymbolContents = $this->parseSymbolsTemplate();
            $templateSymbolStartContents = $templateSymbolContents['start'];
            $templateSymbolEndContents = $templateSymbolContents['end'];

            // strings
            $templateSymbolContents = array_merge($templateSymbolStartContents, $templateSymbolEndContents);
            $templateSymbolXPathQueryP = '//w:p[contains(., "'.array_shift($templateSymbolContents).'")';
            foreach ($templateSymbolContents as $templateSymbolContent) {
                $templateSymbolXPathQueryP .= ' and contains(., "'.$templateSymbolContent.'")';
            }
            $templateSymbolXPathQueryP .= ']';
            $nodesP = $docXPath->query($templateSymbolXPathQueryP);

            $content = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . $docDOM->saveXML($docDOM->documentElement);
            foreach ($nodesP as $nodeP) {
                $templateSymbolContents = array_merge($templateSymbolStartContents, $templateSymbolEndContents);
                $templateSymbolContentQuoted = array();
                foreach ($templateSymbolContents as $templateSymbolContent) {
                    $templateSymbolContentQuoted[] = preg_quote($templateSymbolContent, '/');
                }
                $matchesPlaceholders = array();
                $templateSymbolXPathRegExpr = implode('(.*)', $templateSymbolContentQuoted);

                // only do the repairment if the variable name exists in the text node
                $contentNodeP = $nodeP->ownerDocument->saveXML($nodeP);
                $contentNodePCleaned = strip_tags($contentNodeP);
                foreach ($variables as $var => $value) {
                    if (stripos($contentNodePCleaned, $this->_templateSymbolStart . $var . $this->_templateSymbolEnd) !== false) {
                        preg_match_all('/'.$templateSymbolXPathRegExpr.'/msiU', $contentNodeP, $matchesPlaceholders);
                        foreach ($matchesPlaceholders[0] as $matchPlaceholders) {
                            if (stripos(strip_tags($matchPlaceholders), $this->_templateSymbolStart . $var . $this->_templateSymbolEnd) !== false) {
                                $content = str_replace($matchPlaceholders, strip_tags($matchPlaceholders), $content);
                            }
                        }
                    }
                }
            }

            // force using preserve settings
            $preserve = true;
            if (isset($preserve) && $preserve) {
                foreach ($variables as $var => $value) {
                    $query = '//w:t[text()[contains(., "' . $this->_templateSymbolStart . $var . $this->_templateSymbolEnd . '")]]';
                    $docDOM = $this->xmlUtilities->generateDomDocument($content);
                    $docXPath = new DOMXPath($docDOM);
                    $docXPath->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                    $affectedNodes = $docXPath->query($query);
                    foreach ($affectedNodes as $node) {
                        $space = $node->getAttribute('xml:space');
                        if (isset($space) && $space == 'preserve') {
                            //Do nothing
                        } else {
                            $str = $node->nodeValue;
                            $firstChar = $str[0];
                            if ($firstChar == ' ') {
                                $node->nodeValue = substr($str, 1);
                            }
                            $node->setAttribute('xml:space', 'preserve');
                        }
                    }
                    $content = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . $docDOM->saveXML($docDOM->documentElement);
                }
            }

            return $content;
        }
    }

    /**
     * Prepares a single PHPDocX variable for substitution using distinct symbols
     *
     * @access private
     * @param array $variables
     * @param string $content
     * @return string
     */
    private function repairVariablesDistinctSymbols($variables, $content)
    {
        $content = preg_replace_callback('/'.self::$regExprVariableSymbols.'/msiU', array($this, 'removeTagsInContent'), $content);

        return $content;
    }

    /**
     * Replaces a single variable by a WordFragment
     *
     * @access private
     * @param string $var
     * @param WordFragment $val
     * @param string $type
     * @param string $loadContent
     * @param bool $firstMatch
     * @param array $options
     * @throws Exception not valid content
     */
    private function singleVariable4WordFragment($var, $val, $type, $loadContent, $firstMatch, $options = array())
    {
        // handle replacement styles behaviour
        if (file_exists(dirname(__FILE__) . '/WordFragmentExtended.php')) {
            if (isset($options['stylesReplacementType'])) {
                if ($options['stylesReplacementType'] == 'usePlaceholderStyles' || $options['stylesReplacementType'] == 'mixPlaceholderStyles') {
                    // clone val to avoid changing the referenced object
                    $val = clone $val;
                    $wordFragmentExtended = new WordFragmentExtended();
                    $val = $wordFragmentExtended->setStylesReplacementType($var, $val, $loadContent, $options, $this->_templateSymbolStart, $this->_templateSymbolEnd);
                }
            }
        }

        $docDOM = $this->xmlUtilities->generateDomDocument($loadContent);
        $docXpath = new DOMXPath($docDOM);

        if ($val instanceof WordFragment) {
            PhpdocxLogger::logger('Replacing a variable by a WordML fragment', 'info');
        } else {
            PhpdocxLogger::logger('This method requires that the variable value is a WordFragment', 'fatal');
        }

        $wordML = (string) $val;
        $wordML = preg_replace('/__PHX=__[A-Z]+__/', '', $wordML);
        if ($type == 'inline') {
            $wordML = $this->cleanWordMLBlockElements($wordML);
        }
        $searchVariable = $this->_templateSymbolStart . $var . $this->_templateSymbolEnd;
        $query = '//w:p[w:r/w:t[text()[contains(., "' . $searchVariable . '")]]]';
        if (isset($firstMatch) && $firstMatch) {
            $query = '(' . $query . ')[1]';
        }

        $docNodes = $docXpath->query($query);
        foreach ($docNodes as $node) {
            $nodeText = $node->ownerDocument->saveXML($node);
            $cleanNodeText = strip_tags($nodeText);
            if (strpos($cleanNodeText, $searchVariable) !== false) {
                if ($type == 'block') {
                    $cursorNode = $docDOM->createElement('cursorWordML');
                    //We should take care of the case that is empty and inside a table cell (fix word bug empty cells)
                    if ($wordML == '' && $node->parentNode->nodeName == 'w:tc') {
                        $wordML = '<w:p />';
                    }
                    $node->parentNode->insertBefore($cursorNode, $node);
                    $node->parentNode->removeChild($node);
                } else if ($type == 'inline') {
                    $textNode = $node->ownerDocument->saveXML($node);
                    // get w:rPr existing styles to be applied to elements after the replaced placeholder in the same paragraph
                    $stylesRpr = '';
                    try {
                        $newXMLContent = sprintf(OOXMLResources::$newXMLContent, $textNode);
                        $docDOMrPr = $this->xmlUtilities->generateDomDocument($newXMLContent, true);
                        $docXpathrPr = new DOMXPath($docDOMrPr);
                        $docXpathrPr->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $queryRPlaceholder = '//w:r[w:t[text()[contains(., "' . $searchVariable . '")]]]';
                        $docNodesrPlaceholder = $docXpathrPr->query($queryRPlaceholder);
                        if ($docNodesrPlaceholder->length > 0) {
                            $docNodesrprPlaceholder = $docNodesrPlaceholder->item(0)->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'rPr');
                            if ($docNodesrprPlaceholder->length > 0) {
                                $stylesRpr = $docNodesrprPlaceholder->item(0)->ownerDocument->saveXML($docNodesrprPlaceholder->item(0));
                            }
                        }
                    } catch (Exception $e) {
                        PhpdocxLogger::logger($e->getMessage(), 'info');
                    }
                    $textNode = $node->ownerDocument->saveXML($node);
                    $rPrContent = '<w:r>';
                    if (!empty($stylesRpr)) {
                        $rPrContent .= $stylesRpr;
                    }
                    if ($this->_templateSymbolStart == $this->_templateSymbolEnd) {
                        $textChunks = explode($this->_templateSymbolStart, $textNode);
                        $limit = count($textChunks);
                        for ($j = 0; $j < $limit; $j++) {
                            $cleanValue = strip_tags($textChunks[$j]);
                            if ($cleanValue == $var) {
                                $textChunks[$j] = '</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">';
                            }
                        }
                        $newNodeText = implode($this->_templateSymbolStart, $textChunks);
                        $newNodeText = str_replace($this->_templateSymbolStart . '</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">', '</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">', $newNodeText);
                        $newNodeText = str_replace('</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">' . $this->_templateSymbolStart, '</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">', $newNodeText);
                    } else {
                        $newNodeText = str_replace($this->_templateSymbolStart . $var . $this->_templateSymbolEnd, $this->_templateSymbolStart . '</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">' . $this->_templateSymbolEnd, $textNode);
                        $newNodeText = str_replace($this->_templateSymbolStart . '</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">', '</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">', $newNodeText);
                        $newNodeText = str_replace('</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">' . $this->_templateSymbolEnd, '</w:t></w:r><cursorWordML/>'.$rPrContent.'<w:t xml:space="preserve">', $newNodeText);
                    }
                    $newXMLContent = sprintf(OOXMLResources::$newXMLContent, $newNodeText);
                    $tempDoc = $this->xmlUtilities->generateDomDocument($newXMLContent);
                    $newCursorNode = $tempDoc->documentElement->firstChild;
                    $cursorNode = $docDOM->importNode($newCursorNode, true);
                    $node->parentNode->insertBefore($cursorNode, $node);
                    $node->parentNode->removeChild($node);
                } else if ($type == 'inline-block' && file_exists(dirname(__FILE__) . '/WordFragmentExtended.php')) {
                    $textNode = $node->ownerDocument->saveXML($node);
                    // get rPr tags of the placeholder to be applied to the next w:r of the content
                    $stylesRpr = '';
                    try {
                        $newXMLContent = sprintf(OOXMLResources::$newXMLContent, $textNode);
                        $docDOMrPr = $this->xmlUtilities->generateDomDocument($newXMLContent, true);
                        $docXpathrPr = new DOMXPath($docDOMrPr);
                        $docXpathrPr->registerNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                        $queryRPlaceholder = '//w:r[w:t[text()[contains(., "' . $searchVariable . '")]]]';
                        $docNodesrPlaceholder = $docXpathrPr->query($queryRPlaceholder);
                        if ($docNodesrPlaceholder->length > 0) {
                            $docNodesrprPlaceholder = $docNodesrPlaceholder->item(0)->getElementsByTagNameNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'rPr');
                            if ($docNodesrprPlaceholder->length > 0) {
                                $stylesRpr = $docNodesrprPlaceholder->item(0)->ownerDocument->saveXML($docNodesrprPlaceholder->item(0));
                            }
                        }
                    } catch (Exception $e) {
                        PhpdocxLogger::logger($e->getMessage(), 'info');
                    }
                    $textNode = $node->ownerDocument->saveXML($node);
                    if ($this->_templateSymbolStart == $this->_templateSymbolEnd) {
                        $textChunks = explode($this->_templateSymbolStart, $textNode);
                        $limit = count($textChunks);
                        for ($j = 0; $j < $limit; $j++) {
                            $cleanValue = strip_tags($textChunks[$j]);
                            if ($cleanValue == $var) {
                                $textChunks[$j] = '</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">';
                            }
                        }
                        $newNodeText = implode($this->_templateSymbolStart, $textChunks);
                        $newNodeText = str_replace($this->_templateSymbolStart . '</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">', '</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">', $newNodeText);
                        $newNodeText = str_replace('</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">' . $this->_templateSymbolStart, '</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">', $newNodeText);
                    } else {
                        $newNodeText = str_replace($this->_templateSymbolStart . $var . $this->_templateSymbolEnd, $this->_templateSymbolStart . '</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">' . $this->_templateSymbolEnd, $textNode);
                        $newNodeText = str_replace($this->_templateSymbolStart . '</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">', '</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">', $newNodeText);
                        $newNodeText = str_replace('</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">' . $this->_templateSymbolEnd, '</w:t></w:r><cursorWordML/><w:r>' . $stylesRpr . '<w:t xml:space="preserve">', $newNodeText);
                    }
                    $newXMLContent = sprintf(OOXMLResources::$newXMLContent, $newNodeText);
                    $tempDoc = $this->xmlUtilities->generateDomDocument($newXMLContent);
                    $newCursorNode = $tempDoc->documentElement->firstChild;
                    $cursorNode = $docDOM->importNode($newCursorNode, true);
                    $node->parentNode->insertBefore($cursorNode, $node);
                    $node->parentNode->removeChild($node);

                    // if the first element is a w:r do not add an extra w:p to get the needed output
                    if (substr($wordML, 0, strlen('<w:r>')) != '<w:r>') {
                        $wordML = '</w:p>' . $wordML;
                    }
                    if (substr($wordML, 0, strlen('</w:r>')) != '</w:r>') {
                        $wordML = $wordML . '<w:p>';
                    }
                    // fix wrong tags
                    $wordML = str_replace('</w:r><w:p>', '</w:r></w:p><w:p>', $wordML);
                    $wordML = str_replace('</w:p><w:r>', '</w:p><w:p><w:r>', $wordML);
                    $wordML = str_replace('<w:p><w:p>', '<w:p>', $wordML);
                }
            }
        }

        $stringDoc = $docDOM->saveXML();

        if (self::$trackingEnabled) {
            $tracking = new Tracking();
            $wordML = $tracking->addTrackingInsFirstR($wordML);
        }

        $stringDoc = str_replace('<cursorWordML/>', $wordML, $stringDoc);

        return $stringDoc;
    }

    /**
     * Replaces an array of variables by their values
     *
     * @access private
     * @param array $variables
     *  keys: variable names
     *  values: text we want to insert
     * @param string $loadContent
     * @param array $options
     * @return SimpleXMLElement Object
     */
    private function variable2Text($variables, $loadContent, $options)
    {
        if (isset($options['firstMatch'])) {
            $firstMatch = $options['firstMatch'];
        } else {
            $firstMatch = false;
        }
        if (!$this->_preprocessed) {
            $loadContent = $this->repairVariables($variables, $loadContent);
        }

        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        $dom = simplexml_load_string($loadContent);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }
        $dom->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
        foreach ($variables as $var => $val) {
            $search = $this->_templateSymbolStart . $var . $this->_templateSymbolEnd;
            $query = '//w:t[text()[contains(., "' . $search . '")]]';
            if ($firstMatch) {
                $query = '(' . $query . ')[1]';
            }
            $foundNodes = $dom->xpath($query);
            foreach ($foundNodes as $node) {
                $strNode = (string) $node;
                if (isset($options['parseLineBreaks']) && $options['parseLineBreaks']) {
                    $domNode = dom_import_simplexml($node);
                    //parse $val for \n\r, \r\n, \n or \r and carriage returns
                    $val = str_replace(array('\n\r', '\r\n', '\n', '\r', "\n\r", "\r\n", "\n", "\r"), '<linebreak/>', $val);
                    $strNode = str_replace($search, $val, $strNode);
                    $runs = explode('<linebreak/>', $strNode);
                    $preserveWS = false;
                    $preserveWhiteSpace = $domNode->getAttribute('xml:space');
                    if ($preserveWhiteSpace == 'preserve') {
                        $preserveWS = true;
                    }
                    $numberOfRuns = count($runs);
                    $counter = 0;
                    foreach ($runs as $run) {
                        $counter++;
                        $newT = $domNode->ownerDocument->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 't', htmlspecialchars($run));
                        if ($preserveWS) {
                            $newT->setAttribute('xml:space', 'preserve');
                        }
                        $domNode->parentNode->insertBefore($newT, $domNode);
                        if ($counter < $numberOfRuns) {
                            $br = $domNode->ownerDocument->createElementNS('http://schemas.openxmlformats.org/wordprocessingml/2006/main', 'br');
                            $domNode->parentNode->insertBefore($br, $domNode);
                        }
                    }
                    $domNode->parentNode->removeChild($domNode);
                } else {
                    $strNode = str_replace($search, $val, $strNode);
                    $node[0] = $strNode;
                }
            }
        }

        return $dom;
    }

    /**
     * Does the actual parsing of the content for the replacement by a Word Fragment
     *
     * @access private
     * @param array $variables
     * @param string $type
     * @param string $loadContent
     * @param bool $firstMatch
     * @param array $options
     */
    private function variable4WordFragment($variables, $type, $loadContent, $firstMatch, $options = array())
    {
        if (!$this->_preprocessed) {
            $loadContent = $this->repairVariables($variables, $loadContent);
        }

        foreach ($variables as $var => $val) {
            $loadContent = $this->singleVariable4WordFragment($var, $val, $type, $loadContent, $firstMatch, $options);
        }

        return $loadContent;
    }

    /**
     * Does the actual parsing of the content for the replacement by a Word Fragment in headers and footers
     *
     * @access private
     * @param array $variables
     * @param string $type
     * @param string $headerFooterName
     * @param string $headerFooterContent
     * @param bool $firstMatch
     * @param array $options
     */
    private function variableHeaderFooterByWordFragments($variables, $type, $headerFooterName , $headerFooterContent, $firstMatch, $options = array())
    {
        if (!$this->_preprocessed) {
            $headerFooterContent = $this->repairVariables($variables, $headerFooterContent);
        }

        foreach ($variables as $var => $wf) {
            $domHeaderFooter = $this->singleVariable4WordFragment($var, $wf, $type, $headerFooterContent, $firstMatch, $options);

            $nodes = $wf->_wordRelsDocumentRelsT->getElementsBytagName('Relationship');
            $relName = 'word/_rels/' . $headerFooterName . '.rels';
            $stringRels = $this->getFromZip($relName);
            if (!$stringRels) {
                $stringRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"></Relationships>';
            }
            foreach ($nodes as $node) {
                $nodeType = $node->getAttribute('Type');
                if ($nodeType == 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/image' || $nodeType == 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink' || $nodeType == 'http://schemas.openxmlformats.org/officeDocument/2006/relationships/chart') {
                    // only add the relation if the rId doesn't exist
                    if (!strstr($stringRels, $wf->_wordRelsDocumentRelsT->saveXML($node))) {
                        $xmlRels = $this->xmlUtilities->generateDomDocument($stringRels);
                        $newRelNode = $xmlRels->createElement('relationship');
                        $xmlRels->getElementsBytagName('Relationships')->item(0)->appendChild($newRelNode);
                        $stringRels = $xmlRels->saveXML();
                        $stringRels = str_replace('<relationship/>', $wf->_wordRelsDocumentRelsT->saveXML($node), $stringRels);
                    }
                }
            }
            $this->saveToZip($stringRels, 'word/_rels/' . $headerFooterName . '.rels');
        }

        return $domHeaderFooter;
    }
}