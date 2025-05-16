<?php init_head(); ?>
<div class="content">
  <h4><?php echo isset($item) ? 'Editar' : 'Novo'; ?> Título a Pagar</h4>
  <?php echo form_open(current_url()); ?>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label>Fornecedor</label>
          <input type="text" name="supplier" class="form-control" value="<?php echo set_value('supplier', isset($item) ? $item->supplier : ''); ?>" required>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label>Número do Documento</label>
          <input type="text" name="document_number" class="form-control" value="<?php echo set_value('document_number', isset($item) ? $item->document_number : ''); ?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label>Data de Emissão</label>
          <input type="date" name="issue_date" class="form-control" value="<?php echo set_value('issue_date', isset($item) ? to_sql_date($item->issue_date) : date('Y-m-d')); ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Data de Vencimento</label>
          <input type="date" name="due_date" class="form-control" value="<?php echo set_value('due_date', isset($item) ? to_sql_date($item->due_date) : date('Y-m-d')); ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Valor (R$)</label>
          <input type="number" step="0.01" name="amount" class="form-control" value="<?php echo set_value('amount', isset($item) ? $item->amount : '0.00'); ?>" required>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-success"><?php echo isset($item) ? 'Atualizar' : 'Salvar'; ?></button>
  <?php echo form_close(); ?>
</div>
<?php init_tail(); ?>
