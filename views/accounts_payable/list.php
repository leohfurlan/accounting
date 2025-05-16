<?php init_head(); ?>
<div class="content">
  <h4>Contas a Pagar</h4>
  <a href="<?php echo admin_url('accounting/accounts_payable/create'); ?>" class="btn btn-primary mb-2">Novo Título</a>
  <table class="table dt-table">
    <thead>
      <tr>
        <th>Fornecedor</th>
        <th>Número Documento</th>
        <th>Emissão</th>
        <th>Vencimento</th>
        <th>Valor</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($items as $item): ?>
      <tr class="<?php echo ($item->status == 'Vencido' ? 'table-danger' : ''); ?>">
        <td><?php echo $item->supplier; ?></td>
        <td><?php echo $item->document_number; ?></td>
        <td><?php echo _d($item->issue_date); ?></td>
        <td><?php echo _d($item->due_date); ?></td>
        <td><?php echo app_format_money($item->amount); ?></td>
        <td><?php echo $item->status; ?></td>
        <td>
          <a href="<?php echo admin_url('accounting/accounts_payable/edit/'.$item->id); ?>">Editar</a>
          <?php if($item->status == 'Pendente'): ?>
            | <a href="<?php echo admin_url('accounting/accounts_payable/pay/'.$item->id); ?>" class="text-success">Pagar</a>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php init_tail(); ?>
