<?php defined('BASEPATH') OR exit('No direct script access allowed');
use OfxParser\Parser;

function parse_ofx($path) {
    $parser = new Parser();
    $ofx    = $parser->loadFromFile($path);
    $lines  = [];
    foreach ($ofx->bank->statement->transactions as $t) {
        $lines[] = [
            'line_date'   => $t->date->format('Y-m-d'),
            'description' => $t->name,
            'amount'      => $t->amount
        ];
    }
    return $lines;
}

function parse_csv($path) {
    $file   = fopen($path, 'r');
    $header = fgetcsv($file, 0, ';');
    $lines  = [];
    while ($row = fgetcsv($file, 0, ';')) {
        $data    = array_combine($header, $row);
        $lines[] = [
            'line_date'   => date('Y-m-d', strtotime($data['Data'])),
            'description' => $data['Descrição'],
            'amount'      => $data['Valor']
        ];
    }
    fclose($file);
    return $lines;
}
