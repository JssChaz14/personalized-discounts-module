<?php
/*
class DescuentosPersonalizadosController extends ModuleAdminController
{
    public function __construct()
    {
        $this->table = 'descuentos_personalizados';
        $this->className = 'DescuentosPersonalizados';
        $this->lang = false;
        $this->bootstrap = true;
        parent::__construct();
    }

    public function renderForm()
    {
        $this->fields_form = [
            'legend' => [
                'title' => $this->l('Agregar Descuento Personalizado'),
                'icon' => 'icon-tag',
            ],
            'input' => [
                [
                    'type' => 'text',
                    'label' => $this->l('Nombre del Descuento'),
                    'name' => 'nombre_descuento',
                    'required' => true,
                ],
                [
                    'type' => 'select',
                    'label' => $this->l('Tipo de Descuento'),
                    'name' => 'tipo_descuento',
                    'required' => true,
                    'options' => [
                        'query' => [
                            ['id' => 'porcentaje', 'name' => $this->l('Porcentaje')],
                            ['id' => 'cantidad', 'name' => $this->l('Cantidad')],
                        ],
                        'id' => 'id',
                        'name' => 'name',
                    ],
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('Valor del Descuento'),
                    'name' => 'valor_descuento',
                    'required' => true,
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('ID del Usuario'),
                    'name' => 'id_usuario',
                    'required' => true,
                ],
                [
                    'type' => 'select',
                    'label' => $this->l('Aplicar a'),
                    'name' => 'aplicar_a',
                    'required' => true,
                    'options' => [
                        'query' => [
                            ['id' => 'uno', 'name' => $this->l('Un producto')],
                            ['id' => 'todos', 'name' => $this->l('Todos los productos')],
                        ],
                        'id' => 'id',
                        'name' => 'name',
                    ],
                ],
            ],
            'submit' => [
                'title' => $this->l('Guardar'),
            ],
        ];

        return parent::renderForm();
    }

    public function postProcess()
    {
        if (Tools::isSubmit('submitAdddescuentos_personalizados')) {
            $nombre_descuento = Tools::getValue('nombre_descuento');
            $tipo_descuento = Tools::getValue('tipo_descuento');
            $valor_descuento = Tools::getValue('valor_descuento');
            $id_usuario = Tools::getValue('id_usuario');
            $aplicar_a = Tools::getValue('aplicar_a');

            if (empty($nombre_descuento) || empty($tipo_descuento) || empty($valor_descuento) || empty($id_usuario) || empty($aplicar_a)) {
                $this->errors[] = $this->l('Todos los campos son obligatorios.');
            } else {
                $descuento = new DescuentosPersonalizados();
                $descuento->nombre_descuento = $nombre_descuento;
                $descuento->tipo_descuento = $tipo_descuento;
                $descuento->valor_descuento = $valor_descuento;
                $descuento->id_usuario = $id_usuario;
                $descuento->aplicar_a = $aplicar_a;

                if (!$descuento->save()) {
                    $this->errors[] = $this->l('Ocurrió un error al guardar el descuento.');
                } else {
                    Tools::redirectAdmin(self::$currentIndex.'&conf=3&token='.$this->token);
                }
            }
        }

        parent::postProcess();
    }
}
    */
?>