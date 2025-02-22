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
        return parent::install() 
            && $this->registerHook('displayProductAdditionalInfo')
            && $this->registerHook('actionAdminCustomersFormModifier')
            && $this->createAdminTab();
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function createAdminTab()
    {
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'AdminDescuentosPersonalizadosPorUsuario';
        $tab->name = array();

        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Descuentos Personalizados por Usuario';
        }
        $contenttab->id_parent = (int) Tab::getIdFromClassName('AdminCustomers');
        $tab->module = $this->name;
        $tab->icon = 'discount';

        return $tab->add();
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

        $this->context->smarty->assign(array(
            'title' => $title,
            'content' => $content
        ));

        return $this->display(__FILE__, 'views/templates/admin/configuration.tpl');
    }


}
?>