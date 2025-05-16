<?php namespace App\Modules\Accounting\Models;

use CodeIgniter\Model;

class Report_model extends Model
{
    protected $DBGroup = 'default';

    public function get_fluxo_caixa($start_date, $end_date, array $account_ids)
    {
        $builder = $this->db->table('acc_journal_lines');
        $builder->select("date, 
            SUM(CASE WHEN type='debit' THEN amount ELSE 0 END) AS debito,
            SUM(CASE WHEN type='credit' THEN amount ELSE 0 END) AS credito");
        $builder->where('date >=', $start_date)
                ->where('date <=', $end_date);
        if (!empty($account_ids)) {
            $builder->whereIn('account_id', $account_ids);
        }
        $builder->groupBy('date')
                ->orderBy('date', 'ASC');
        return $builder->get()->getResult();
    }

    public function get_extrato_conta($account_id, $start_date, $end_date)
    {
        return $this->db
            ->table('acc_journal_lines')
            ->where('account_id', $account_id)
            ->where('date >=', $start_date)
            ->where('date <=', $end_date)
            ->orderBy('date','ASC')
            ->get()
            ->getResult();
    }

    public function get_balancete($start_date, $end_date, $level)
    {
        return $this->db
            ->table('acc_chart_of_accounts AS a')
            ->select("a.code, a.description,
                SUM(CASE WHEN l.type='debit' THEN l.amount ELSE 0 END) AS debito,
                SUM(CASE WHEN l.type='credit' THEN l.amount ELSE 0 END) AS credito")
            ->join('acc_journal_lines AS l','l.account_id=a.id')
            ->where('l.date >=', $start_date)
            ->where('l.date <=', $end_date)
            ->where('a.level <=', $level)
            ->groupBy('a.code, a.description')
            ->orderBy('a.code','ASC')
            ->get()
            ->getResult();
    }

    public function get_dre($start_date, $end_date)
    {
        // Aqui você pode adicionar lógica específica para agrupar contas de resultado
        return $this->db
            ->table('acc_chart_of_accounts AS a')
            ->select("a.category, 
                SUM(CASE WHEN l.type='debit' THEN l.amount ELSE 0 END) AS debito,
                SUM(CASE WHEN l.type='credit' THEN l.amount ELSE 0 END) AS credito")
            ->join('acc_journal_lines AS l','l.account_id=a.id')
            ->where('l.date >=', $start_date)
            ->where('l.date <=', $end_date)
            ->groupBy('a.category')
            ->orderBy('a.category','ASC')
            ->get()
            ->getResult();
    }

    public function get_balanco($date)
    {
        // Ativo e Passivo até a data-base
        return $this->db
            ->table('acc_chart_of_accounts AS a')
            ->select("a.category, 
                SUM(CASE WHEN l.type='debit' THEN l.amount ELSE 0 END) AS debito,
                SUM(CASE WHEN l.type='credit' THEN l.amount ELSE 0 END) AS credito")
            ->join('acc_journal_lines AS l','l.account_id=a.id')
            ->where('l.date <=', $date)
            ->groupBy('a.category')
            ->orderBy('a.category','ASC')
            ->get()
            ->getResult();
    }
}
