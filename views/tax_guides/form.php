<?php init_head(); ?>
<div class="content">
  <h4><?php echo isset($guide) ? 'Editar' : 'Nova'; ?> Guia de Imposto</h4>
  <?php echo form_open(current_url()); ?>
    <div class="form-group">
      <label>Tipo</label>
      <select name="type" class="form-control" required>
        <?php foreach(['DARF','GPS','GNRE','DAS','DIRF'] as $t): ?>
          <option value="<?php echo $t; ?>"><?php echo $t; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Competência</label>
      <input type="month" name="competencia" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Empresa</label>
      <?php echo render_select('company_id',$companies,['userid','company'],'',set_value('company_id')); ?>
    </div>
    <div class="form-group">
      <label>Valor</label>
      <input type="number" step="0.01" name="tax_value" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success"><?php echo isset($guide) ? 'Atualizar' : 'Gerar'; ?></button>
  <?php echo form_close(); ?>
</div>
<?php init_tail(); ?>