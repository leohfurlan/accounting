<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Tax_guide_model extends CI_Model {
    protected $table = 'acc_tax_guides';

    public function create(array $data) {
        // Adiciona bank_code padrão se não informado
        if (empty($data['bank_code'])) {
            $data['bank_code'] = '010';
        }
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_pending() {
        return $this->db->where('status','pendente')->get($this->table)->result();
    }

    public function get($id) {
        return $this->db->where('id',$id)->get($this->table)->row();
    }

    public function mark_sent($id, $path) {
        return $this->db->where('id',$id)->update($this->table, [
            'status'=>'enviado',
            'file_path'=>$path,
            'sent_at'=>date('Y-m-d H:i:s')
        ]);
    }
}