<?php init_head(); ?>
<div class="content">
  <h4>Contas de Caixa e Bancos</h4>
  <a href="<?php echo admin_url('accounting/cash_accounts/create'); ?>" class="btn btn-primary">Nova Conta</a>
  <table class="table dt-table">
    <thead><tr><th>Nome</th><th>Tipo</th><th>Saldo Inicial</th><th>Ações</th></tr></thead>
    <tbody>
      <?php foreach($accounts as $a): ?>
      <tr>
        <td><?php echo $a->name; ?></td>
        <td><?php echo $a->type; ?></td>
        <td><?php echo app_format_money($a->initial_balance); ?></td>
        <td>
          <a href="<?php echo admin_url('accounting/cash_accounts/edit/'.$a->id); ?>">Editar</a> |
          <a href="<?php echo admin_url('accounting/cash_accounts/delete/'.$a->id); ?>" class="text-danger">Excluir</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php init_tail(); ?>