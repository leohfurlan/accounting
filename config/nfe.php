<?php defined('BASEPATH') OR exit('No direct script access allowed');

return [
    // Caminho para o certificado .pfx
    'cert_path'       => FCPATH . 'modules/accounting/certs/1000934887_LEONARDO HENRIQUE FURLNA E SILVA_ECNPJ_123456.pfx',
    'cert_password'   => '123456',
    'environment'     => 'homologacao', // 'producao'
    'uf'              => 'MG',         // Unidade federativa emitente
    'municipio_ibge'  => '3170206',    // Código IBGE do município
    'schema_path'     => APPPATH . 'third_party/sped-nfe/schemas',
    'timeout'         => 30,
];
