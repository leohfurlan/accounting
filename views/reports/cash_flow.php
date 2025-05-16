<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="content">
  <h4>Fluxo de Caixa de <?php echo $date_start; ?> a <?php echo $date_end; ?></h4>
  <table class="table">
    <thead><tr><th>Data</th><th>Entradas</th><th>Saídas</th></tr></thead>
    <tbody>
      <?php foreach($flows as $f): ?>
        <tr><td><?php echo $f->dt; ?></td><td><?php echo app_format_money($f->inflow); ?></td><td><?php echo app_format_money($f->outflow); ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="<?php echo admin_url('accounting/reports/export/excel?report=cf&date_start='.$date_start.'&date_end='.$date_end); ?>" class="btn btn-secondary">Exportar Excel</a>
  <a href="<?php echo admin_url('accounting/reports/export/pdf?report=cf&date_start='.$date_start.'&date_end='.$date_end); ?>" class="btn btn-secondary">Exportar PDF</a>
</div>
<?php init_tail(); ?>