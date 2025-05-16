<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div class="content">
  <h4>Demonstração de Resultado de <?php echo $date_start; ?> a <?php echo $date_end; ?></h4>
  <table class="table">
    <thead><tr><th>Tipo</th><th>Total</th></tr></thead>
    <tbody>
      <?php foreach($results as $r): ?>
        <tr><td><?php echo $r->type; ?></td><td><?php echo app_format_money($r->total); ?></td></tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <a href="<?php echo admin_url('accounting/reports/export/excel?report=dre&date_start='.$date_start.'&date_end='.$date_end); ?>" class="btn btn-secondary">Exportar Excel</a>
  <a href="<?php echo admin_url('accounting/reports/export/pdf?report=dre&date_start='.$date_start.'&date_end='.$date_end); ?>" class="btn btn-secondary">Exportar PDF</a>
</div>
<?php init_tail(); ?>