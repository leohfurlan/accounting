<?php init_head(); ?>
<div class='content'>
  <h4>Extratos Importados</h4>
  <a href="<?php echo admin_url('accounting/bank_imports/upload'); ?>" class='btn btn-primary'>Novo Upload</a>
  <table class='table dt-table'>
    <thead>
      <tr><th>ID</th><th>Arquivo</th><th>Formato</th><th>Data</th><th>Ações</th></tr>
    </thead>
    <tbody>
      <?php foreach($imports as $imp): ?>
      <tr>
        <td><?php echo $imp->id; ?></td>
        <td><?php echo $imp->filename; ?></td>
        <td><?php echo $imp->format; ?></td>
        <td><?php echo _dt($imp->imported_at); ?></td>
        <td><a href="<?php echo admin_url('accounting/bank_imports/view/'.$imp->id); ?>">Ver Linhas</a></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php init_tail(); ?>
