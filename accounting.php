<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
Module Name: Contabilidade
Description: Módulo de contabilidade construído pela Atos PD&I
Version: 1.0.0
Requires at least: 2.3.*
*/

// Hooks do módulo
hooks()->add_action('app_init', 'accounting_calls_init');
hooks()->add_action('admin_init', 'accounting_init_menu_permissions');
hooks()->add_action('app_admin_enqueue_scripts', 'accounting_enqueue_assets');

/**
 * Inicialização geral do módulo após carregamento
 */
function accounting_calls_init() {
    // Setup inicial do módulo (register_staff_capability já disponível sem carregamento extra de helpers)
}

/**
 * Registrar scripts e estilos do módulo
 */
function accounting_enqueue_assets() {
    $CI = &get_instance();
    $CI->app_scripts->enqueue('accounting-js', module_dir_url('accounting', 'assets/js/accounting.js'));
    $CI->app_css->enqueue('accounting-css', module_dir_url('accounting', 'assets/css/accounting.css'));
}

/**
 * Inserir item no menu e registrar permissões
 */
function accounting_init_menu_permissions() {
    $CI = &get_instance();

    // Adicionar item de menu apenas para administradores
    if (is_admin()) {
        $CI->app_menu->add_sidebar_menu_item('accounting', [
            'collapse' => 'finance',
            'name'     => 'Contabilidade',
            'href'     => admin_url('accounting/dashboard'),
            'position' => 35,
            'icon'     => 'fa fa-calculator',
        ]);
    }
}


/**
 * Executado na ativação do módulo
 */
function accounting_activate() {
    $CI = &get_instance();
    $dir = module_dir_path('accounting', 'sql');
    foreach (glob($dir . '/*.sql') as $file) {
        $CI->db->query(file_get_contents($file));
    }
    add_option('accounting_some_option', 'value', 1);
}

/**
 * Executado na desativação do módulo
 */
function accounting_deactivate() {
    // Limpeza opcional: tarefas agendadas, etc.
}

/**
 * Executado na desinstalação do módulo
 */
function accounting_uninstall() {
    $CI = &get_instance();
    $tables = [
        'acc_coa',
        'acc_journal_entries',
        'acc_journal_lines',
        'acc_cash_accounts',
        'acc_accounts_payable',
        'acc_accounts_receivable',
        'acc_nfe',
        'acc_tax_guides'
    ];
    foreach ($tables as $tbl) {
        $CI->db->query('DROP TABLE IF EXISTS `' . db_prefix() . $tbl . '`');
    }
    delete_option('accounting_some_option');
}
