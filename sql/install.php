<?php

$aSql = array();

$aSql[] = '
    CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'module_name` (
        `id_module_name` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `lib` varchar(255) NOT NULL,
        `id_shop` int(11) unsigned NOT NULL,
        `date_add` datetime NOT NULL,
        `date_upd` datetime NOT NULL,
        PRIMARY KEY (`id_module_name`, `id_shop`)
    ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;
';

foreach ($aSql as $sQuery) {
    if (Db::getInstance()->execute($sQuery) == false) {
        return false;
    }
}
