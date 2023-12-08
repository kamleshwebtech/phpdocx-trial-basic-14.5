<?php

/**
 * Create OLE elements
 *
 * @category   Phpdocx
 * @package    elements
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (https://www.2mdc.com)
 * @license    phpdocx LICENSE
 * @link       https://www.phpdocx.com
 */
class CreateOLE extends CreateElement
{
    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $fileDoc = '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';

    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $fileDocx = 'iVBORw0KGgoAAAANSUhEUgAAADUAAAA1CAYAAADh5qNwAAABb2lDQ1BpY2MAACiRdZE7SwNBFIW/xPdbUETEIoWKRQJBQSw1FjZBQoxg1CZZN4mQx7KbIMFWsLEIWIg2vgr/gbaCrYIgKIKIlT/AVyOy3kkCCZLMMns/zsy5zJwBpz+ppaxGL6TSWTM473Mth1dcLW+0MUAz3fRGNMuYDQT81B3fDzhUvfeoXvX31Rwd67qlgaNVeEozzKzwjLB/M2so3hXu1xKRdeFjYbcpBxS+UXq0xK+K4yX+VGyGgnPgVD1d8SqOVrGWMFPC48IjqWROK59H3aRTTy8tSh2SOYxFkHl8uIiSY4MkWTxS05JZbZ+36FsgIx5N/gZ5THHESYjXLWpOuupSY6Lr8iXJq9z/52nFJidK3Tt90PRi2x+j0LIHvwXb/jmx7d9TaHiGq3TFn5Gcpr9EL1S0kSPo2YaL64oW3YfLHRh8MiJmpCg1yHTGYvB+Dl1h6LuD9tVSVuV1zh4htCVPdAsHhzAm+3vW/gCeimfdRqvRZAAAAAlwSFlzAAAL1wAAC9cBJXXS8AAABbVJREFUaN7tmn1IVXcYx7/n5d7rW74sXS3fKnGOcmXzD0fI5rKRW+D+aEIg4d6620wQs2Yw/9gyEGsKg+lWkAqj0aYtFIQhBaNo2Yhh7DoVQqTZq+8vV++9npf9fr9l1iw9x3M8V4YPHDj3vHiez+95nu/v+Z0jsGIrtmJmGrfQBZtzvjvGCbbPVXl6yZ1RwWNVoHj703dfeem97JSJxf4dfgGgAxwvFquyZMkIS5KEdc+HvbA3K/krVVXFJYEiVqWqSgAdQ6tMkiXeYRM+Jrs1BMxmPhTH2aEqltYDAYGssEHcT7ZvFwPGL/AEvxS6OvvcD8l2Um8qinofZgYnz3N6Ln+f3kKe7eQ4zmcqFGUJdNhgtwmGodxTvpkU02p5D8H2EzCvaVBen4QDOanI2bnJEJBCQu081oKu3kHYRF7Prfsegn1EwDzmRIoM7KogB6IiggxHyibw82gTcerZ53PJJhCwDwjYlCk1pbMWMK/nTzFB4PBgyIPPKs5Cud825zr6y2az7XW5XBvI7quGoSjQzb+H8NuNPsPpNzHpI/7OBePJsXFy7tzFm5BvX3+6OJPb7HZ72qLbJNJRPFHNvmkZ05LxeUskEXlWtGY94x85aBeFOZ52/OTkDEeKAuW8uQlvpMZbOmdNeqZRXncFoxNezemvGYpK8OaNkdiZtsFSKK9PRtWZtocTsjYoXZoqyda2TDMZonfC1xwpOkYer4Rxt89SqDG39/G2yVwoh0PEyZ//QG3zDYsbQdKBkLoSBN58KEVWkRDzHDZGh1vKRNX21+u98JCOhuNMFgqfJOOd119E7lvJlkJRmKyCH5gK0sn5fyEUVP30CoUuKFHgLYdy2AVwOrszzelHlxyNFzvxe8cdS6EkkvZjRHH19J3aez8yXLcfjGNwdMryVbBExILjlgCKFmxRbprlQjFG2qOcknPoH3ZrlnVdSw+7jSerX9Hi9FN019SyFwpay0smFHSOaO++j5BAu7VdOmnNPF7ZvJqa8j75ZvbH1r9w5heXpVBU9EKDHeap3xfO1+BvmyICdbrpT9JIT0Er17xQ+3a/7Hcor8eD709/A4VLBB+0GlreGC9aysbHx3Hv3j02j0RFRSEiImK2+VUUdHd3Y3JyEomJiQgNDX10bnh4GD09PYiMjGTb3bt3ER8fT1+oYGRkhG3r16+fnUoIlDJEUj5sHfkVab6kP24XLlxAaWkpc8jtdiM3NxdOp5PtFxcXw+VyISQkBD6fD1VVVUhJScGlS5fYPcHBwQz8+PHjKCsrQ0ZGBgoKCpCfn49t27bh8OHD/1nMiZpXvYag6AiuXbsWDQ0NuHbtGnNq+/bt6OzsRFtbG5qamrBmzRoUFRUx52tra3H06FFkZWUxaBoRGuGDBw+ipKSERXVoaIgNjGFxWeyNVGIFQWCjvmPHDkRHR6O9vR0dHR3YsmULi2BAQAB27dqFW7duobe3F/39/cjOziYLTgcD5nmeDURaWhpOnDiBQ4cOISwszH9QM2BsrUVSbGxsDOHh4QyS1tuM0YjQegkK+vfNLk3Px21wcBBdXV1ISkpiETZlGjDSaA4MDOD8+fMoLCxkTqenp7OoUZGorq5GS0sLTp06hczMTMTGxmLr1q2oqKhg9djY2MiAysvLERMTg7q6OnastbXVf1BxcXFITk5Gc3Mzq636+noWqdTUVFRWVuLq1avM0T179rC6oVGlQAkJCaipqcHly5fR19fHonzkyBGmkvQ6eh/9TGoogxaIhurveWqUpO/bu3djMDQTYmgccUpmxzsaPuGWpKasMCpGem1eSc/Ly/M7FE3F0dFR8OEmvSK7cifa71BUYG3xpEUKjITWj+rzQgWsTvDbx+y5BU6BVC1SsEBHobBlJ79swGZCp6qSEUn/kuMEZTkJBxlj+v9EhUagylRF+poTxOUBxAskC+VSIuc1WLEVWzHL7B+NtT7r3DjSvAAAAABJRU5ErkJggg==';

    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $filePdf = 'iVBORw0KGgoAAAANSUhEUgAAADUAAAA1CAYAAADh5qNwAAABb2lDQ1BpY2MAACiRdZE7SwNBFIW/xPdbUETEIoWKRQJBQSw1FjZBQoxg1CZZN4mQx7KbIMFWsLEIWIg2vgr/gbaCrYIgKIKIlT/AVyOy3kkCCZLMMns/zsy5zJwBpz+ppaxGL6TSWTM473Mth1dcLW+0MUAz3fRGNMuYDQT81B3fDzhUvfeoXvX31Rwd67qlgaNVeEozzKzwjLB/M2so3hXu1xKRdeFjYbcpBxS+UXq0xK+K4yX+VGyGgnPgVD1d8SqOVrGWMFPC48IjqWROK59H3aRTTy8tSh2SOYxFkHl8uIiSY4MkWTxS05JZbZ+36FsgIx5N/gZ5THHESYjXLWpOuupSY6Lr8iXJq9z/52nFJidK3Tt90PRi2x+j0LIHvwXb/jmx7d9TaHiGq3TFn5Gcpr9EL1S0kSPo2YaL64oW3YfLHRh8MiJmpCg1yHTGYvB+Dl1h6LuD9tVSVuV1zh4htCVPdAsHhzAm+3vW/gCeimfdRqvRZAAAAAlwSFlzAAAL1wAAC9cBJXXS8AAABjlJREFUaN7tWntMU1cY/93b3raUFnzwqPKwgCKCk2yO4ANwbGbZICxm022JCC6C2xK3uuEDnO4PxT/2SMwwSEycuJi4BQhzDg3oHy4uzmVzY5v4mDLmQECFlUFbWtrbe3fOxek0Wmrpy4QvOcnppff0/M73+37f950ATNiETZg3jRnrC3VxMw+GmeyFdlH0+WZk5DfYsLDu5PL1KUnr1po9XYd19ccGXcIWjcn+ssMPgKg5HDw0cTHT9CVFH4uiKPcJKMWIc6dTFBWiH6nDO3mWVSpfJ9M9BBjndVCMIEL0czwQIBB5J52WklHjCTCXoMQABbp4h+5ryNj7sFRkfbYxpxOC3e6NpV4jYx8BpggoKAoodGYipi5eAMHh8MaSxbeAKQMGigKZkvkkMusPQD0jzlseW0XGpwSYKiCgWIUC15ua4Ry2ImXLBuieWwpRENzMnAxY7oEhtJKMWgIsxNUScl+AYlgWIzf70HWoAWHz0qCZMxu9R49DFuL6kBm5DI6e62h6w4DjWsV9T5zjuFfbzrclkOkCv4Ia3aAcPUeOIXFdKa7uPeBG7TJ6GPygCX8e/ALntdwDaaRUKjP97imJghwH8+/tsPxxFdbeXrJhmVvvOVkGCawSZTYXX7I5cDQgkk5iiAvTSkIx6Yl0klB599+l4MYYAclTVPEichbBdOkydHnPEvHg4C/zGSgaH5FLn8LF93dCplIhYsliCCN2v4DySUzR5KtO0EMxdQr6T30HZVQkkjetR/+3Z2gNJMn2I+cp6pHpy/JgPPOjNO9uOEJy1jCSNxrAW4YfQfoRTyimTEbk00vQXdcIVqmQnv1q2IzpLxVAv2YVeLNF8ub/B7zYs3mdfk6rFfq1qzF0/iLMl9vBkOqCthKmK1dwdmUpMg7tg2q6Dp2ffS7RkJGxEqCRfiNxseAVarpc4Uh43EMdH6351Pp4pFd9iJ9Wvyl91qYkY1L6XGhTU6CMjIBmVhJU06IldeQmhYMnpZRgteHmiZP45a2NUn5zx14Y7GJ87inB7iCKx+Cxj3aAN5mQuuM9CZCTxJC5vYN47hIsHSQRX+uGwzhAhGQGYlYsQ0TWQnDhYWBVSuIk1itCMm5P0aT6n0dml79LYimbnPo36Dt5Csbvz2K46xoE28htqlGpBxlSLJF35Vot5JpQ8EOm0dhyE5DPPOUktFHHx0r1XUJJMSlaW3Ay8xnYem/cKpXkBIgMMnXIffMYqU4hkgOx/20c/ewlqfcYFD3lmBcLkLzZgPB5c9Hz1TG0rjUQr/FjVuP3thoUeMCTL71DkGs1SN25TQr43q+b8XPp2xJQF71QcJdJDDld3mTBjWMnpBbjt3cqJCmn82Awz4WCqhSJAxrkjsGh0Zjwo3ksFLS0GYuGVLWkBOrDc5di9CFExCWoeZ98EHAqCSQ5X91VDRuVfDfZwIzhCTHQoKxEiDYtzMHj7V2IhgwC48eK4l7rJS28iVQWHMlF8fHxkBHZ7uvrw8DAAAlFFjExMQgJGc1f/f390nMnSb4ajQaxsbG31xkhAvSDSoaZpFqZRkpDYbz0G49t3boVbW1tUKvVSEpKwu7du1FVVYWmpibodDoJQEVFBXJzc1FTU4PGxkZERUUhIyMDlZWVd29SdOvexvedL/VSYWEh6urqcPr0aVy4cAE2mw05OTmor69HXl4eysvLYbFYYCXeyM7ORnNzM7Zv3x687Tyl3blz57B//36oSDsfHR0tqSV9Tim2fPlymM1mdHZ2IjQ0FK2trSgrK8Phw4eDFxSNm46ODhiNRlRXV0txwtOK45aC0RgSSP9EAVIqhoeHIzU1VaJmUN5RUKNeKCgogMFguCPPBER7e7tEv9raWmRlZUlgKVUTExNRUlISvBcv1DIzM6HX6+96Nn/+fMlDLS0tyM/PR1FRkVRypaWlwW733k1T0OepfwYHkf98Hl65+BdmCSx4N/IUiyA3mQdtiUv6FRcXBxyUg4jL4NDgKDhBHD+o9C+PB0EfwWARSQM60uk7GS94ag7DBQcHHaIESPQG/QQZAzEA/3YwlrLRWyuPk69NIdslAxNMmMAyjNMaIt/mMaibiZM3WDTyBoWPL/TdNQWpRixabs+Kno5KTNiETZjf7F/04ovftQSxsAAAAABJRU5ErkJggg==';

    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $filePpt = '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';

    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $filePptx = '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';

    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $fileXls = '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';

    /**
     *
     * @access public
     * @static
     * @var string
     */
    public static $fileXlsx = 'iVBORw0KGgoAAAANSUhEUgAAADUAAAA1CAYAAADh5qNwAAABb2lDQ1BpY2MAACiRdZE7SwNBFIW/xPdbUETEIoWKRQJBQSw1FjZBQoxg1CZZN4mQx7KbIMFWsLEIWIg2vgr/gbaCrYIgKIKIlT/AVyOy3kkCCZLMMns/zsy5zJwBpz+ppaxGL6TSWTM473Mth1dcLW+0MUAz3fRGNMuYDQT81B3fDzhUvfeoXvX31Rwd67qlgaNVeEozzKzwjLB/M2so3hXu1xKRdeFjYbcpBxS+UXq0xK+K4yX+VGyGgnPgVD1d8SqOVrGWMFPC48IjqWROK59H3aRTTy8tSh2SOYxFkHl8uIiSY4MkWTxS05JZbZ+36FsgIx5N/gZ5THHESYjXLWpOuupSY6Lr8iXJq9z/52nFJidK3Tt90PRi2x+j0LIHvwXb/jmx7d9TaHiGq3TFn5Gcpr9EL1S0kSPo2YaL64oW3YfLHRh8MiJmpCg1yHTGYvB+Dl1h6LuD9tVSVuV1zh4htCVPdAsHhzAm+3vW/gCeimfdRqvRZAAAAAlwSFlzAAAL1wAAC9cBJXXS8AAABWxJREFUaN7tWWtIXEcU/u69+3BNfQQXgzZWDMRUsKUPaRqaEkugJfFHQm2qIEXSVCJqC5GqxCC0JCmlSqG/QoNamh9CahLaGLA21KaFJA1WTNIUNF2DRWPEqnXVdR/31Znx0Yb42Lne3dXgkVnZ3Tl35pvzzXfOzALrtm7rZqYJy3XYVJN7StvgL9ZlNeST0UUg1hp9v+LVgqdLdrw5ZfQ54lJfJn6070PN4TsYDkDUZFnB5o2bkt7NyqnTdd1i9DlLOmqi8hk0TQgndVRFFe0W22G64ARYqSAIsqmRgkgA6eHdDwQIFJ0xo4i0U+S91VxQemQ2OgU2a4dI+5KXiuIaELODpNUTYLbHCRS1wllg9scJFLV3SGsgwKLWHCiidrCKi26hAtK+IsAchiU93GYRJTzwjKKk8Tg23B5fYMkJYKs1/4/f76SRNy+vCVAiiZLb70FT5/eI7hihHyzYz2a3b18zkZpJjaQlx0HeH7945UFffrm9dkDN50fdeJK0GB+Xb1BhtnbWDWR1AUJ4QImcwjm3CKIB0eVdQG5QPiWA93e8hbef3c3lV/pdHW4+cKFuTyl2pD4TtN+kfxqHzn+CEY8bkiiGBpSma0iJ34TnkrZy+W2wOZjvVmcKl68n4CN5S+KKlqHkq2r856u5IpXXV1YV7rraECia9VdQMoSy+/LHeefxPfpC9EuOdcIZHc81UO/YfUIlL9I2JiPGHh08K8h4f470Q9aUh1RwpKZVMG1P0UG2JqQga3MGl9/fN3+A2+dh+2lLwpPBC5McwF//DCFAaBhs1LhBUY6/kb4dh1/az+X3870uuEi0Cp5/Ha9teZFLbc/f+QkTpHwSBSl0e4oCM6KadKH9Ct+Vg1f2c+cpQ6CsEn/OFgWRTc1u4btycFjtoa8o6FnnR9dvbNPz2IPJEdjJYnxzux1dg3c5IhWAR/ayCj5k6jdHP4Uz39gtNjaxgCqTXKVx+UZZbY9Ey1T1m6OfEQqys5BE6CchpLbkzKZlX+SP9+RvoUgZBvV5zgcRBzVN1O+LX5sx6SWSHiQwYZl6TY80qIDPj1fe24d7SQGIGx00Nyy7p0y5Terv78fw8PB84drb2wuPx4PBwUGMjY091Hd0dBSdnZ0YGBjA9PQ0XC4XFGUm742Pj6Ovr+9h9fP5YHdNQPSqCJaBpoC6cuUKCgoK4Pf70draiqKiIni9XlRWVqKpqWm+X3d3N/Lz81FTU4PS0lIGmvY5ffo0+764uBjnzp17lDGSAJ5UZcodRV5eHi5duoQTJ06wKNAJO51OBmwuCtRu3LiByclJtLW1sUo/NjYW5eXlqK6uxtTUFNxuN1uQFV/emAHKZrPh2LFjqK+vR0JCAnJzc2ceTk6q/z+mZGdnIyYmBgcOHEBXVxf7bOfOncjKykJtbS0qKioQFxe3OkBRa29vR1paGoaGhhit5qlg+Y8MqampaGlpQU5ODsrKytDT08OiQ/9v27YN169fN+eazYyHdHR04MyZM2hoaEBmZiaOHj0KWZahkcrh1q1bDMi1a9cY7S5evMgAMLkmQnHy5EkGtrGxEc3Nzbh8+XLkQVG1u3r1KkpKSpCRkcEo5HA4mKrt2rULPqJeZ8+eZZGUJAkXLlxgAGg/SlUKrKqqCunp6Thy5AiLlqqu7OfYVZ+n3ONu7M3Zi7svEBonP0FPqeHJU6E0Gl1Ta7/CwsKIg6IpgYqJJCVCNQNUS3Rv5AtaQjLr7kRo8fb5EmlFoMSn4iCsAgqqM/cBQV/BLw1KFaALWsR+pV9M2gRdNC7pgmr5lJQF+qpSDkFQBMVaYRhU1ERSteSzfy1YpNWBh8xD8kfVDn/8bR3Wbd3WLWz2L5UVKx1ri/urAAAAAElFTkSuQmCC';

    /**
     * @access private
     * @static
     */
    private static $_instance = NULL;

    /**
     *
     * @access private
     * @var string
     */
    private $_height;

    /**
     *
     * @access private
     * @var string
     */
    private $_progId;

    /**
     *
     * @access private
     * @var mixed
     */
    private $_rId;

    /**
     *
     * @access private
     * @var int
     */
    private $_dyaOrig;

    /**
     *
     * @access private
     * @var int
     */
    private $_dxaOrig;

    /**
     *
     * @access private
     * @var string
     */
    private $_rIdImage;

    /**
     *
     * @access private
     * @var string
     */
    private $_width;

    /**
     * Construct
     *
     * @access public
     */
    public function __construct()
    {
        $this->_height = '';
        $this->_progId = '';
        $this->_rId = '';
        $this->_rIdImage = '';
        $this->_width = '';
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
     * @return string
     * @access public
     */
    public function __toString()
    {
        return $this->_xml;
    }

    /**
     *
     * @return CreateOLE
     * @access public
     * @static
     */
    public static function getInstance()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new CreateOLE();
        }
        return self::$_instance;
    }

    /**
     * Create OLE object
     *
     * @access public
     */
    public function createOLE()
    {
        $this->_height = '';
        $this->_progId = '';
        $this->_rId = '';
        $this->_rIdImage = '';
        $this->_width = '';
        $this->_dxaOrig = 996;
        $this->_dyaOrig = 996;

        $args = func_get_args();
        if (isset($args[0]['height'])) {
            $this->_height = $args[0]['height'] . 'pt';
            $this->_dyaOrig = $args[0]['height'] * 20;
        } else {
            $this->_height = '35pt';
        }
        if (isset($args[0]['width'])) {
            $this->_width = $args[0]['width'] . 'pt';
            $this->_dxaOrig = $args[0]['width'] * 20;
        } else {
            $this->_width = '40pt';
        }
        $this->_rId = $args[0]['rId'];
        $this->_rIdImage = $args[0]['rIdImage'];

        switch ($args[0]['extension']) {
            case 'doc':
                $this->_progId = 'Word';
                break;
            case 'docx':
                $this->_progId = 'Word';
                break;
            case 'ppt':
                $this->_progId = 'PowerPoint';
                break;
            case 'pptx':
                $this->_progId = 'PowerPoint';
                break;
            case 'xls':
                $this->_progId = 'Excel';
                break;
            case 'xlsx':
                $this->_progId = 'Excel';
                break;
            default:
                $this->_progId = '';
                break;
        }

        $this->generateP();
        $this->generateR();
        $this->generateOBJECT();
    }

    /**
     * Generate w:object
     *
     * @access protected
     */
    protected function generateOBJECT()
    {
        $oleId = rand(1000, 999999);
        $xml = '<w:object w:dxaOrig="'.$this->_dxaOrig.'" w:dyaOrig="'.$this->_dyaOrig.'"><v:shape id="ole_rId'.$this->_rId.'" o:ole="" style="width:'.$this->_width.';height:'.$this->_height.'" type="#_x0000_t75"><v:imagedata o:title="" r:id="rId'.$this->_rIdImage.'"/></v:shape><o:OLEObject DrawAspect="Icon" ObjectID="'.$oleId.'" ProgID="'.$this->_progId.'" ShapeID="ole_rId'.$this->_rId.'" Type="Embed" r:id="rId'.$this->_rId.'"/></w:object>';

        $this->_xml = str_replace('__PHX=__GENERATER__', $xml, $this->_xml);
    }
}