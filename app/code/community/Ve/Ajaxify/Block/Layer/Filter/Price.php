<?php
/**
* Virtual Employee Ajaxify 
* 
* @category     VE
* @package      Ve_Ajaxify
* @copyright    Copyright (c) 2015 VE (http://www.virtualemployee.com/)
* @author       VE (Magento Team)
* @version      Release: 1.0.0
* @Class        Ve_Ajaxify_Block_Layer_Filter_Price   
*/ 
class Ve_Ajaxify_Block_Layer_Filter_Price extends Mage_Catalog_Block_Layer_Filter_Price
{
    private $_filterType;  
    
    public function __construct()
    {
        parent::__construct(); 
		$this->_filterType = Mage::getStoreConfig('ajaxify/ajaxifynavigation/price_style');
		//Load Custom PHTML of price
		//echo 'ajaxify/filter_price_' . $this->_filterType . '.phtml';
       $this->setTemplate('ajaxify/filter_price_' . $this->_filterType . '.phtml');
           //  $this->setTemplate('ajaxify/filter_price_both.phtml');

		//Set Filter Model Name
        $this->_filterModelName = 'ajaxify/layer_filter_price';
    }
    
    public function getVar(){
		//Get request variable name which is used for apply filter
        return $this->_filter->getRequestVar();
    }
    
    public function getClearUrl()
    {
        $_seoURL = '';
        $query = Mage::helper('ajaxify')->getParams();
        if (!empty($query[$this->getVar()])){
			if (!empty($query[$this->getVar()])){
				$query[$this->getVar()] = null;
				$_seoURL = Mage::getUrl('*/*/*', array(
					'_use_rewrite' => true, 
					'_query'       => $query,
				)); 
			}
		}
        return $_seoURL;
    }
    
    public function isSelected($item)
    {
        return ($item->getValueString() == $this->_filter->getActiveState());        
    }
    
    public function getSymbol()
    {
		//To Get the current Currency Symbol 
		// Thanks to this blog (http://magento-developer-magento.blogspot.com/2011/11/how-to-get-current-currency-and.html)
        $_symbol = $this->getData('symbol');
        if (!$_symbol){
            $currency_code = Mage::app()->getStore()->getCurrentCurrencyCode();   
            $_symbol = trim(Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol());
            $this->setData('symbol', $_symbol);
        }
        return $_symbol;
    }
	
	public function getOffSet() {
		
		$minmaxArray = $this->_filter->getMinMaxPriceInt(); 
		$fromtoArray = explode(',', $this->_filter->getActiveState()); 
		
	}
} 
