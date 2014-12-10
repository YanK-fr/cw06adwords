<?php
if (!defined('_CAN_LOAD_FILES_'))
	exit;


class cw06adwords extends Module {
    
    public function __construct($name = NULL) {
        $this->name = 'cw06adwords';
        $this->tab = 'analytics_stats';
        $this->version = '1.1';
        $this->author = 'creaweb06.fr';
        parent::__construct($name);
        $this->displayName = $this->l('Conversions Google Adwords et Facebook');
        $this->description = $this->l('Ajoute le tag de conversion pour Google Adwords et Facebook sur la page de confirmation de commande.');
    }
    
    public function install(){
        if(!parent::install()
                || !$this->registerHook('orderConfirmation'))
            return false;
        return true;
    }
    
    public function getContent(){
        
        $this->_html = '<h2>'.$this->displayName.'</h2>';
        
        if(Tools::isSubmit('submitConfigGA')){
            Configuration::updateValue('CW06ADWORDS_GA_CONVERSION_ID',Tools::getValue('GA_CONVERSION_ID'));
            Configuration::updateValue('CW06ADWORDS_GA_CONVERSION_LABEL',Tools::getValue('GA_CONVERSION_LABEL'));
            $this->_html .= $this->displayConfirmation('Paramètres enregistrés avec succès');
        }
        if(Tools::isSubmit('submitConfigFB')){
			Configuration::updateValue('CW06ADWORDS_FB_CONVERSION_ID',Tools::getValue('FB_CONVERSION_ID'));
            $this->_html .= $this->displayConfirmation('Paramètres enregistrés avec succès');
        }
        
        $this->_html .= '<fieldset>'
                . '<legend>'.$this->l('Google Analytics').'</legend>'
                . '<form method="POST">'
                . '<label>'.$this->l('Conversion ID').'</label>'
                . '<div class="margin-form">'
                . '<input type="text" name="GA_CONVERSION_ID" value="'.Configuration::get('CW06ADWORDS_GA_CONVERSION_ID').'" />'
                . '</div>'
                . '<label>'.$this->l('Conversion Label').'</label>'
                . '<div class="margin-form">'
                . '<input type="text" name="GA_CONVERSION_LABEL" value="'.Configuration::get('CW06ADWORDS_GA_CONVERSION_LABEL').'" />'
                . '</div>'
                . '<div class="margin-form">'
                . '<input type="submit" name="submitConfigGA" value="'.$this->l('Enregistrer').'" />'
                . '</div>'
                . '</form>'
                . '</fieldset>';

        $this->_html .= '<fieldset>'
                . '<legend>'.$this->l('Facebook').'</legend>'
                . '<form method="POST">'
                . '<label>'.$this->l('Conversion ID').'</label>'
                . '<div class="margin-form">'
                . '<input type="text" name="FB_CONVERSION_ID" value="'.Configuration::get('CW06ADWORDS_FB_CONVERSION_ID').'" />'
                . '</div>'
                . '<div class="margin-form">'
                . '<input type="submit" name="submitConfigFB" value="'.$this->l('Enregistrer').'" />'
                . '</div>'
                . '</form>'
                . '</fieldset>';
		
        return $this->_html;
    }
    
    public function hookOrderConfirmation($params){       
        global $smarty;
        $smarty->assign('GA_CONVERSION_ID',Configuration::get('CW06ADWORDS_GA_CONVERSION_ID'));
        $smarty->assign('GA_CONVERSION_LABEL',Configuration::get('CW06ADWORDS_GA_CONVERSION_LABEL'));
        $smarty->assign('FB_CONVERSION_ID',Configuration::get('CW06ADWORDS_FB_CONVERSION_ID'));
        $smarty->assign('CONVERSION_AMOUNT',$params['objOrder']->total_paid);
        return $this->display(__FILE__, 'orderConfirmation.tpl');
    }
    
}

