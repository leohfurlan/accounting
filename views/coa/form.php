<?php init_head(); ?>
<div class="content">
  <h4><?php echo isset($coa) ? 'Editar' : 'Nova'; ?> Conta</h4>
  <?php echo form_open(current_url()); ?>
    <div class="form-group">
      <label>Código</label>
      <input type="text" name="code" class="form-control" value="<?php echo set_value('code', isset($coa) ? $coa->code : ''); ?>" required>
    </div>
    <div class="form-group">
      <label>Nome</label>
      <input type="text" name="name" class="form-control" value="<?php echo set_value('name', isset($coa) ? $coa->name : ''); ?>" required>
    </div>
    <div class="form-group">
      <label>Tipo</label>
      <select name="type" class="form-control">
        <?php foreach(['Ativo','Passivo','Receita','Despesa'] as $t): ?>
          <option value="<?php echo $t; ?>" <?php echo (isset($coa) && $coa->type === $t) ? 'selected' : ''; ?>><?php echo $t; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-success"><?php echo isset($coa) ? 'Atualizar' : 'Salvar'; ?></button>
  <?php echo form_close(); ?>
</div>
<?php init_tail(); ?>