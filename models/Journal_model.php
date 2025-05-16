<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model {
    protected $entries_table = 'acc_journal_entries';
    protected $lines_table   = 'acc_journal_lines';

    public function get_all_entries() {
        return $this->db->order_by('date','DESC')->get($this->entries_table)->result();
    }

    public function get_entry($id) {
        $entry = $this->db->where('id',$id)->get($this->entries_table)->row();
        if ($entry) {
            $entry->lines = $this->db->where('journal_entry_id',$id)->get($this->lines_table)->result();
        }
        return $entry;
    }

    public function insert_entry($data, $lines) {
        $this->db->trans_start();
        $this->db->insert($this->entries_table, $data);
        $entry_id = $this->db->insert_id();
        foreach ($lines as $line) {
            $line['journal_entry_id'] = $entry_id;
            $this->db->insert($this->lines_table, $line);
        }
        $this->db->trans_complete();
        return $entry_id;
    }

    public function update_entry($id, $data, $lines) {
        $this->db->trans_start();
        $this->db->where('id',$id)->update($this->entries_table,$data);
        $this->db->where('journal_entry_id',$id)->delete($this->lines_table);
        $this->db->insert($this->entries_table, $data);
        $entry_id = $this->db->insert_id();
        foreach ($lines as $line) {
            $line['journal_entry_id'] = $id;
            $this->db->insert($this->lines_table, $line);
        }
        $this->db->trans_complete();
    }

    public function delete_entry($id) {
        return $this->db->where('id',$id)->delete($this->entries_table);
    }
}