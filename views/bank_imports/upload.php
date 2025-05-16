<?php init_head(); ?>
<div class='content'>
  <h4>Importar Extrato Bancário</h4>
  <?php echo form_open_multipart(admin_url('accounting/bank_imports/upload')); ?>
    <div class='form-group'>
      <label>Selecione o arquivo OFX ou CSV</label>
      <input type='file' name='file' class='form-control' accept='.ofx,.csv' required>
    </div>
    <button type='submit' class='btn btn-primary'>Upload</button>
  <?php echo form_close(); ?>
</div>
<?php init_tail(); ?>