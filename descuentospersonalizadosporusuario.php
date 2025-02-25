<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class DescuentosPersonalizadosPorUsuario extends Module
{
    public function __construct()
    {
        $this->name = 'descuentospersonalizadosporusuario';
        $this->tab = 'pricing_promotion';
        $this->version = '1.0.0';
        $this->author = 'Ing. Edgar Chávez';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Descuentos Personalizados por Usuario');
        $this->description = $this->l('Este módulo permitirá a los administradores asignar descuentos específicos a usuarios individuales desde el back-office y mostrarlos en el front-end cuando el usuario inicie sesión');
        $this->confirmUninstall = $this->l('¿Estás seguro de que deseas desinstalar este módulo?');

        $this->ps_versions_compliancy = array('min' => '8.1', 'max' => _PS_VERSION_);

        if(!Configuration::get('DESCUENTOSPERSONALIZADOSPORUSUARIO')) {
            $this->warning = $this->l('No hay nombre proporcionado');
        }
    }

    public function install()
    {
        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() 
            && $this->registerHook('displayProductAdditionalInfo')
            && $this->registerHook('actionAdminCustomersFormModifier');
    }

    public function uninstall()
    {
        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }


    public function hookDisplayProductAdditionalInfo($params)
    {
        $this->context->smarty->assign(array(
            'descuentos_personalizados_por_usuario' => Configuration::get('DESCUENTOSPERSONALIZADOSPORUSUARIO')
        ));

        return $this->display(__FILE__, 'views/templates/admin/configuration.tpl');
    }

    public function hookActionAdminCustomersFormModifier(array $params)
    {
        $params['fields'][0]['form']['input'][] = array(
            'type' => 'text',
            'label' => $this->l('Descuento personalizado'),
            'name' => 'custom_discount',
            'required' => false,
        );

        $id_customer = (int) Tools::getValue('id_customer');
        $custom_discount = Db::getInstance()->getValue('SELECT custom_discount FROM '._DB_PREFIX_.'customer WHERE id_customer = '.(int)$id_customer);

        $params['fields_value']['custom_discount'] = $custom_discount;
    }

    public function getContent()
    {
        $title = 'Configuración de descuentos por cliente';
        $content = '';

        if((bool)Tools::isSubmit('btnSubmit')) {
            $nameDiscount = Tools::getValue('nombre_descuento');
            $content = $nameDiscount;
            // Configuration::updateValue('nombre_descuento', $nameDiscount);
            // $content .= $this->displayConfirmation($this->l('Configuración actualizada'));
        }
        if(Tools::isSubmit('btnSubmit')) {
            $content .= $this->displayConfirmation($this->l('Configuración actualizada'));
        }

        $this->context->smarty->assign(array(
            'title' => $title,
            'content' => $content
        ));

        $output = $this->display(__FILE__, 'views/templates/admin/configuration.tpl');
        // return $this->display(__FILE__, 'views/templates/admin/configuration.tpl');
        return $output.$this->renderForm();
    }

    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'btnSubmit';

        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        
        $this->fields_form = array();
        
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
            
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFormValues()
        );

        return $helper->generateForm(array($this->getConfigForm()));
    }

    protected function getConfigForm(){
        return array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Configuración de descuentos por cliente'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Nombre del descuento'),
                        'name' => 'nombre_descuento',
                        'required' => true
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Guardar')
                )
            )
        );
    }

    protected function getConfigFormValues()
    {
        return array(
            'nombre_descuento' => Configuration::get('nombre_descuento', 'My shop')
        );
    }


}
?>