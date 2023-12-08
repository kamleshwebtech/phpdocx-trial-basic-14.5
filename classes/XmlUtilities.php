<?php

/**
 * XML functions
 *
 * @category   Phpdocx
 * @package    utilities
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
class XmlUtilities
{
    /**
     * Generate a DOM document from a XML string
     *
     * @param string $xml XML content
     * @param bool $internalError Enable use internal errors
     */
    public function generateDOMDocument($xml, $internalError = false)
    {
        $domDocument = new DOMDocument();
        if (PHP_VERSION_ID < 80000) {
            $optionEntityLoader = libxml_disable_entity_loader(true);
        }
        if ($internalError) {
            $prevValueLibXmlInternalErrors = libxml_use_internal_errors(true);
        }
        $domDocument->loadXML($xml);
        if (PHP_VERSION_ID < 80000) {
            libxml_disable_entity_loader($optionEntityLoader);
        }
        if ($internalError) {
            libxml_clear_errors();
            libxml_use_internal_errors($prevValueLibXmlInternalErrors);
        }

        return $domDocument;
    }

    /**
     * Apply math equation styles
     *
     * @param DOMDocument $equationStyledDOM
     * @param array $options
     * @return string
     */
    public function mathEquationStyles($equationStyledDOM, $options)
    {
        if (isset($options['bold']) || isset($options['italic'])) {
            $styleMPR = '';
            if (isset($options['bold']) && $options['bold']) {
                $styleMPR .= 'b';
            }
            if (isset($options['italic']) && $options['italic']) {
                $styleMPR .= 'i';
            }
            if (!isset($options['bold']) && !isset($options['italic'])) {
                $styleMPR = 'p';
            }
            $elementsMR = $equationStyledDOM->getElementsByTagName('m:r');
            if ($elementsMR->length > 0) {
                foreach ($elementsMR as $elementMR) {
                    $elementRPR = $elementMR->getElementsByTagName('m:rPr');
                    // w:rPR doesn't exist, create it
                    if ($elementRPR->length == 0) {
                        $elementTag = $elementMR->ownerDocument->createElement('m:rPr');
                        $elementMR->insertBefore($elementTag, $elementMR->firstChild);

                        $elementRPRItem = $elementTag;
                    } else {
                        $elementRPRItem = $elementRPR->item(0);
                    }

                    // add the style only if not exists, otherwise change it
                    $elementMSTY = $elementRPRItem->getElementsByTagName('m:sty');
                    if ($elementMSTY->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('m:sty');
                        $elementRPRItem->appendChild($elementTag);

                        $elementMSTYItem = $elementTag;
                    } else {
                        $elementMSTYItem = $elementMSTY->item(0);
                    }
                    $elementMSTYItem->setAttribute('m:val', $styleMPR);
                }
            }
        }

        if (isset($options['color'])) {
            $elementsMR = $equationStyledDOM->getElementsByTagName('m:r');
            if ($elementsMR->length > 0) {
                foreach ($elementsMR as $elementMR) {
                    $elementRPR = $elementMR->getElementsByTagName('w:rPr');
                    // w:rPR doesn't exist, create it
                    if ($elementRPR->length == 0) {
                        $elementTag = $elementMR->ownerDocument->createElement('w:rPr');
                        $elementMR->insertBefore($elementTag, $elementMR->firstChild);

                        $elementRPRItem = $elementTag;
                    } else {
                        $elementRPRItem = $elementRPR->item(0);
                    }

                    // add the style only if not exists, otherwise change it
                    $elementColor = $elementRPRItem->getElementsByTagName('w:color');
                    if ($elementColor->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('w:color');
                        $elementRPRItem->appendChild($elementTag);

                        $elementColorItem = $elementTag;
                    } else {
                        $elementColorItem = $elementColor->item(0);
                    }
                    $elementColorItem->setAttribute('w:val', $options['color']);
                }
            }
        }

        if (isset($options['fontSize'])) {
            $elementsMR = $equationStyledDOM->getElementsByTagName('m:r');
            if ($elementsMR->length > 0) {
                foreach ($elementsMR as $elementMR) {
                    $elementRPR = $elementMR->getElementsByTagName('w:rPr');
                    // w:rPR doesn't exist, create it
                    if ($elementRPR->length == 0) {
                        $elementTag = $elementMR->ownerDocument->createElement('w:rPr');
                        $elementMR->insertBefore($elementTag, $elementMR->firstChild);

                        $elementRPRItem = $elementTag;
                    } else {
                        $elementRPRItem = $elementRPR->item(0);
                    }

                    // add the style only if not exists, otherwise change it
                    $elementRPRSZ = $elementRPRItem->getElementsByTagName('w:sz');
                    $elementRPRSZCS = $elementRPRItem->getElementsByTagName('w:szCs');
                    if ($elementRPRSZ->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('w:sz');
                        $elementRPRItem->appendChild($elementTag);

                        $elementRPRSZItem = $elementTag;
                    } else {
                        $elementRPRSZItem = $elementRPRSZ->item(0);
                    }
                    $elementRPRSZItem->setAttribute('w:val', (int)$options['fontSize']*2);
                    if ($elementRPRSZCS->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('w:szCs');
                        $elementRPRItem->appendChild($elementTag);

                        $elementRPRSZCSItem = $elementTag;
                    } else {
                        $elementRPRSZCSItem = $elementRPRSZ->item(0);
                    }
                    $elementRPRSZCSItem->setAttribute('w:val', (int)$options['fontSize']*2);
                }
            }
        }

        if (isset($options['underline'])) {
            $elementsMR = $equationStyledDOM->getElementsByTagName('m:r');
            if ($elementsMR->length > 0) {
                foreach ($elementsMR as $elementMR) {
                    $elementRPR = $elementMR->getElementsByTagName('w:rPr');
                    // w:rPR doesn't exist, create it
                    if ($elementRPR->length == 0) {
                        $elementTag = $elementMR->ownerDocument->createElement('w:rPr');
                        $elementMR->insertBefore($elementTag, $elementMR->firstChild);

                        $elementRPRItem = $elementTag;
                    } else {
                        $elementRPRItem = $elementRPR->item(0);
                    }

                    // add the style only if not exists, otherwise change it
                    $elementU = $elementRPRItem->getElementsByTagName('w:u');
                    if ($elementU->length == 0) {
                        $elementTag = $elementRPRItem->ownerDocument->createElement('w:u');
                        $elementRPRItem->appendChild($elementTag);

                        $elementUItem = $elementTag;
                    } else {
                        $elementUItem = $elementU->item(0);
                    }
                    $elementUItem->setAttribute('w:val', $options['underline']);
                }
            }
        }

        return $equationStyledDOM->saveXML($equationStyledDOM->documentElement);
    }
}