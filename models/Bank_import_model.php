<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_import_model extends CI_Model {
    public function insert_import($data) {
        $this->db->insert('acc_bank_imports', $data);
        return $this->db->insert_id();
    }

    public function insert_lines($import_id, $lines) {
        foreach ($lines as $line) {
            $line['import_id'] = $import_id;
            $this->db->insert('acc_bank_import_lines', $line);
        }
    }

    public function get_imports() {
        return $this->db->order_by('import_date','DESC')->get('acc_bank_imports')->result();
    }

    public function get_lines($import_id) {
        return $this->db->where('import_id',$import_id)->get('acc_bank_import_lines')->result();
    }

    public function match_line($line_id, $journal_line_id) {
        return $this->db->where('id',$line_id)
                        ->update('acc_bank_import_lines',['matched'=>1,'journal_line_id'=>$journal_line_id]);
    }
}