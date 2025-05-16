<?php init_head(); ?>
<div class="content">
  <h4>Guias de Impostos Pendentes</h4>
  <a href="<?php echo admin_url('accounting/tax_guides/create'); ?>" class="btn btn-primary mb-2">Nova Guia</a>
  <button onclick="location.href='<?php echo admin_url('accounting/tax_guides/send_batch'); ?>'" class="btn btn-success mb-2">Enviar Todos</button>
  <table class="table dt-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Competência</th>
        <th>Empresa</th>
        <th>Valor</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($guides as $g): ?>
      <tr>
        <td><?php echo $g->id; ?></td>
        <td><?php echo $g->type; ?></td>
        <td><?php echo _d($g->competencia); ?></td>
        <td><?php echo get_company_name($g->company_id); ?></td>
        <td><?php echo app_format_money($g->tax_value); ?></td>
        <td><?php echo ucfirst($g->status); ?></td>
        <td>
          <a href="<?php echo site_url('accounting/tax_guides/create'); ?>" class="btn btn-sm btn-primary">Editar</a>
          <?php if($g->status=='pendente'): ?>
            <button onclick="location.href='<?php echo admin_url('accounting/tax_guides/send_batch'); ?>'" class="btn btn-sm btn-success">Enviar</button>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php init_tail(); ?>
