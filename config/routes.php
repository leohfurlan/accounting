<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Dashboard de Contabilidade
$route['accounting/dashboard']           = 'accounting/dashboard/index';

// Plano de Contas (COA)
$route['accounting/coa']                 = 'accounting/coa/index';
$route['accounting/coa/create']          = 'accounting/coa/create';
$route['accounting/coa/edit/(:num)']     = 'accounting/coa/edit/$1';
$route['accounting/coa/delete/(:num)']   = 'accounting/coa/delete/$1';

// Lançamentos Contábeis (Journal)
$route['accounting/journal']             = 'accounting/journal/index';
$route['accounting/journal/create']      = 'accounting/journal/create';
$route['accounting/journal/edit/(:num)'] = 'accounting/journal/edit/$1';
$route['accounting/journal/delete/(:num)']= 'accounting/journal/delete/$1';

// Contas de Caixa e Bancos
$route['accounting/cash_accounts']              = 'accounting/cash_accounts/index';
$route['accounting/cash_accounts/create']       = 'accounting/cash_accounts/create';
$route['accounting/cash_accounts/edit/(:num)']  = 'accounting/cash_accounts/edit/$1';
$route['accounting/cash_accounts/delete/(:num)']= 'accounting/cash_accounts/delete/$1';

// Contas a Pagar
$route['accounting/accounts_payable']               = 'accounting/accounts_payable/index';
$route['accounting/accounts_payable/create']        = 'accounting/accounts_payable/create';
$route['accounting/accounts_payable/edit/(:num)']   = 'accounting/accounts_payable/edit/$1';
$route['accounting/accounts_payable/pay/(:num)']    = 'accounting/accounts_payable/pay/$1';

// Contas a Receber
$route['accounting/accounts_receivable']               = 'accounting/accounts_receivable/index';
$route['accounting/accounts_receivable/create']        = 'accounting/accounts_receivable/create';
$route['accounting/accounts_receivable/edit/(:num)']   = 'accounting/accounts_receivable/edit/$1';
$route['accounting/accounts_receivable/receive/(:num)']= 'accounting/accounts_receivable/receive/$1';

// NF-e (Nota Fiscal Eletrônica)
$route['accounting/nfe']               = 'accounting/nfe/index';
$route['accounting/nfe/create']        = 'accounting/nfe/create';
$route['accounting/nfe/send/(:num)']   = 'accounting/nfe/send/$1';
$route['accounting/nfe/xml/(:num)']    = 'accounting/nfe/xml/$1';
$route['accounting/nfe/danfe/(:num)']  = 'accounting/nfe/danfe/$1';
$route['accounting/nfe/view/(:num)']   = 'accounting/nfe/view/$1';

// Guias de Impostos (DARF, GPS, GNRE, DAS, DIRF)
$route['accounting/tax_guides']             = 'accounting/tax_guides/index';
$route['accounting/tax_guides/create']      = 'accounting/tax_guides/create';
$route['accounting/tax_guides/send_batch']  = 'accounting/tax_guides/send_batch';

// Relatórios Contábeis
$route['accounting/reports/balance_sheet']    = 'accounting/reports/balance_sheet';
$route['accounting/reports/income_statement'] = 'accounting/reports/income_statement';
$route['accounting/reports/cash_flow']        = 'accounting/reports/cash_flow';
$route['accounting/reports/export/(:any)']    = 'accounting/reports/export/$1';