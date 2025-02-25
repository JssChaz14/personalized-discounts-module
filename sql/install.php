<?php


$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'descuentospersonalizadosporusuario (
        id_descuentospersonalizadosporusuario int(11) NOT NULL AUTO_INCREMENT,
        id_customer int(11),
        nombre_descuento varchar(255),
        type_discount varchar(255),
        total_discount varchar(255),
        apply_discount varchar(255),
        date_add datetime,
        PRIMARY KEY (id_descuentospersonalizadosporusuario)
    ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

    foreach ($sql as $query) {
        if (Db::getInstance()->execute($query) == false) {
            return false;
        }
    }
