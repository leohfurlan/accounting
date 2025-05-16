<?php init_head(); ?>
<div class="content">
  <h4>Plano de Contas</h4>
  <a href="<?php echo admin_url('accounting/coa/create'); ?>" class="btn btn-primary">Nova Conta</a>
  <table class="table dt-table">
    <thead><tr><th>Código</th><th>Nome</th><th>Tipo</th><th>Ações</th></tr></thead>
    <tbody>
      <?php foreach($coas as $c): ?>
      <tr>
        <td><?php echo $c->code; ?></td>
        <td><?php echo $c->name; ?></td>
        <td><?php echo $c->type; ?></td>
        <td>
          <a href="<?php echo admin_url('accounting/coa/edit/'.$c->id); ?>">Editar</a> |
          <a href="<?php echo admin_url('accounting/coa/delete/'.$c->id); ?>" class="text-danger">Excluir</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php init_tail(); ?>