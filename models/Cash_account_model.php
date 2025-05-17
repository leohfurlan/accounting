<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cash_account_model extends App_Model {
    protected $table = 'tblacc_cash_accounts'; // corrigido

    public function get_all() {
        return $this->db->order_by('name')->get($this->table)->result();
    }

    public function get($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function get_balance($id) {
        $query = $this->db->select('SUM(debit) as debit, SUM(credit) as credit')
            ->from('acc_journal_lines l')
            ->join('acc_journal_entries e', 'e.id = l.journal_entry_id')
            ->where('l.coa_id =', $id)
            ->get()->row();
        return $query->debit - $query->credit + $this->get($id)->initial_balance;
    }
}
