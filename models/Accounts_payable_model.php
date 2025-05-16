<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts_payable_model extends CI_Model {
    protected $table = 'acc_accounts_payable';

    public function get_all() {
        return $this->db->order_by('due_date','ASC')->get($this->table)->result();
    }

    public function get($id) {
        return $this->db->where('id',$id)->get($this->table)->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db->where('id',$id)->update($this->table, $data);
    }

    public function mark_paid($id) {
        return $this->db->where('id',$id)->update($this->table, ['status' => 'Pago']);
    }
}