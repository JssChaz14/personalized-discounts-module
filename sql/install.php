<?php


$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'descuentospersonalizadosporusuario (
        id_descuentospersonalizadosporusuario int(11) NOT NULL AUTO_INCREMENT,
        id_customer int(11) NOT NULL,
        name_discount varchar(255) NOT NULL,
        type_discount varchar(255) NOT NULL,
        total_discount varchar(255) NOT NULL,
        apply_discount varchar(255),
        date_add datetime NOT NULL,
        PRIMARY KEY (id_descuentospersonalizadosporusuario)
    ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

    foreach ($sql as $query) {
        if (Db::getInstance()->execute($query) == false) {
            return false;
        }
    }
