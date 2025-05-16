<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {
    // Balanço Patrimonial: agrupa saldo de contas por tipo (Ativo, Passivo)
    public function get_balance_sheet($date_end) {
        $sql = "SELECT c.type,
                       SUM(IFNULL(l.debit,0) - IFNULL(l.credit,0)) AS balance
                  FROM acc_coa c
             LEFT JOIN acc_journal_lines l ON l.coa_id = c.id
             LEFT JOIN acc_journal_entries e ON e.id = l.journal_entry_id
                 AND e.date <= ?
              GROUP BY c.type";
        return $this->db->query($sql, [$date_end])->result();
    }

    // Demonstração de Resultado: receitas x despesas no período
    public function get_income_statement($date_start, $date_end) {
        $sql = "SELECT c.type,
                       SUM(IF(c.type='Receita', l.credit, l.debit) - IF(c.type='Receita', l.debit, l.credit)) AS total
                  FROM acc_coa c
             LEFT JOIN acc_journal_lines l ON l.coa_id = c.id
             LEFT JOIN acc_journal_entries e ON e.id = l.journal_entry_id
                 AND e.date BETWEEN ? AND ?
                 AND c.type IN('Receita','Despesa')
              GROUP BY c.type";
        return $this->db->query($sql, [$date_start, $date_end])->result();
    }

    // Fluxo de Caixa: entradas e saídas dia a dia
    public function get_cash_flow($date_start, $date_end) {
        $sql = "SELECT e.date AS dt,
                       SUM(l.debit) AS outflow,
                       SUM(l.credit) AS inflow
                  FROM acc_journal_lines l
             LEFT JOIN acc_journal_entries e ON e.id = l.journal_entry_id
                 AND e.date BETWEEN ? AND ?
              GROUP BY e.date
              ORDER BY e.date";
        return $this->db->query($sql, [$date_start, $date_end])->result();
    }
}
