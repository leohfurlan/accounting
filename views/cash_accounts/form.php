<?php init_head(); ?>
<div class="content">
  <h4><?php echo isset($account) ? 'Editar' : 'Nova'; ?> Conta de Caixa/Banco</h4>
  <?php echo form_open(current_url()); ?>
    <div class="form-group">
      <label>Nome</label>
      <input type="text" name="name" class="form-control" value="<?php echo set_value('name', isset($account) ? $account->name : ''); ?>" required>
    </div>
    <div class="form-group">
      <label>Tipo</label>
      <select name="type" class="form-control">
        <?php foreach(['Caixa','Banco'] as $t): ?>
          <option value="<?php echo $t; ?>" <?php echo (isset($account) && $account->type === $t) ? 'selected' : ''; ?>><?php echo $t; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Saldo Inicial</label>
      <input type="number" step="0.01" name="initial_balance" class="form-control" value="<?php echo set_value('initial_balance', isset($account) ? $account->initial_balance : '0.00'); ?>" required>
    </div>
    <button type="submit" class="btn btn-success"><?php echo isset($account) ? 'Atualizar' : 'Salvar'; ?></button>
  <?php echo form_close(); ?>
</div>
<?php init_tail(); ?>