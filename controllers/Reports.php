<?php namespace App\Modules\Accounting\Controllers;

use App\Controllers\BaseController;
use App\Modules\Accounting\Models\Report_model;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Reports extends BaseController
{
    protected $reportModel;
    public function __construct()
    {
        $this->reportModel = new Report_model();
    }

    public function fluxo_caixa()
    {
        $start = $this->request->getPost('start_date') ?? date('Y-m-01');
        $end   = $this->request->getPost('end_date')   ?? date('Y-m-t');
        $accounts = $this->request->getPost('account_ids') ?? [];

        $data['rows'] = $this->reportModel->get_fluxo_caixa($start, $end, $accounts);
        $data['start_date'] = $start;
        $data['end_date']   = $end;
        echo view('App\Modules\Accounting\Views\reports/fluxo_caixa', $data);
    }

    public function extrato_conta()
    {
        $start = $this->request->getPost('start_date') ?? date('Y-m-01');
        $end   = $this->request->getPost('end_date')   ?? date('Y-m-t');
        $account = $this->request->getPost('account_id');

        $data['rows'] = $this->reportModel->get_extrato_conta($account, $start, $end);
        $data['account_id']   = $account;
        $data['start_date'] = $start;
        $data['end_date']   = $end;
        echo view('App\Modules\Accounting\Views\reports/extrato_conta', $data);
    }

    public function balancete_verificacao()
    {
        $start = $this->request->getPost('start_date') ?? date('Y-01-01');
        $end   = $this->request->getPost('end_date')   ?? date('Y-m-d');
        $level = $this->request->getPost('level')      ?? 1;

        $data['rows'] = $this->reportModel->get_balancete($start, $end, $level);
        $data['level'] = $level;
        echo view('App\Modules\Accounting\Views\reports/balancete_verificacao', $data);
    }

    public function dre()
    {
        $start = $this->request->getPost('start_date') ?? date('Y-01-01');
        $end   = $this->request->getPost('end_date')   ?? date('Y-m-d');

        $data['rows'] = $this->reportModel->get_dre($start, $end);
        echo view('App\Modules\Accounting\Views\reports/dre', $data);
    }

    public function balanco_patrimonial()
    {
        $date = $this->request->getPost('date') ?? date('Y-m-t');
        $data['rows'] = $this->reportModel->get_balanco($date);
        $data['date'] = $date;
        echo view('App\Modules\Accounting\Views\reports/balanco_patrimonial', $data);
    }
}

class Reports extends Admin_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('accounting/Reports_model');
        // Load PhpSpreadsheet
        require_once FCPATH . 'vendor/autoload.php';
    }

    public function balance_sheet() {
        $date_end = $this->input->get('date_end') ?: date('Y-m-d');
        $data['balances'] = $this->Reports_model->get_balance_sheet($date_end);
        $data['date_end'] = $date_end;
        $this->load->view('nfe',[],false);
        $this->load->view('accounting/reports/balance_sheet', $data);
    }

    public function income_statement() {
        $date_start = $this->input->get('date_start') ?: date('Y-01-01');
        $date_end   = $this->input->get('date_end')   ?: date('Y-m-d');
        $data['results'] = $this->Reports_model->get_income_statement($date_start, $date_end);
        $data['date_start'] = $date_start;
        $data['date_end']   = $date_end;
        $this->load->view('accounting/reports/income_statement', $data);
    }

    public function cash_flow() {
        $date_start = $this->input->get('date_start') ?: date('Y-m-01');
        $date_end   = $this->input->get('date_end')   ?: date('Y-m-d');
        $data['flows'] = $this->Reports_model->get_cash_flow($date_start, $date_end);
        $data['date_start'] = $date_start;
        $data['date_end']   = $date_end;
        $this->load->view('accounting/reports/cash_flow', $data);
    }

    public function export($type) {
        // type: 'pdf' or 'excel'
        $report = $this->input->get('report');
        $start  = $this->input->get('date_start');
        $end    = $this->input->get('date_end');

        if ($report === 'bp') {
            $data = $this->Reports_model->get_balance_sheet($end);
        } elseif ($report === 'dre') {
            $data = $this->Reports_model->get_income_statement($start, $end);
        } elseif ($report === 'cf') {
            $data = $this->Reports_model->get_cash_flow($start, $end);
        }

        if ($type === 'excel') {
            $this->export_excel($report, $data);
        } else {
            $this->export_pdf($report, $data);
        }
    }

    private function export_excel($report, $data) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Cabeçalhos
        $sheet->fromArray(array_keys((array)$data[0]), NULL, 'A1');
        // Dados
        $sheet->fromArray(array_map('array_values', array_map('get_object_vars', $data)), NULL, 'A2');

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $report .'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    private function export_pdf($report, $data) {
        $html = $this->load->view('accounting/reports/template_pdf', ['data'=>$data,'report'=>$report], TRUE);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($report.'.pdf', ['Attachment'=>0]);
    }
}
