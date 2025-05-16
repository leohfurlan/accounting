<?php
defined('BASEPATH') or exit('No direct script access allowed');

$module_name = 'Accounting';
$config['modules']['Accounting'] = [
    'name'        => 'Contabilidade',
    'description' => 'Módulo de gerenciamento contábil para empresas brasileiras',
    'version'     => '1.0.0',
    'author'      => 'Leonardo Furlan',
    'author_url'  => 'https://atospd.com',
    'menu'        => [
        'title'  => 'Contabilidade',
        'url'    => 'accounting/dashboard',
        'icon'   => 'fa fa-calculator',
        'parent' => 'Financeiro',
    ],
];