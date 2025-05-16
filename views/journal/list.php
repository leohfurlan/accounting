<?php init_head(); ?>
<div class="content">
  <h4>Lançamentos Contábeis</h4>
  <a href="<?php echo admin_url('accounting/journal/create'); ?>" class="btn btn-primary">Novo Lançamento</a>
  <table class="table dt-table">
    <thead><tr><th>Data</th><th>Descrição</th><th>Total Débito</th><th>Total Crédito</th><th>Ações</th></tr></thead>
    <tbody>
      <?php foreach($entries as $e): ?>
      <tr>
        <td><?php echo _d($e->date); ?></td>
        <td><?php echo $e->description; ?></td>
        <?php $lines = $this->Journal_model->get_entry($e->id)->lines; $debit = array_sum(array_column($lines,'debit')); $credit = array_sum(array_column($lines,'credit')); ?>
        <td><?php echo app_format_money($debit); ?></td>
        <td><?php echo app_format_money($credit); ?></td>
        <td>
          <a href="<?php echo admin_url('accounting/journal/edit/'.$e->id); ?>">Editar</a> |
          <a href="<?php echo admin_url('accounting/journal/delete/'.$e->id); ?>" class="text-danger">Excluir</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php init_tail(); ?>