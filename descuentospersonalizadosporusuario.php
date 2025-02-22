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
            && $this->registerHook('displayProductAdditionalInfo');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookDisplayProductAdditionalInfo($params)
    {
        $this->context->smarty->assign(array(
            'descuentos_personalizados_por_usuario' => Configuration::get('DESCUENTOSPERSONALIZADOSPORUSUARIO')
        ));

        return $this->display(__FILE__, 'descuentospersonalizadosporusuario.tpl');
    }

    public function getContent()
    {
        $title = 'Configuración de descuentos por cliente';
        $content = 'Aquí puedes configurar los descuentos personalizados por cliente';

        $this->context->smarty->assign(array(
            'title' => $title,
            'content' => $content
        ));

        return $this->display(__FILE__, 'views/templates/admin/configuration.tpl');
    }

}
?>