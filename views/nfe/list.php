<?php init_head(); ?>
<div class="content">
  <h4>NF-e Emitidas</h4>
  <a href="<?php echo admin_url('accounting/nfe/create'); ?>" class="btn btn-primary mb-2">Nova NF-e</a>
  <table class="table dt-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Data</th>
        <th>Chave de Acesso</th>
        <th>Protocolo</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($nfes as $n): ?>
      <tr>
        <td><?php echo $n->id; ?></td>
        <td><?php echo get_company_name($n->customer_id); ?></td>
        <td><?php echo _dt($n->created_at); ?></td>
        <td><?php echo $n->chave; ?></td>
        <td><?php echo $n->protocolo; ?></td>
        <td><?php echo ucfirst($n->status); ?></td>
        <td>
          <?php if ($n->status === 'autorizado'): ?>
            <a href="<?php echo admin_url('accounting/nfe/danfe/'.$n->id); ?>" class="btn btn-default btn-sm">DANFE</a>
          <?php endif; ?>
          <a href="<?php echo admin_url('accounting/nfe/xml/'.$n->id); ?>" class="btn btn-default btn-sm" target="_blank">XML</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php init_tail(); ?>