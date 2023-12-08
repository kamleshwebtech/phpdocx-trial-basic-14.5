<?php

/**
 * Create graphics(charts)
 *
 * @category   Phpdocx
 * @package    elements
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
class CreateGraphic extends CreateElement
{
    const NAMESPACEWORD = 'c';

    /**
     *
     * @access protected
     * @var string
     */
    protected $_xmlChart;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_rId;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_textalign;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_jc;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_comboChart;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_sizeX;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_sizeY;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_type;

    /**
     * @access protected
     * @var mixed
     */
    protected $values;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_formatDataLabels;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_formatCode;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_showCategory;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_showLegendKey;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_showPercent;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_showSeries;

    /**
     * @access protected
     * @var mixed
     */
    protected $_showTable;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_showValue;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_stylesTitle;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_theme;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_data;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_rotX;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_rotY;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_perspective;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_color;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_float;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_groupBar;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_horizontalOffset;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_title;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_name;

    /**
     * @access protected
     * @var mixed
     */
    protected $_font;

    /**
     * @access protected
     * @var mixed
     */
    protected $_legendPos;

    /**
     * @access protected
     * @var mixed
     */
    protected $_legendOverlay;

    /**
     * @access protected
     * @var mixed
     */
    protected $_border;

    /**
     * @access protected
     * @var mixed
     */
    protected $_haxLabel;

    /**
     * @access protected
     * @var mixed
     */
    protected $_vaxLabel;

    /**
     * @access protected
     * @var mixed
     */
    protected $_haxLabelDisplay;

    /**
     * @access protected
     * @var mixed
     */
    protected $_vaxLabelDisplay;

    /**
     * @access protected
     * @var mixed
     */
    protected $_hgrid;

    /**
     * @access protected
     * @var mixed
     */
    protected $_vgrid;

    /**
     * @access protected
     * @var mixed
     */
    protected $_explosion;

    /**
     * @access protected
     * @var mixed
     */
    protected $_holeSize;

    /**
     * @access protected
     * @var mixed
     */
    protected $_symbol;

    /**
     * @access protected
     * @var mixed
     */
    protected $_symbolSize;

    /**
     * @access protected
     * @var mixed
     */
    protected $_style;

    /**
     * @access protected
     * @var mixed
     */
    protected $_smooth;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_verticalOffset;

    /**
     * @access protected
     * @var mixed
     */
    protected $_wireframe;

    /**
     * @access protected
     * @var mixed
     */
    protected $_scalingMax;

    /**
     * @access protected
     * @var mixed
     */
    protected $_scalingMin;

    /**
     * @access protected
     * @var mixed
     */
    protected $_tickLblPos;

    /**
     * @access protected
     * @var mixed
     */
    protected $_majorUnit;

    /**
     * @access protected
     * @var mixed
     */
    protected $_minorUnit;

    /**
     * @access protected
     * @var mixed
     */
    protected $_orientation;

    /**
     * @access protected
     * @var mixed
     */
    protected $_axPos;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_roundedCorners;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_rAngAx;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_varyColors;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_showBubbleSize;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_delete;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_autoUpdate;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_gapWidth;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_overlap;

    /**
     * @access protected
     * @var mixed
     */
    protected $_secondPieSize;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_splitPos;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_splitType;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_subtype;

    /**
     *
     * @access protected
     * @var mixed
     */
    protected $_custSplit;

    /**
     * @access protected
     * @var CreateGraphic
     * @static
     */
    protected static $_instance = null;

    /**
     * Construct
     *
     * @access public
     */
    public function __construct()
    {
        //set for 2010 compatibility
        $this->_varyColors = 0;
        $this->_autoUpdate = 0;
        $this->_delete = 0; //removes the axis if set to 1
        $this->_rAngAx = 0;
        $this->_roundedCorners = 0;

        $this->_rId = '';
        $this->_textalign = '';
        $this->_jc = '';
        $this->_sizeX = '';
        $this->_sizeY = '';
        $this->_type = '';
        $this->_data = '';
        $this->_rotX = '';
        $this->_rotY = '';
        $this->_perspective = '';
        $this->_color = '';
        $this->_groupBar = '';
        $this->_title = '';
        $this->_font = '';
        $this->_xml = '';
        $this->_name = '';
        $this->_legendPos = 'r';
        $this->_legendOverlay = 0;
        $this->_border = '';
        $this->_haxLabel = '';
        $this->_vaxLabel = '';
        $this->_haxLabelDisplay = '';
        $this->_vaxLabelDisplay = '';
        $this->_showTable = '';
        $this->_hgrid = '';
        $this->_vgrid = '';
        $this->_orientation = array();
        $this->_axPos = array();

        $this->_gapWidth = '';
        $this->_overlap = '';
        $this->_secondPieSize = '';
        $this->_splitType = '';
        $this->_splitPos = '';
        $this->_custSplit = '';
        $this->_subtype = '';

        $this->_explosion = '';
        $this->_holeSize = '';
        $this->_symbol = '';
        $this->_symbolSize = '';
        $this->_style = '';
        $this->_smooth = false;
        $this->_wireframe = false;
        //Default values for c:dLbls
        $this->_showLegendKey = 0;
        $this->_showBubbleSize = 0;
        $this->_showPercent = 0;
        $this->_showValue = 0;
        $this->_showCategory = 0;
        $this->_showSeries = 0;

        $this->_scalingMax = null;
        $this->_scalingMin = null;

        $this->_tickLblPos = 'nextTo';

        $this->_majorUnit = null;
        $this->_minorUnit = null;

        $this->_stylesTitle = null;

        $this->_comboChart = null;
        $this->_formatDataLabels = null;
        $this->_formatCode = null;
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
     * @return CreateGraphic
     * @static
     */
    public static function getInstance()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new CreatePieChart();
        }
        return self::$_instance;
    }

    /**
     *
     * @access public
     * @return string
     */
    public function __toString()
    {
        return $this->_xml;
    }

    /**
     * Setter. Rid
     *
     * @access public
     * @param string $rId
     */
    public function setRId($rId)
    {
        $this->_rId = $rId;
    }

    /**
     * Getter. Rid
     *
     * @access public
     * @return string
     */
    public function getRId()
    {
        return $this->_rId;
    }

    /**
     * Setter. Name
     *
     * @access public
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Getter. Name
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Setter. Xml chart
     *
     * @access public
     * @param string $xmlChart
     */
    public function setXmlChart($xmlChart)
    {
        $this->_xmlChart = $xmlChart;
    }

    /**
     * Getter. Xml chart
     *
     * @access public
     * @return string
     */
    public function getXmlChart()
    {
        return $this->_xmlChart;
    }

    /**
     * Create embedded graphic
     *
     * @access public
     * @return boolean
     */
    public function createEmbeddedGraphic()
    {
        $this->_xmlChart = '';
        if ($this->_type != '') {
            $this->createEmbeddedDocumentXml();
            return true;
        } else {
            echo 'You haven`t added a chart type';
            return false;
        }
    }

    /**
     * Create graphic
     *
     * @access public
     * @return boolean
     */
    public function CreateGraphic()
    {
        $this->_xmlChart = '';
        $args = func_get_args();
        $this->setRId($args[0]);
        $this->initGraphic($args[1]);
        if (isset($this->_type) && isset($args[0])) {
            if ($this->createEmbeddedXmlChart() == false) {
                echo 'You haven`t added legends';
                return false;
            }
            $this->createDOCUEMNTXML();
            return true;
        } else {
            echo 'You haven`t added a chart type';
            return false;
        }
    }

    /**
     * Create embedded xml chart. To be replaced by chart type classes
     *
     * @access public
     */
    public function createEmbeddedXmlChart() {}

    /**
     * Init graphic
     *
     * @access public
     */
    public function initGraphic()
    {
        $args = func_get_args();
        $this->_type = $args[0]['type'];
        $this->values = $args[0]['data'];
        if (isset($args[0]['theme'])) {
            $this->_theme = $args[0]['theme'];
        }
        if (isset($args[0]['float'])) {
            $this->_float = $args[0]['float'];
        }
        if (isset($args[0]['horizontalOffset'])) {
            $this->_horizontalOffset = $args[0]['horizontalOffset'];
        }
        if (isset($args[0]['verticalOffset'])) {
            $this->_verticalOffset = $args[0]['verticalOffset'];
        }
        if (isset($args[0]['textWrap'])) {
            $this->_textalign = $args[0]['textWrap'];
        }
        if (isset($args[0]['jc'])) {
            $this->_jc = $args[0]['jc'];
        }
        if (isset($args[0]['sizeX'])) {
            $this->_sizeX = $args[0]['sizeX'];
        }
        if (isset($args[0]['sizeY'])) {
            $this->_sizeY = $args[0]['sizeY'];
        }
        if (isset($args[0]['showCategory']) && !empty($args[0]['showCategory'])) {
            $this->_showCategory = 1;
        }
        if (isset($args[0]['showLegendKey']) && !empty($args[0]['showLegendKey'])) {
            $this->_showLegendKey = 1;
        }
        if (isset($args[0]['showPercent']) && !empty($args[0]['showPercent'])) {
            $this->_showPercent = 1;
        }
        if (isset($args[0]['showSeries']) && !empty($args[0]['showSeries'])) {
            $this->_showSeries = 1;
        }
        if (isset($args[0]['showValue']) && !empty($args[0]['showValue'])) {
            $this->_showValue = 1;
        }
        if (isset($args[0]['rotX'])) {
            $this->_rotX = $args[0]['rotX'];
        }
        if (isset($args[0]['rotY'])) {
            $this->_rotY = $args[0]['rotY'];
        }
        if (isset($args[0]['perspective'])) {
            $this->_perspective = $args[0]['perspective'];
        }
        if (isset($args[0]['color'])) {
            $this->_color = $args[0]['color'];
        }
        if (isset($args[0]['groupBar'])) {
            $this->_groupBar = $args[0]['groupBar'];
        }
        if (isset($args[0]['title'])) {
            $this->_title = $args[0]['title'];
        }
        if (isset($args[0]['font'])) {
            $this->_font = $args[0]['font'];
        }
        if (isset($args[0]['legendPos'])) {
            $this->_legendPos = $args[0]['legendPos'];
        }
        if (isset($args[0]['legendOverlay']) && !empty($args[0]['legendOverlay'])) {
            $this->_legendOverlay = 1;
        }
        if (isset($args[0]['border'])) {
            $this->_border = $args[0]['border'];
        }
        if (isset($args[0]['haxLabel'])) {
            $this->_haxLabel = $args[0]['haxLabel'];
        }
        if (isset($args[0]['vaxLabel'])) {
            $this->_vaxLabel = $args[0]['vaxLabel'];
        }
        if (isset($args[0]['haxLabelDisplay'])) {
            $this->_haxLabelDisplay = $args[0]['haxLabelDisplay'];
        }
        if (isset($args[0]['vaxLabelDisplay'])) {
            $this->_vaxLabelDisplay = $args[0]['vaxLabelDisplay'];
        }
        if (isset($args[0]['showTable'])) {
            $this->_showTable = $args[0]['showTable'];
        }
        if (isset($args[0]['hgrid'])) {
            $this->_hgrid = $args[0]['hgrid'];
        }
        if (isset($args[0]['vgrid'])) {
            $this->_vgrid = $args[0]['vgrid'];
        }
        if (isset($args[0]['style'])) {
            $this->_style = $args[0]['style'];
        }
        if (isset($args[0]['gapWidth'])) {
            $this->_gapWidth = $args[0]['gapWidth'];
        }
        if (isset($args[0]['overlap'])) {
            $this->_overlap = $args[0]['overlap'];
        }
        if (isset($args[0]['secondPieSize'])) {
            $this->_secondPieSize = $args[0]['secondPieSize'];
        }
        if (isset($args[0]['splitType'])) {
            $this->_splitType = $args[0]['splitType'];
        }
        if (isset($args[0]['splitPos'])) {
            $this->_splitPos = $args[0]['splitPos'];
        }
        if (isset($args[0]['custSplit'])) {
            $this->_custSplit = $args[0]['custSplit'];
        }
        if (isset($args[0]['subtype'])) {
            $this->_subtype = $args[0]['subtype'];
        }
        if (isset($args[0]['explosion'])) {
            $this->_explosion = $args[0]['explosion'];
        }
        if (isset($args[0]['holeSize'])) {
            $this->_holeSize = $args[0]['holeSize'];
        }
        if (isset($args[0]['majorUnit'])) {
            $this->_majorUnit = $args[0]['majorUnit'];
        }
        if (isset($args[0]['minorUnit'])) {
            $this->_minorUnit = $args[0]['minorUnit'];
        }
        if (isset($args[0]['scalingMax'])) {
            $this->_scalingMax = $args[0]['scalingMax'];
        }
        if (isset($args[0]['scalingMin'])) {
            $this->_scalingMin = $args[0]['scalingMin'];
        }
        if (isset($args[0]['stylesTitle'])) {
            $this->_stylesTitle = $args[0]['stylesTitle'];
        }
        if (isset($args[0]['symbol'])) {
            $this->_symbol = $args[0]['symbol'];
        }
        if (isset($args[0]['symbolSize'])) {
            $this->_symbolSize = $args[0]['symbolSize'];
        }
        if (isset($args[0]['smooth'])) {
            $this->_smooth = $args[0]['smooth'];
        }
        if (isset($args[0]['tickLblPos'])) {
            $this->_tickLblPos = $args[0]['tickLblPos'];
        }
        if (isset($args[0]['wireframe'])) {
            $this->_wireframe = $args[0]['wireframe'];
        }
        if (isset($args[0]['comboChart'])) {
            $this->_comboChart = $args[0]['comboChart'];
        }
        if (isset($args[0]['formatDataLabels'])) {
            $this->_formatDataLabels = $args[0]['formatDataLabels'];
        }
        if (isset($args[0]['formatCode'])) {
            $this->_formatCode = $args[0]['formatCode'];
        }
        if (isset($args[0]['orientation'])) {
            $this->_orientation = $args[0]['orientation'];
        }
        if (isset($args[0]['axPos'])) {
            $this->_axPos = $args[0]['axPos'];
        }
    }

    /**
     * Add combo chart
     *
     * @access protected
     * @param int $id Previous c:idx value. Each c:idx must have a unique and sequential value.
     */
    protected function addComboChart($id)
    {
        $domChart = new DOMDocument();
        $domChart->loadXML($this->_comboChart);
        $domPlot = $domChart->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/chart', 'plotArea');

        if ($domPlot->length > 0) {
            // get the second position, as it's the chart content. The first element is the layout tag that must be ignored
            $elementChart = $domPlot->item(0)->childNodes->item(1);
            $domChartIdxs = $elementChart->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/chart', 'idx');
            $domChartOrders = $elementChart->getElementsByTagNameNS('http://schemas.openxmlformats.org/drawingml/2006/chart', 'order');

            // update the IDX and order values of the added chart
            if ($domChartIdxs->length > 0) {
                $j = 0;
                foreach ($domChartIdxs as $domChartIdx) {
                    $domChartIdx->setAttribute('val', $id);
                    $domChartOrders->item($j)->setAttribute('val', $id);
                    $id++;
                    $j++;
                }
            }
            $xmlComboChart = $elementChart->ownerDocument->saveXml($elementChart);

            $this->_xmlChart = str_replace('__PHX=__GENERATEPLOTAREA__', $xmlComboChart . '__PHX=__GENERATEPLOTAREA__', $this->_xmlChart);
        }
    }

    /**
     * Create embedded document xml
     *
     * @access protected
     * @return mixed
     */
    protected function createEmbeddedDocumentXml()
    {
        if ($this->_textalign != '' &&
                ($this->_textalign < 0 || $this->_textalign > 5)
        ) {
            $textalign = 0;
        } else {
            $textalign = $this->_textalign;
        }
        if ($this->_sizeX != '') {
            $sizeX = $this->_sizeX * CreateImage::CONSTWORD;
        } else {
            $sizeX = 2993296;
        }
        if ($this->_sizeY != '') {
            $sizeY = $this->_sizeY * CreateImage::CONSTWORD;
        } else {
            $sizeY = 2238233;
        }

        $this->_xml = '';
        $this->generateQUITAR();
        $this->generateRPR();
        $this->generateNOPROOF();
        $this->generateDRAWING();
        if ($textalign == 0) {
            $this->generateINLINE();
        } else {
            if ($textalign == 3) {
                $this->generateANCHOR(1);
            } else {
                $this->generateANCHOR();
            }
            $this->generateSIMPLEPOS();
            $this->generatePOSITIONH();
            if (isset($this->_float) && ($this->_float == 'left' || $this->_float == 'right' || $this->_float == 'center')) {
                $this->generateALIGN($this->_float);
            }
            if (isset($this->_horizontalOffset) && is_numeric($this->_horizontalOffset)) {
                $this->generatePOSOFFSET($this->_horizontalOffset);
            } else {
                $this->generatePOSOFFSET(0);
            }
            $this->generatePOSITIONV();
            if (isset($this->_verticalOffset) && is_numeric($this->_verticalOffset)) {
                $this->generatePOSOFFSET($this->_verticalOffset);
            } else {
                $this->generatePOSOFFSET(0);
            }
        }

        $this->generateEXTENT($sizeX, $sizeY);
        $this->generateEFFECTEXTENT();
        switch ($textalign) {
            case 1:
                $this->generateWRAPSQUARE();
                break;
            case 2:
            case 3:
                $this->generateWRAPNONE();
                break;
            case 4:
                $this->generateWRAPTOPANDBOTTOM();
                break;
            case 5:
                $this->generateWRAPTHROUGH();
                $this->generateWRAPPOLYGON();
                $this->generateSTART();
                $this->generateLINETO();
                $this->generateLINETO('21540', '21342');
                $this->generateLINETO('21540', '0');
                $this->generateLINETO('-198', '0');
                break;
            default:
                break;
        }
        $this->generateDOCPR($this->getRId());
        $this->generateCNVGRAPHICFRAMEPR();
        $this->generateGRAPHIC();
        $this->generateGRAPHICDATA(
                'http://schemas.openxmlformats.org/' .
                'drawingml/2006/chart'
        );
        $this->generateDOCUMENTCHART();
        $this->cleanTemplate();
        return true;
    }

    /**
     * return the transposed matrix
     *
     * @access public
     * @param array $matrix
     */
    public function transposed($matrix)
    {
        $data = array();
        foreach ($matrix as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $data[$key2][$key] = $value2;
            }
        }
        return $data;
    }

    /**
     * return the array with just 1 deep
     *
     * @access public
     * @param array $matrix
     */
    public function linear($matrix)
    {
        $data = array();
        foreach ($matrix as $key => $value) {
            foreach ($value as $ind => $val) {
                $data[] = $val;
            }
        }
        return $data;
    }

    /**
     * return the array of data prepared to modify the chart data
     *
     * @access public
     * @param array $data
     */
    public function prepareData($data)
    {
        $newData = array();
        $simple = true;
        if (isset($data['legend'])) {
            unset($data['legend']);
        }
        foreach ($data as $dat) {
            if (count($dat) > 1) {
                $simple = false;
            }
            break;
        }
        foreach ($data as $dat) {
            if ($simple) {
                $newData[] = $dat[0];
            } else {
                $newData[] = $dat;
            }
        }
        if ($simple) {
            return $this->linear(array($newData));
        } else {
            return $this->linear($this->transposed($newData));
        }
    }

    /**
     * Create document xml
     *
     * @access protected
     */
    protected function createDOCUEMNTXML()
    {
        if (empty($this->_textalign) ||
                $this->_textalign < 0 ||
                $this->_textalign > 5) {
            $textalign = 0;
        } else {
            $textalign = $this->_textalign;
        }

        if (!empty($this->_sizeX)) {
            $sizeX = $this->_sizeX * CreateImage::CONSTWORD;
        } else {
            $sizeX = 2993296;
        }

        if (!empty($this->_sizeY)) {
            $sizeY = $this->_sizeY * CreateImage::CONSTWORD;
        } else {
            $sizeY = 2238233;
        }

        $this->_xml = '';
        $this->generateP();
        if (!empty($this->_jc)) {
            $this->generatePPR();
            $this->generateJC($this->_jc);
        }
        $this->generateR();
        $this->generateRPR();
        $this->generateNOPROOF();
        $this->generateDRAWING();
        if ($textalign == 0) {
            $this->generateINLINE();
        } else {
            if ($textalign == 3) {
                $this->generateANCHOR(1);
            } else {
                $this->generateANCHOR();
            }
            $this->generateSIMPLEPOS();
            $this->generatePOSITIONH();
            if (isset($this->_float) && ($this->_float == 'left' || $this->_float == 'right' || $this->_float == 'center')) {
                $this->generateALIGN($this->_float);
            }
            if (isset($this->_horizontalOffset) && is_numeric($this->_horizontalOffset)) {
                $this->generatePOSOFFSET($this->_horizontalOffset);
            } else {
                $this->generatePOSOFFSET(0);
            }
            $this->generatePOSITIONV();
            if (isset($this->_verticalOffset) && is_numeric($this->_verticalOffset)) {
                $this->generatePOSOFFSET($this->_verticalOffset);
            } else {
                $this->generatePOSOFFSET(0);
            }
        }

        $this->generateEXTENT($sizeX, $sizeY);
        $this->generateEFFECTEXTENT();
        switch ($textalign) {
            case 1:
                $this->generateWRAPSQUARE();
                break;
            case 2:
            case 3:
                $this->generateWRAPNONE();
                break;
            case 4:
                $this->generateWRAPTOPANDBOTTOM();
                break;
            case 5:
                $this->generateWRAPTHROUGH();
                $this->generateWRAPPOLYGON();
                $this->generateSTART();
                $this->generateLINETO();
                $this->generateLINETO('21540', '21342');
                $this->generateLINETO('21540', '0');
                $this->generateLINETO('-198', '0');
                break;
            default:
                break;
        }
        $this->generateDOCPR($this->getRId());
        $this->generateCNVGRAPHICFRAMEPR();
        $this->generateGRAPHIC();
        $this->generateGRAPHICDATA(
                'http://schemas.openxmlformats.org/' .
                'drawingml/2006/chart'
        );
        $this->generateDOCUMENTCHART();
        $this->cleanTemplate();
        return true;
    }

    /**
     * Generate w:autotitledeleted
     *
     * @access protected
     * @param string $val
     */
    protected function generateAUTOTITLEDELETED($val = '1')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':autoTitleDeleted val="' . $val .
                '"></' . CreateGraphic::NAMESPACEWORD .
                ':autoTitleDeleted>__PHX=__GENERATECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:bar3DChart
     *
     * @access protected
     */
    protected function generateBAR3DCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':bar3DChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD . ':bar3DChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:barChart
     *
     * @access protected
     */
    protected function generateBARCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':barChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':barChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:barDir
     *
     * @access protected
     * @param string $val
     */
    protected function generateBARDIR($val = 'bar')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':barDir val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':barDir>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:bodypr
     *
     * @access protected
     */
    protected function generateBODYPR()
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 . ':bodyPr></' .
                CreateImage::NAMESPACEWORD1 . ':bodyPr>__PHX=__GENERATERICH__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATERICH__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:chart
     *
     * @access protected
     */
    protected function generateCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':chart>__PHX=__GENERATECHART__</' . CreateGraphic::NAMESPACEWORD .
                ':chart>__PHX=__GENERATECHARTSPACE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHARTSPACE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate chartspace XML
     *
     * @access protected
     */
    protected function generateCHARTSPACE()
    {
        $this->_xmlChart = '<?xml version="1.0" encoding="UTF-8" ' .
                'standalone="yes" ?><' . CreateGraphic::NAMESPACEWORD .
                ':chartSpace xmlns:c="http://schemas.openxmlformats.o' .
                'rg/drawingml/2006/chart" xmlns:a="http://schemas.open' .
                'xmlformats.org/drawingml/2006/main" xmlns:r="http://s' .
                'chemas.openxmlformats.org/officeDocument/2006/relatio' .
                'nships">__PHX=__GENERATECHARTSPACE__</' .
                CreateGraphic::NAMESPACEWORD . ':chartSpace>';
    }

    /**
     * Generate datalabels dlbl
     *
     * @access protected
     * @param array $valueDataLabels
     */
    protected function generateDATALABELS_DLBL($valueDataLabels, $idx) {
        // default values
        $position = 'ctr';
        $showCatName = 0;
        $showLegendKey = 0;
        $showPercent = 0;
        $showSerName = 0;
        $showVal = 1;
        $text = '';

        $xml = '';
        $idx = 0;
        foreach ($valueDataLabels as $valueDataLabel) {
            $xml .= '<c:dLbl>';
            $xml .=  '<c:idx val="' . $idx . '"/>';
            if (isset($valueDataLabel['formatCode'])) {
                $xml .= '<c:numFmt formatCode="'.$valueDataLabel['formatCode'].'" sourceLinked="0"/>';
            }
            if (isset($valueDataLabel['position'])) {
                switch ($valueDataLabel['position']) {
                    case 'bottom':
                        $position = 'b';
                        break;
                    case 'center':
                        $position = 'ctr';
                        break;
                    case 'insideBase':
                        $position = 'inBase';
                        break;
                    case 'insideEnd':
                        $position = 'inEnd';
                        break;
                    case 'left':
                        $position = 'l';
                        break;
                    case 'right':
                        $position = 'r';
                        break;
                    case 'outsideEnd':
                        $position = 'outEnd';
                        break;
                    case 'top':
                        $position = 't';
                        break;
                    default:
                        $position = 'ctr';
                        break;
                }
            }

            if (isset($valueDataLabel['text'])) {
                $xml .= '<c:tx><c:rich><a:bodyPr/><a:lstStyle/><a:p><a:r><a:rPr lang="en-US"/><a:t>' . $valueDataLabel['text'] . '</a:t></a:r></a:p></c:rich></c:tx>';
            }
            $xml .= '<c:dLblPos val="'.$position.'"/>';
            if (isset($valueDataLabel['showCategory'])) {
                $showCatName = $valueDataLabel['showCategory'];
            }
            if (isset($valueDataLabel['showLegendKey'])) {
                $showLegendKey = $valueDataLabel['showLegendKey'];
            }
            if (isset($valueDataLabel['showPercent'])) {
                $showPercent = $valueDataLabel['showPercent'];
            }
            if (isset($valueDataLabel['showSeries'])) {
                $showSerName = $valueDataLabel['showSeries'];
            }
            if (isset($valueDataLabel['showValue'])) {
                $showVal = $valueDataLabel['showValue'];
            }
            $xml .= '<c:showLegendKey val="'.$showLegendKey.'"/><c:showVal val="'.$showVal.'"/><c:showCatName val="'.$showCatName.'"/><c:showSerName val="'.$showSerName.'"/><c:showPercent val="'.$showPercent.'"/><c:showBubbleSize val="0"/></c:dLbl>';

            $idx++;
        }

        $this->_xmlChart = str_replace('__PHX=__GENERATEDLB__', $xml, $this->_xmlChart);
    }

    /**
     * Generate datalabels ser
     *
     * @access protected
     * @param array $serDataLabels
     */
    protected function generateDATALABELS_SER($serDataLabels, $idx) {
        // default values
        $position = 'ctr';
        $showCatName = 0;
        $showLegendKey = 0;
        $showPercent = 0;
        $showSerName = 0;
        $showVal = 0;

        $xml = '<c:dLbls>__PHX=__GENERATEDLB__';
        if (isset($serDataLabels['formatCode'])) {
            $xml .= '<c:numFmt formatCode="'.$serDataLabels['formatCode'].'" sourceLinked="0"/>';
        }
        if (isset($serDataLabels['position'])) {
            switch ($serDataLabels['position']) {
                case 'bottom':
                    $position = 'b';
                    break;
                case 'center':
                    $position = 'ctr';
                    break;
                case 'insideBase':
                    $position = 'inBase';
                    break;
                case 'insideEnd':
                    $position = 'inEnd';
                    break;
                case 'left':
                    $position = 'l';
                    break;
                case 'right':
                    $position = 'r';
                    break;
                case 'outsideEnd':
                    $position = 'outEnd';
                    break;
                case 'top':
                    $position = 't';
                    break;
                default:
                    $position = 'ctr';
                    break;
            }
        }

        $xml .= '<c:dLblPos val="'.$position.'"/>';
        if (isset($serDataLabels['showCategory'])) {
            $showCatName = $serDataLabels['showCategory'];
        }
        if (isset($serDataLabels['showLegendKey'])) {
            $showLegendKey = $serDataLabels['showLegendKey'];
        }
        if (isset($serDataLabels['showPercent'])) {
            $showPercent = $serDataLabels['showPercent'];
        }
        if (isset($serDataLabels['showSeries'])) {
            $showSerName = $serDataLabels['showSeries'];
        }
        if (isset($serDataLabels['showValue'])) {
            $showVal = $serDataLabels['showValue'];
        }
        $xml .= '<c:showLegendKey val="'.$showLegendKey.'"/><c:showVal val="'.$showVal.'"/><c:showCatName val="'.$showCatName.'"/><c:showSerName val="'.$showSerName.'"/><c:showPercent val="'.$showPercent.'"/><c:showBubbleSize val="0"/></c:dLbls>__PHX=__GENERATESER__';

        $this->_xmlChart = str_replace('__PHX=__GENERATESER__', $xml, $this->_xmlChart);
    }

    /**
     * Generate w:date1904
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateDATE1904($val = '1')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':date1904 val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':date1904>__PHX=__GENERATECHARTSPACE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHARTSPACE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:defrpr
     *
     * @access protected
     * @param string $scope style scope: title
     */
    protected function generateDEFRPR($scope = null)
    {
        if ($scope !== null && $this->_stylesTitle !== null && is_array($this->_stylesTitle)) {
            $stylesXML = '';
            $stylesExtraTagsXML = '';
            $stylesColorXML = '';

            if ($scope == 'title') {
                if (isset($this->_stylesTitle['bold']) && $this->_stylesTitle['bold'] == true) {
                    $stylesXML .= ' b="1"';
                } else {
                    $stylesXML .= ' b="0"';
                }
                if (isset($this->_stylesTitle['fontSize'])) {
                    $stylesXML .= ' sz="'.$this->_stylesTitle['fontSize'].'"';
                } else {
                    $stylesXML .= ' sz="1420"';
                }
                if (isset($this->_stylesTitle['italic']) && $this->_stylesTitle['italic'] == true) {
                    $stylesXML .= ' i="1"';
                } else {
                    $stylesXML .= ' i="0"';
                }

                if (isset($this->_stylesTitle['color'])) {
                    $stylesColorXML .= '<a:solidFill><a:srgbClr val="'.$this->_stylesTitle['color'].'"/></a:solidFill>';
                }

                if (isset($this->_stylesTitle['font'])) {
                    $stylesColorXML .= '<a:latin typeface="'.$this->_stylesTitle['font'].'"/>
                            <a:ea typeface="'.$this->_stylesTitle['font'].'"/>
                            <a:cs typeface="'.$this->_stylesTitle['font'].'"/>';
                }
            }

            $xml = '<' . CreateImage::NAMESPACEWORD1 .
                ':defRPr'.$stylesXML.'>'.$stylesColorXML.'__PHX=__GENERATEDEFRPR__</' . CreateImage::NAMESPACEWORD1 .
                ':defRPr>__PHX=__GENERATETITLEPPR__';
        } else {
            $xml = '<' . CreateImage::NAMESPACEWORD1 .
                ':defRPr>__PHX=__GENERATEDEFRPR__</' . CreateImage::NAMESPACEWORD1 .
                ':defRPr>__PHX=__GENERATETITLEPPR__';
        }
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETITLEPPR__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:lang
     *
     * @access protected
     * @param string $val
     */
    protected function generateLANG($val = 'en-US')
    {
        $phpdocxconfig = PhpdocxUtilities::parseConfig();
        if (isset($phpdocxconfig['language'])) {
            $val = $phpdocxconfig['language'];
        }
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':lang val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':lang>__PHX=__GENERATECHARTSPACE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHARTSPACE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:line3DChart
     *
     * @access protected
     */
    protected function generateLINE3DCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':line3DChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':line3DChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:lineChart
     *
     * @access protected
     */
    protected function generateLINECHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':lineChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':lineChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:area3DChart
     *
     * @access protected
     */
    protected function generateAREA3DCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':area3DChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':area3DChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:areaChart
     *
     * @access protected
     */
    protected function generateAREACHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':areaChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':areaChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:perspective
     *
     * @access protected
     * @param mixed $val
     */
    protected function generatePERSPECTIVE($val = '30')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':perspective val="' . $val . '"></' .
                CreateGraphic::NAMESPACEWORD . ':perspective>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEVIEW3D__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:pie3DChart
     *
     * @access protected
     */
    protected function generatePIE3DCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':pie3DChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':pie3DChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:piechart
     *
     * @access protected
     */
    protected function generatePIECHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':pieChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':pieChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:surfaceChart
     *
     * @access protected
     */
    protected function generateSURFACECHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':surfaceChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':surfaceChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:wireframe
     *
     * @access protected
     */
    protected function generateWIREFRAME($val = 1)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':wireframe val="' . $val . '" />__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:bubbleChart
     *
     * @access protected
     */
    protected function generateBUBBLECHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':bubbleChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':bubbleChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:plotarea
     *
     * @access protected
     */
    protected function generatePLOTAREA()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':plotArea>__PHX=__GENERATEPLOTAREA__</' . CreateGraphic::NAMESPACEWORD .
                ':plotArea>__PHX=__GENERATECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:radarChart
     *
     * @access protected
     */
    protected function generateRADARCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':radarChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':radarChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:radarChart
     *
     * @access protected
     */
    protected function generateRADARCHARTSTYLE($style = 'radar')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':radarStyle val="' . $style . '" />__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:rich
     *
     * @access protected
     */
    protected function generateRICH()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':rich>__PHX=__GENERATERICH__</' . CreateGraphic::NAMESPACEWORD .
                ':rich>__PHX=__GENERATETITLETX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETITLETX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:rotx
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateROTX($val = '30')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':rotX val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':rotX>__PHX=__GENERATEVIEW3D__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEVIEW3D__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:roty
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateROTY($val = '30')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':rotY val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':rotY>__PHX=__GENERATEVIEW3D__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEVIEW3D__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate rAngAx
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateRANGAX($val = 0)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':rAngAx val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':rAngAx>__PHX=__GENERATEVIEW3D__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEVIEW3D__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate roundedCorners
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateROUNDEDCORNERS($val = 0)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':roundedCorners val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':roundedCorners>__PHX=__GENERATECHARTSPACE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHARTSPACE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:style
     *
     * @access protected
     * @param string $val
     */
    protected function generateSTYLE($val = '2')
    {
        $style_2010 = (int) $val + 100;
        $xml = '<mc:AlternateContent xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006">
                    <mc:Choice xmlns:c14="http://schemas.microsoft.com/office/drawing/2007/8/2/chart" Requires="c14">
                        <c14:style val="' . $style_2010 . '"/>
                    </mc:Choice>
                    <mc:Fallback>
                        <c:style val="' . $val . '"/>
                    </mc:Fallback>
                  </mc:AlternateContent>__PHX=__GENERATECHARTSPACE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHARTSPACE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:title
     *
     * @access protected
     */
    protected function generateTITLE()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':title>__PHX=__GENERATETITLE__<c:overlay val="0" /></' . //We include the overlay=0 as a hack for Word 2010
                CreateGraphic::NAMESPACEWORD . ':title>__PHX=__GENERATECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:layout
     *
     * @access protected
     */
    protected function generateLAYOUT()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':layout></' . CreateGraphic::NAMESPACEWORD .
                ':layout>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:titlelayout
     *
     * @access protected
     * @param string $nombre
     */
    protected function generateTITLELAYOUT($nombre = '')
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 .
                ':layout></' . CreateImage::NAMESPACEWORD1 .
                ':layout>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETITLE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:titlep
     *
     * @access protected
     */
    protected function generateTITLEP()
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 .
                ':p>__PHX=__GENERATETITLEP__</' . CreateImage::NAMESPACEWORD1 .
                ':p>__PHX=__GENERATERICH__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATERICH__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:titleppr
     *
     * @access protected
     */
    protected function generateTITLEPPR()
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 .
                ':pPr>__PHX=__GENERATETITLEPPR__</' . CreateImage::NAMESPACEWORD1 .
                ':pPr>__PHX=__GENERATETITLEP__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETITLEP__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:titler
     *
     * @access protected
     */
    protected function generateTITLER()
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 .
                ':r>__PHX=__GENERATETITLER__</' . CreateImage::NAMESPACEWORD1 .
                ':r>__PHX=__GENERATETITLEP__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETITLEP__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:titlerfonts
     *
     * @access protected
     * @param string $font
     */
    protected function generateTITLERFONTS($font = '')
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 . ':latin typeface="' .
                $font . '" pitchFamily="34" charset="0"></' .
                CreateImage::NAMESPACEWORD1 . ':latin ><' .
                CreateImage::NAMESPACEWORD1 .
                ':cs typeface="' . $font . '" pitchFamily="34" charset="0"></' .
                CreateImage::NAMESPACEWORD1 . ':cs>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETITLERPR__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:titlerpr
     *
     * @access protected
     */
    protected function generateTITLERPR($lang = 'es-ES')
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 . ':rPr lang="' .
                $lang . '">__PHX=__GENERATETITLERPR__</' . CreateImage::NAMESPACEWORD1 .
                ':rPr>__PHX=__GENERATETITLER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETITLER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:titlet
     *
     * @access protected
     * @param string $title
     */
    protected function generateTITLET($title = '')
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 . ':t>' .
                htmlspecialchars($title) . '</' . CreateImage::NAMESPACEWORD1 .
                ':t>__PHX=__GENERATETITLER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETITLER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:titletx
     *
     * @access protected
     */
    protected function generateTITLETX()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':tx>__PHX=__GENERATETITLETX__</' . CreateGraphic::NAMESPACEWORD .
                ':tx>__PHX=__GENERATETITLE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETITLE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:varyColors
     *
     * @access protected
     * @param string $val
     */
    protected function generateVARYCOLORS($val = '1')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':varyColors val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':varyColors>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:view3D
     *
     * @access protected
     */
    protected function generateVIEW3D()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':view3D>__PHX=__GENERATEVIEW3D__</' . CreateGraphic::NAMESPACEWORD .
                ':view3D>__PHX=__GENERATECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:grouping
     *
     * @access protected
     * @param string $val
     */
    protected function generateGROUPING($val = 'stacked')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':grouping val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':grouping>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:ser
     *
     * @access protected
     */
    protected function generateSER()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':ser>__PHX=__GENERATESER__</' . CreateGraphic::NAMESPACEWORD .
                ':ser>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:idx
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateIDX($val = '0')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':idx val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':idx>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:order
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateORDER($val = '0')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':order val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':order>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:tx
     *
     * @access protected
     */
    protected function generateTX()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':tx>__PHX=__GENERATETX__</' . CreateGraphic::NAMESPACEWORD .
                ':tx>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:dLbls
     *
     * @access protected
     */
    protected function generateSERDLBLS()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':dLbls>__PHX=__GENERATEDLBLS__</' . CreateGraphic::NAMESPACEWORD .
                ':dLbls>__PHX=__GENERATETYPECHART__';

        if ($this->_formatDataLabels !== null) {
            $rotation = 0;
            if(isset($this->_formatDataLabels['rotation'])) {
                $rotation = 60000 * $this->_formatDataLabels['rotation'];
            }
            $position = 'outEnd';
            if(isset($this->_formatDataLabels['position'])) {
                switch ($this->_formatDataLabels['position']) {
                    case 'center':
                        $position = 'ctr';
                        break;
                    case 'insideBase':
                        $position = 'inBase';
                        break;
                    case 'insideEnd':
                        $position = 'inEnd';
                        break;
                    case 'outsideEnd':
                        $position = 'outEnd';
                        break;
                    default:
                        $position = 'outEnd';
                        break;
                }
            }

            $xmlFormatDataLabels = '<c:txPr>
                <a:bodyPr anchor="ctr" anchorCtr="1" bIns="19050" lIns="38100" rIns="38100" rot="'.$rotation.'" spcFirstLastPara="1" tIns="19050" vertOverflow="ellipsis" wrap="square">
                    <a:spAutoFit/>
                </a:bodyPr>
                <a:lstStyle/>
                <a:p>
                    <a:pPr>
                        <a:defRPr b="0" baseline="0" i="0" kern="1200" strike="noStrike" sz="900" u="none">
                            <a:solidFill>
                                <a:schemeClr val="tx1">
                                    <a:lumMod val="75000"/>
                                    <a:lumOff val="25000"/>
                                </a:schemeClr>
                            </a:solidFill>
                            <a:latin typeface="+mn-lt"/>
                            <a:ea typeface="+mn-ea"/>
                            <a:cs typeface="+mn-cs"/>
                        </a:defRPr>
                    </a:pPr>
                    <a:endParaRPr lang="es-ES"/>
                </a:p>
            </c:txPr>
            <c:dLblPos val="'.$position.'"/>
            __PHX=__GENERATEDLBLS__';

            $xml = str_replace('__PHX=__GENERATEDLBLS__', $xmlFormatDataLabels, $xml);
        }

        $this->_xmlChart = str_replace('__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart);
    }

    /**
     * Generate c:showBubbleSize
     *
     * @access protected
     */
    protected function generateSHOWBUBBLESIZE($val = 1)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':showBubbleSize val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':showBubbleSize>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEDLBLS__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:showLegendKey
     *
     * @access protected
     */
    protected function generateSHOWLEGENDKEY($val = 1)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':showLegendKey val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':showLegendKey>__PHX=__GENERATEDLBLS__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEDLBLS__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:showVal
     *
     * @access protected
     */
    protected function generateSHOWVAL($val = 1)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':showVal val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':showVal>__PHX=__GENERATEDLBLS__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEDLBLS__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:showCatName
     *
     * @access protected
     */
    protected function generateSHOWCATNAME($val = 1)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':showCatName val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':showCatName>__PHX=__GENERATEDLBLS__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEDLBLS__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:showSerName
     *
     * @access protected
     */
    protected function generateSHOWSERNAME($val = 1)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':showSerName val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':showSerName>__PHX=__GENERATEDLBLS__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEDLBLS__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:strref
     *
     * @access protected
     */
    protected function generateSTRREF()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':strRef>__PHX=__GENERATESTRREF__</' . CreateGraphic::NAMESPACEWORD .
                ':strRef>__PHX=__GENERATETX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:f
     *
     * @access protected
     * @param string $val
     */
    protected function generateF($val = 'Sheet1!$B$1')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':f>' .
                $val . '</' . CreateGraphic::NAMESPACEWORD .
                ':f>__PHX=__GENERATESTRREF__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESTRREF__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:strcache
     *
     * @access protected
     */
    protected function generateSTRCACHE()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':strCache>__PHX=__GENERATESTRCACHE__</' . CreateGraphic::NAMESPACEWORD .
                ':strCache>__PHX=__GENERATESTRREF__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESTRREF__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:ptcount
     *
     * @access protected
     * @param mixed $val
     */
    protected function generatePTCOUNT($val = '1')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':ptCount val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':ptCount>__PHX=__GENERATESTRCACHE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESTRCACHE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:pt
     *
     * @access protected
     * @param mixed $idx
     */
    protected function generatePT($idx = '0')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':pt idx="' .
                $idx . '">__PHX=__GENERATEPT__</' . CreateGraphic::NAMESPACEWORD .
                ':pt>__PHX=__GENERATESTRCACHE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESTRCACHE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:v
     *
     * @access protected
     * @param string $idx
     */
    protected function generateV($idx = 'Ventas')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':v>' .
                htmlspecialchars($idx) . '</' . CreateGraphic::NAMESPACEWORD . ':v>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPT__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:trendline
     *
     * @access protected
     */
    protected function generateTRENDLINE($trendline)
    {
        if (count($trendline) > 0) {
            $xmlTRENDLINE = '<c:trendline>';

            if (isset($trendline['color']) || isset($trendline['line_style'])) {
                $xmlTRENDLINE .= '<c:spPr><a:ln cap="rnd" w="19050">';
                if (isset($trendline['color'])) {
                    $xmlTRENDLINE .= '<a:solidFill><a:srgbClr val="'.$trendline['color'].'"/></a:solidFill>';
                }
                if (isset($trendline['line_style'])) {
                    $xmlTRENDLINE .= '<a:prstDash val="'.$trendline['line_style'].'"/>';
                }
                $xmlTRENDLINE .= '</a:ln><a:effectLst/></c:spPr>';
            }

            if (!isset($trendline['type'])) {
                $trendline['type'] = 'linear';
            }
            $xmlTRENDLINE .= '<c:trendlineType val="'.$trendline['type'].'"/>';

            if (isset($trendline['type_order'])) {
                if ($trendline['type'] == 'poly') {
                    $xmlTRENDLINE .= '<c:order val="'.$trendline['type_order'].'"/>';
                }
                if ($trendline['type'] == 'movingAvg') {
                    $xmlTRENDLINE .= '<c:period val="'.$trendline['type_order'].'"/>';
                }
            } else {
                if ($trendline['type'] == 'poly') {
                    $xmlTRENDLINE .= '<c:order val="2"/>';
                }
                if ($trendline['type'] == 'movingAvg') {
                    $xmlTRENDLINE .= '<c:period val="2"/>';
                }
            }

            if (isset($trendline['intercept'])) {
                $xmlTRENDLINE .= '<c:intercept val="'.$trendline['intercept'].'"/>';
            }
            if (isset($trendline['display_rSquared']) && $trendline['display_rSquared'] == true) {
                $xmlTRENDLINE .= '<c:dispRSqr val="1"/>';
            } else {
                $xmlTRENDLINE .= '<c:dispRSqr val="0"/>';
            }
            if (isset($trendline['display_equation']) && $trendline['display_equation'] == true) {
                $xmlTRENDLINE .= '<c:dispEq val="1"/>';
            } else {
                $xmlTRENDLINE .= '<c:dispEq val="0"/>';
            }

            $xmlTRENDLINE .= '</c:trendline>';

            $xml = $xmlTRENDLINE.'__PHX=__GENERATESER__';

            $this->_xmlChart = str_replace(
                    '__PHX=__GENERATESER__', $xml, $this->_xmlChart
            );
        }
    }

    /**
     * Generate w:cat
     *
     * @access protected
     */
    protected function generateCAT()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':cat>__PHX=__GENERATETX__</' . CreateGraphic::NAMESPACEWORD .
                ':cat>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:val
     *
     * @access protected
     */
    protected function generateVAL()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':val>__PHX=__GENERATETX__</' . CreateGraphic::NAMESPACEWORD .
                ':val>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:numcache
     *
     * @access protected
     */
    protected function generateNUMCACHE()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':numCache>__PHX=__GENERATESTRCACHE__</' .
                CreateGraphic::NAMESPACEWORD . ':numCache>__PHX=__GENERATESTRREF__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESTRREF__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:layout
     *
     * @access protected
     */
    protected function generateLEGENDLAYOUT()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':layout />__PHX=__GENERATELEGEND__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATELEGEND__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:xVal
     *
     * @access protected
     */
    protected function generateXVAL()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':xVal>__PHX=__GENERATETX__</' . CreateGraphic::NAMESPACEWORD .
                ':xVal>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:spPr
     *
     * @access protected
     */
    protected function generateSPPR_SER()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':spPr>__PHX=__GENERATESPPR__</' . CreateGraphic::NAMESPACEWORD .
                ':spPr>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate a:solidFill
     *
     * @access protected
     * @param string $color
     */
    protected function generateSPPR_SOLIDFILL($color)
    {
        $xml = '<a:solidFill>
                    <a:srgbClr val="'.$color.'"/>
                </a:solidFill>
                <a:ln>
                    <a:noFill/>
                </a:ln>
                <a:effectLst/>__PHX=__GENERATESPPR__';

        $this->_xmlChart = str_replace('__PHX=__GENERATESPPR__', $xml, $this->_xmlChart);
    }

    /**
     * Generate a:cdpt
     *
     * @access protected
     * @param array $values
     */
    protected function generateCDPT($values)
    {
        $xml = '';
        for ($i = 0; $i < count($values); $i++) {
            if ($values[$i] == null) {
                continue;
            }
            $xml .= '<c:dPt><c:idx val="'.$i.'"/>
                    <c:spPr>
                        <a:solidFill>
                            <a:srgbClr val="'.$values[$i].'"/>
                        </a:solidFill>
                        <a:ln>
                            <a:noFill/>
                        </a:ln>
                        <a:effectLst/>
                    </c:spPr></c:dPt>
            ';
        }
        $xml .= '__PHX=__GENERATESER__';

        $this->_xmlChart = str_replace('__PHX=__GENERATESER__', $xml, $this->_xmlChart);
    }

    /**
     * Generate w:yVal
     *
     * @access protected
     */
    protected function generateYVAL()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':yVal>__PHX=__GENERATETX__</' . CreateGraphic::NAMESPACEWORD .
                ':yVal>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:bubbleSize
     *
     * @access protected
     */
    protected function generateBUBBLESIZE()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':bubbleSize>__PHX=__GENERATETX__</' . CreateGraphic::NAMESPACEWORD .
                ':bubbleSize>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:smooth
     *
     * @access protected
     */
    protected function generateSMOOTH($val = 1)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':smooth val="' . $val . '">__PHX=__GENERATETX__</' . CreateGraphic::NAMESPACEWORD .
                ':smooth>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:bubble3D
     *
     * @access protected
     */
    protected function generateBUBBLES3D($val = 1)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':bubble3D val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':bubble3D>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:bubbleScale
     *
     * @access protected
     */
    protected function generateBUBBLESCALE($val = 100)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':bubbleScale val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':bubbleScale>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate a:txPr
     *
     * @access protected
     */
    protected function generateTXPR()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':txPr>__PHX=__GENERATETXPR__</' . CreateGraphic::NAMESPACEWORD . ':txPr>__PHX=__GENERATECHARTSPACE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHARTSPACE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:bodyPr
     *
     * @access protected
     */
    protected function generateLEGENDBODYPR()
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 . ':bodyPr></' . CreateImage::NAMESPACEWORD1 . ':bodyPr>__PHX=__GENERATERICH__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETXPR__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:lststyle
     *
     * @access protected
     */
    protected function generateLSTSTYLE()
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 .
                ':lstStyle></' . CreateImage::NAMESPACEWORD1 .
                ':lstStyle>__PHX=__GENERATERICH__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATERICH__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate a:p
     *
     * @access protected
     */
    protected function generateAP()
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 . ':p>__PHX=__GENERATEAP__</' . CreateImage::NAMESPACEWORD1 . ':p>__PHX=__GENERATERICH__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATERICH__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate a:pPr
     *
     * @access protected
     */
    protected function generateAPPR($rtl = 0)
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 . ':pPr rtl="' . $rtl . '">__PHX=__GENERATETITLEPPR__</' . CreateImage::NAMESPACEWORD1 . ':pPr>__PHX=__GENERATEAP__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAP__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate a:endParaRPr
     *
     * @access protected
     */
    protected function generateENDPARARPR($lang = "es-ES_tradnl")
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 . ':endParaRPr lang="' . $lang . '" />__PHX=__GENERATEAP__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAP__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:numRef
     *
     * @access protected
     */
    protected function generateNUMREF()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':numRef>__PHX=__GENERATESTRREF__</' . CreateGraphic::NAMESPACEWORD .
                ':numRef>__PHX=__GENERATETX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:formatCode
     *
     * @access protected
     * @param string $val
     */
    protected function generateFORMATCODE($val = 'General')
    {
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESTRCACHE__', '<' . CreateGraphic::NAMESPACEWORD . ':formatCode>' . $val .
                '</' . CreateGraphic::NAMESPACEWORD .
                ':formatCode>__PHX=__GENERATESTRCACHE__', $this->_xmlChart
        );
    }

    /**
     * Generate w:legend
     *
     * @access protected
     */
    protected function generateLEGEND()
    {
        if ($this->_legendPos != 'none') {
            $xml = '<' . CreateGraphic::NAMESPACEWORD .
                    ':legend>__PHX=__GENERATELEGEND__</' .
                    CreateGraphic::NAMESPACEWORD . ':legend>__PHX=__GENERATECHART__';
            $this->_xmlChart = str_replace(
                    '__PHX=__GENERATECHART__', $xml, $this->_xmlChart
            );
        }
    }

    /**
     * Generate c:legendPos
     *
     * @access protected
     * @param string $val
     */
    protected function generateLEGENDPOS($val = 'r')
    {
        if ($val != 'none') {
            $xml = '<' . CreateGraphic::NAMESPACEWORD . ':legendPos val="' .
                    $val . '"></' . CreateGraphic::NAMESPACEWORD .
                    ':legendPos>__PHX=__GENERATELEGEND__';
            $this->_xmlChart = str_replace(
                    '__PHX=__GENERATELEGEND__', $xml, $this->_xmlChart
            );
        }
    }

    /**
     * Generate c:layout
     *
     * @access protected
     * @param string $font
     */
    protected function generateLEGENDFONT($font = '')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':layout />' .
                '<' . CreateGraphic::NAMESPACEWORD . ':txPr>' .
                '<a:bodyPr /><a:lstStyle /><a:p><a:pPr><a:defRPr>' .
                '<a:latin typeface="' . $font . '" pitchFamily="34" charset="0" />' .
                '<a:cs typeface="' . $font . '" pitchFamily="34" charset="0" />' .
                '</a:defRPr></a:pPr><a:endParaRPr lang="es-ES" /></a:p>' .
                '</' . CreateGraphic::NAMESPACEWORD . ':txPr>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATELEGEND__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:overlay
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateLEGENDOVERLAY($val = 0)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':overlay val="' .
                $val . '" />__PHX=__GENERATELEGEND__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATELEGEND__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:poltVisOnly
     *
     * @access protected
     * @param string $val
     */
    protected function generatePLOTVISONLY($val = '1')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':plotVisOnly val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':plotVisOnly>__PHX=__GENERATECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:externalData
     *
     * @access protected
     * @param string $val
     */
    protected function generateEXTERNALDATA($val = 'rId1')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':externalData r:id="' . $val . '"></' .
                CreateGraphic::NAMESPACEWORD . ':externalData>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHARTSPACE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:spPr
     *
     * @access protected
     */
    protected function generateSPPR()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':spPr>__PHX=__GENERATESPPR__</' . CreateGraphic::NAMESPACEWORD .
                ':spPr>__PHX=__GENERATECHARTSPACE__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECHARTSPACE__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:ln
     *
     * @access protected
     * @param mixed $w
     * @param mixed $cap
     * @param mixed $cmpd
     * @param mixed $algn
     */
    protected function generateLN($w = null, $cap = null, $cmpd = null, $algn = null)
    {
        if (is_numeric($w)) {
            $xml = '<' . CreateImage::NAMESPACEWORD1 . ':ln w="' . ($w * 12700) . '">__PHX=__GENERATELN__</' .
                    CreateImage::NAMESPACEWORD1 . ':ln>';
        } else {
            $xml = '<' . CreateImage::NAMESPACEWORD1 . ':ln>__PHX=__GENERATELN__</' .
                    CreateImage::NAMESPACEWORD1 . ':ln>';
        }
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESPPR__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:noFill
     *
     * @access protected
     */
    protected function generateNOFILL()
    {
        $xml = '<' . CreateImage::NAMESPACEWORD1 . ':noFill></' .
                CreateImage::NAMESPACEWORD1 . ':noFill>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATELN__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:overlap
     *
     * @access protected
     * @param string $val
     */
    protected function generateOVERLAP($val = '100')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':overlap val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':overlap>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:shape
     *
     * @access protected
     * @param string $val
     */
    protected function generateSHAPE($val = 'box')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':shape val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':shape>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:bandFmts
     *
     * @access protected
     * @param string $val
     */
    protected function generateBANDFMTS($val = 'box')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':bandFmts />__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:axid
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateAXID($val = '59034624')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':axId val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':axId>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:firstSliceAng
     *
     * @access protected
     * @param string $val
     */
    protected function generateFIRSTSLICEANG($val = '0')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':firstSliceAng val="' . $val . '"></' .
                CreateGraphic::NAMESPACEWORD . ':firstSliceAng>' . '__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:dLbls
     *
     * @access protected
     */
    protected function generateDLBLS()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':dLbls>__PHX=__GENERATEDLBLS__</' . CreateGraphic::NAMESPACEWORD .
                ':dLbls>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:holeSize
     *
     * @access protected
     */
    protected function generateHOLESIZE($val = 50)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':holeSize val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':holeSize>__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:showPercent
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateSHOWPERCENT($val = '0')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':showPercent val="' . $val . '"></' .
                CreateGraphic::NAMESPACEWORD . ':showPercent>__PHX=__GENERATEDLBLS__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEDLBLS__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:chart
     *
     * @access protected
     */
    protected function generateDOCUMENTCHART()
    {
        $this->_xml = str_replace(
                '__PHX=__GENERATEGRAPHICDATA__', '<' . CreateGraphic::NAMESPACEWORD .
                ':chart xmlns:c="http://schemas.openxmlformats.org/drawingml/' .
                '2006/chart" xmlns:r="http://schemas.openxmlformats.org/offic' .
                'eDocument/2006/relationships" r:id="rId' . $this->getRId() .
                '"></' . CreateGraphic::NAMESPACEWORD .
                ':chart>', $this->_xml
        );
    }

    /**
     * Generate w:catAx
     *
     * @access protected
     */
    protected function generateCATAX()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':catAx>__PHX=__GENERATEAX__</' . CreateGraphic::NAMESPACEWORD .
                ':catAx>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:dTable
     *
     * @access protected
     */
    protected function generateDATATABLE()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':dTable>' .
                '<' . CreateGraphic::NAMESPACEWORD . ':showHorzBorder val="1"/>' .
                '<' . CreateGraphic::NAMESPACEWORD . ':showVertBorder val="1"/>' .
                '<' . CreateGraphic::NAMESPACEWORD . ':showOutline val="1"/>' .
                '<' . CreateGraphic::NAMESPACEWORD . ':showKeys val="1"/>' .
                '</' . CreateGraphic::NAMESPACEWORD . ':dTable>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:valAx
     *
     * @access protected
     */
    protected function generateVALAX()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':valAx>__PHX=__GENERATEAX__</' .
                CreateGraphic::NAMESPACEWORD .
                ':valAx>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:axId
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateAXAXID($val = '59034624')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':axId val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':axId>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:scaling
     *
     * @access protected
     */
    protected function generateDELETE($val = 0)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':delete val="' . $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':delete>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:scaling
     *
     * @access protected
     * @param bool $addScalingValues
     */
    protected function generateSCALING($addScalingValues = false)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':scaling>__PHX=__GENERATESCALING__</' . CreateGraphic::NAMESPACEWORD .
                ':scaling>__PHX=__GENERATEAX__';

        if ($this->_scalingMax !== null && $addScalingValues) {
            $xml = str_replace(
                '__PHX=__GENERATESCALING__', '<' . CreateGraphic::NAMESPACEWORD .
                ':max val="'.$this->_scalingMax.'" />__PHX=__GENERATESCALING__', $xml
            );
        }

        if ($this->_scalingMin !== null && $addScalingValues) {
            $xml = str_replace(
                '__PHX=__GENERATESCALING__', '<' . CreateGraphic::NAMESPACEWORD .
                ':min val="'.$this->_scalingMin.'" />__PHX=__GENERATESCALING__', $xml
            );
        }

        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:orientation
     *
     * @access protected
     * @param string $val
     */
    protected function generateORIENTATION($val = 'minMax')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':orientation val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD . ':orientation>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESCALING__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:axPos
     *
     * @access protected
     * @param string $val
     */
    protected function generateAXPOS($val = 'b')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':axPos val="' . $val .
                '"></' . CreateGraphic::NAMESPACEWORD . ':axPos>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:title
     *
     * @access protected
     * @param string $val
     */
    protected function generateAXLABEL($val = 'Axis title')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':title><c:tx><c:rich>' .
                '__PHX=__GENERATEBODYPR__<a:lstStyle/><a:p><a:pPr><a:defRPr/></a:pPr>' .
                '<a:r><a:t>' . htmlspecialchars($val) . '</a:t></a:r></a:p></c:rich></c:tx><c:overlay val="0"/>' .
                '</' . CreateGraphic::NAMESPACEWORD . ':title>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate a:bodyPr
     *
     * @access protected
     * @param string $val
     */
    protected function generateAXLABELDISP($val = 'horz', $rot = 0)
    {
        $xml = '<a:bodyPr rot="' . $rot . '" vert="' . $val . '"/>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEBODYPR__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:surface3DChart
     *
     * @access protected
     */
    protected function generateSURFACE3DCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':surface3DChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':surface3DChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:serAx
     *
     * @access protected
     */
    protected function generateSERAX()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':serAx>__PHX=__GENERATEAX__</' .
                CreateGraphic::NAMESPACEWORD .
                ':serAx>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:scatterStyle
     *
     * @access protected
     */
    protected function generateSCATTERSTYLE($style = 'smoothMarker')
    {
        $possibleStyles = array('none', 'line', 'lineMarker', 'marker', 'smooth', 'smoothMarker');
        if (!in_array($style, $possibleStyles))
            $style = 'smoothMarker';
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':scatterStyle val="' . $style . '" />__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:tickLblPos
     *
     * @access protected
     * @param string $val
     * @param bool $isHorizontal
     */
    protected function generateTICKLBLPOS($val = 'nextTo', $isHorizontal = false)
    {
        if ($isHorizontal) {
            $val = $this->_tickLblPos;
        }

        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':tickLblPos val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':tickLblPos>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:crossAx
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateCROSSAX($val = '59040512')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':crossAx  val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':crossAx >__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:crosses
     *
     * @access protected
     * @param string $val
     */
    protected function generateCROSSES($val = 'autoZero')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':crosses val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':crosses>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:auto
     *
     * @access protected
     * @param string $val
     */
    protected function generateAUTO($val = '1')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':auto val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':auto>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:lblAlgn
     *
     * @access protected
     * @param string $val
     */
    protected function generateLBLALGN($val = 'ctr')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':lblAlgn val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':lblAlgn>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:lblOffset
     *
     * @access protected
     * @param string $val
     */
    protected function generateLBLOFFSET($val = '100')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':lblOffset val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD . ':lblOffset>';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:majorTickMark
     *
     * @access protected
     */
    protected function generateMAJORTICKMARK($val = 'none')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':majorTickMark val="' . $val . '"></' .
                CreateGraphic::NAMESPACEWORD . ':majorTickMark>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:majorUnit
     *
     * @access protected
     */
    protected function generateMAJORUNIT($val = null)
    {
        if ($val !== null) {
            $xml = '<' . CreateGraphic::NAMESPACEWORD . ':majorUnit val="' . $val . '"></' .
                CreateGraphic::NAMESPACEWORD . ':majorUnit>__PHX=__GENERATEAX__';
            $this->_xmlChart = str_replace(
                    '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
            );
        }
    }

    /**
     * Generate c:minorUnit
     *
     * @access protected
     */
    protected function generateMINORUNIT($val = null)
    {
        if ($val !== null) {
            $xml = '<' . CreateGraphic::NAMESPACEWORD . ':minorUnit val="' . $val . '"></' .
                CreateGraphic::NAMESPACEWORD . ':minorUnit>__PHX=__GENERATEAX__';
            $this->_xmlChart = str_replace(
                    '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
            );
        }
    }

    /**
     * Generate c:majorGridlines
     *
     * @access protected
     */
    protected function generateMAJORGRIDLINES()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':majorGridlines></' .
                CreateGraphic::NAMESPACEWORD . ':majorGridlines>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:majorGridlines
     *
     * @access protected
     */
    protected function generateMARKER($symbol = 'none', $size = NULL)
    {
        $symbols = array('circle', 'dash', 'diamond', 'dot', 'none', 'picture', 'plus', 'square', 'star', 'triangle', 'x');
        if (!in_array($symbol, $symbols)) {
            $symbol = 'none';
        }
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':marker>' .
                '<' . CreateGraphic::NAMESPACEWORD . ':symbol val="' . $symbol . '"/>';
        if (!empty($size) && is_int($size) && $size < 73 && $size > 1) {
            $xml .= '<' . CreateGraphic::NAMESPACEWORD . ':size val="' . $size . '"></' . CreateGraphic::NAMESPACEWORD . ':size>';
        }
        $xml .= '</' . CreateGraphic::NAMESPACEWORD . ':marker>__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:majorGridlines
     *
     * @access protected
     */
    protected function generateMINORGRIDLINES($val = '')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':minorGridlines></' .
                CreateGraphic::NAMESPACEWORD . ':minorGridlines>__PHX=__GENERATEAX__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:numFmt
     *
     * @access protected
     * @param string $formatCode
     * @param mixed $sourceLinked
     */
    protected function generateNUMFMT($formatCode = 'General', $sourceLinked = '1')
    {
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', '<' .
                CreateGraphic::NAMESPACEWORD .
                ':numFmt formatCode="' . $formatCode .
                '" sourceLinked="' . $sourceLinked . '"></' .
                CreateGraphic::NAMESPACEWORD . ':numFmt>__PHX=__GENERATEAX__', $this->_xmlChart
        );
    }

    /**
     * Generate w:numFmt in ser
     *
     * @access protected
     */
    protected function generateNUMFMT_SER($formatCode = 'General', $sourceLinked = '1')
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':numFmt formatCode="' . $formatCode . '" sourceLinked="' . $sourceLinked . '" />__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace('__PHX=__GENERATESER__', $xml, $this->_xmlChart);
    }

    /**
     * Generate w:latin
     *
     * @access protected
     * @param string $font
     */
    protected function generateRFONTS($font)
    {
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEDEFRPR__', '<' .
                CreateImage::NAMESPACEWORD1 . ':latin typeface="' .
                $font . '" pitchFamily="34" charset="0"></' .
                CreateImage::NAMESPACEWORD1 . ':latin ><' .
                CreateImage::NAMESPACEWORD1 . ':cs typeface="' .
                $font . '" pitchFamily="34" charset="0"></' .
                CreateImage::NAMESPACEWORD1 . ':cs>', $this->_xmlChart
        );
    }

    /**
     * Generate w:crossBetween
     *
     * @access protected
     * @param string $val
     */
    protected function generateCROSSBETWEEN($val = 'between')
    {
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', '<' .
                CreateGraphic::NAMESPACEWORD . ':crossBetween val="' .
                $val . '"></' . CreateGraphic::NAMESPACEWORD .
                ':crossBetween>', $this->_xmlChart
        );
    }

    /**
     * Generate w:ofPieChart
     *
     * @access protected
     */
    protected function generateOFPIECHART()
    {
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', '<' .
                CreateGraphic::NAMESPACEWORD . ':ofPieChart>' .
                '__PHX=__GENERATETYPECHART__' .
                '</' . CreateGraphic::NAMESPACEWORD . ':ofPieChart>', $this->_xmlChart
        );
    }

    /**
     * Generate c:ofPieType
     *
     * @access protected
     * @param string $val
     */
    protected function generateOFPIETYPE($val = 'pie')
    {
        if (!in_array($val, array('pie', 'bar'))) {
            $val = 'pie';
        }
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', '<' .
                CreateGraphic::NAMESPACEWORD . ':ofPieType val="' . $val . '">' .
                '</' . CreateGraphic::NAMESPACEWORD . ':ofPieType>' .
                '__PHX=__GENERATETYPECHART__', $this->_xmlChart
        );
    }

    /**
     * Generate w:scatterChart
     *
     * @access protected
     */
    protected function generateSCATTERCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':scatterChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':scatterChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate w:doughnutChart
     *
     * @access protected
     */
    protected function generateDOUGHNUTCHART()
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD .
                ':doughnutChart>__PHX=__GENERATETYPECHART__</' .
                CreateGraphic::NAMESPACEWORD .
                ':doughnutChart>__PHX=__GENERATEPLOTAREA__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEPLOTAREA__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:GAPWIDTH
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateGAPWIDTH($val = 100)
    {
        if (!is_numeric($val)) {
            $val = 100;
        }
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', '<' .
                CreateGraphic::NAMESPACEWORD . ':gapWidth val="' . $val . '">' .
                '</' . CreateGraphic::NAMESPACEWORD . ':gapWidth>' .
                '__PHX=__GENERATETYPECHART__', $this->_xmlChart
        );
    }

    /**
     * Generate c:secondPieSize
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateSECONDPIESIZE($val = 75)
    {
        if (!is_numeric($val)) {
            $val = 75;
        }
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', '<' .
                CreateGraphic::NAMESPACEWORD . ':secondPieSize val="' . $val . '">' .
                '</' . CreateGraphic::NAMESPACEWORD . ':secondPieSize>' .
                '__PHX=__GENERATETYPECHART__', $this->_xmlChart
        );
    }

    /**
     * Generate c:serLines
     *
     * @access protected
     */
    protected function generateSERLINES()
    {
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', '<' .
                CreateGraphic::NAMESPACEWORD . ':serLines>' .
                '</' . CreateGraphic::NAMESPACEWORD . ':serLines>' .
                '__PHX=__GENERATETYPECHART__', $this->_xmlChart
        );
    }

    /**
     * Generate c:splitType
     *
     * @access protected
     * @param string $val
     */
    protected function generateSPLITTYPE($val)
    {
        if (!in_array($val, array('auto', 'cust', 'percent', 'pos', 'val'))) {
            $xml = '<' . CreateGraphic::NAMESPACEWORD . ':splitType>' .
                    '</' . CreateGraphic::NAMESPACEWORD . ':splitType>' .
                    '__PHX=__GENERATETYPECHART__';
        } else {
            $xml = '<' . CreateGraphic::NAMESPACEWORD . ':splitType val="' . $val . '">' .
                    '</' . CreateGraphic::NAMESPACEWORD . ':splitType>' .
                    '__PHX=__GENERATETYPECHART__';
        }
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:custSplit
     *
     * @access protected
     */
    protected function generateCUSTSPLIT()
    {
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', '<' .
                CreateGraphic::NAMESPACEWORD . ':custSplit>' .
                '__PHX=__GENERATECUSTSPLIT__' .
                '</' . CreateGraphic::NAMESPACEWORD . ':custSplit>' .
                '__PHX=__GENERATETYPECHART__', $this->_xmlChart
        );
    }

    /**
     * Generate c:splitType
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateSECONDPIEPT($val)
    {
        $xml = '';
        if (is_array($val)) {
            foreach ($val as $value) {
                $xml .= '<' . CreateGraphic::NAMESPACEWORD . ':secondPiePt val="' . $value . '">' .
                        '</' . CreateGraphic::NAMESPACEWORD . ':secondPiePt>';
            }
        }
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATECUSTSPLIT__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:splitPos
     *
     * @access protected
     * @param string $val
     */
    protected function generateSPLITPOS($val, $type = "auto")
    {
        if ($type == 'pos') {
            $val = (int) $val;
        }
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':splitPos val="' . $val . '">' .
                '</' . CreateGraphic::NAMESPACEWORD . ':splitPos>' .
                '__PHX=__GENERATETYPECHART__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATETYPECHART__', $xml, $this->_xmlChart
        );
    }

    /**
     * Generate c:explosion
     *
     * @access protected
     * @param mixed $val
     */
    protected function generateEXPLOSION($val = 25)
    {
        $xml = '<' . CreateGraphic::NAMESPACEWORD . ':explosion val="' . $val . '">' .
                '</' . CreateGraphic::NAMESPACEWORD . ':explosion>' .
                '__PHX=__GENERATESER__';
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATESER__', $xml, $this->_xmlChart
        );
    }

    /**
     * Create chart xml
     *
     * @access protected
     */
    protected function createCHARTXML()
    {
        $this->_xmlChart = '';
        $args = func_get_args();
        $this->setRId($args[0][0]);
        $this->initGraphic($args[0][1]);
        $this->createEmbeddedXmlChart();
        return true;
    }

    /**
     * Clean tags in template document
     *
     * @access protected
     */
    protected function cleanTemplateDocument()
    {
        $this->_xmlChart = preg_replace('/__PHX=__[A-Z]+__/', '', $this->_xmlChart);
    }

    /**
     * Clean tags in template document
     *
     * @access protected
     */
    public static function cleanTemplateChart($xml = "")
    {
        return preg_replace('/__PHX=__[A-Z]+__/', '', $xml);
    }

    /**
     * Clean tags in template document
     *
     * @access protected
     */
    protected function cleanTemplate2()
    {
        $this->_xmlChart = preg_replace(
                array(
            '/__PHX=__GENERATE[A-B,D-O,Q-R,U-Z][A-Z]+__/',
            '/__PHX=__GENERATES[A-D,F-Z][A-Z]+__/', '/__PHX=__GENERATETX__/'), '', $this->_xmlChart
        );
    }

    /**
     * Clean tags in template document
     *
     * @access protected
     */
    protected function cleanTemplateFonts()
    {
        $this->_xmlChart = preg_replace(
                '/__PHX=__GENERATETITLE[A-Z]+__/', '', $this->_xmlChart
        );
    }

    /**
     * Clean tags in template document
     *
     * @access protected
     */
    protected function cleanTemplate3()
    {
        $this->_xmlChart = preg_replace(
                array(
            '/__PHX=__GENERATE[A-B,D-O,Q-S,U-Z][A-Z]+__/',
            '/__PHX=__GENERATES[A-D,F-Z][A-Z]+__/',
            '/__PHX=__GENERATETX__/'
                ), '', $this->_xmlChart
        );
    }

    /**
     * Generate c:txPr
     *
     * @access protected
     * @param string $font
     */
    protected function generateRFONTS2($font)
    {
        $this->_xmlChart = str_replace(
                '__PHX=__GENERATEAX__', '<c:txPr><a:bodyPr /><a:lstStyle /><a:p>' .
                '<a:pPr><a:defRPr><a:latin typeface="' .
                $font . '" pitchFamily="34" charset="0" /><a:cs typeface="' .
                $font . '" pitchFamily="34" charset="0" /></a:defRPr>' .
                '</a:pPr><a:endParaRPr lang="es-ES" /></a:p></c:txPr>' .
                '__PHX=__GENERATEAX__', $this->_xmlChart
        );
    }

    /**
     * Generate table
     *
     * @param int $rows
     * @param int $cols
     * @access protected
     */
    protected function generateTABLE($rows, $cols)
    {
        $word = 'A';
        for ($i = 0; $i < $cols; $i++) {
            $word++;
        }
        $rows++;
        $this->_xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
                '<table xmlns="http://schemas.openxmlformats.org/spreads' .
                'heetml/2006/main" id="1" name="Tabla1" displayName=' .
                '"Tabla1" ref="A1:' . $word . $rows .
                '" totalsRowShown="0" tableBorderDxfId="0">' .
                '__PHX=__GENERATETABLE__</table>';
    }

    /**
     * Generate tablecolumn
     *
     * @param mixed $id
     * @param string $name
     * @access protected
     */
    protected function generateTABLECOLUMN($id = '2', $name = '')
    {
        $xml = '<tableColumn id="' . $id . '" name="' . $name .
                '"></tableColumn >__PHX=__GENERATETABLECOLUMNS__';

        $this->_xml = str_replace(
                '__PHX=__GENERATETABLECOLUMNS__', $xml, $this->_xml
        );
    }

    /**
     * Generate tablecolumns
     *
     * @param mixed $count
     * @access protected
     */
    protected function generateTABLECOLUMNS($count = '2')
    {
        $xml = '<tableColumns count="' . $count .
                '">__PHX=__GENERATETABLECOLUMNS__</tableColumns>__PHX=__GENERATETABLE__';

        $this->_xml = str_replace('__PHX=__GENERATETABLE__', $xml, $this->_xml);
    }

    /**
     * Generate tablestyleinfo
     *
     * @param string $showFirstColumn
     * @param string $showLastColumn
     * @param string $showRowStripes
     * @param string $showColumnStripes
     * @access protected
     */
    protected function generateTABLESTYLEINFO($showFirstColumn = '0', $showLastColumn = "0", $showRowStripes = "1", $showColumnStripes = "0")
    {
        $xml = '<tableStyleInfo   showFirstColumn="' . $showFirstColumn .
                '" showLastColumn="' . $showLastColumn .
                '" showRowStripes="' . $showRowStripes .
                '" showColumnStripes="' . $showColumnStripes .
                '"></tableStyleInfo >';

        $this->_xml = str_replace('__PHX=__GENERATETABLE__', $xml, $this->_xml);
    }

}
