<?php init_head(); ?>
<div class="content">
  <h4><?php echo isset($entry) ? 'Editar' : 'Novo'; ?> Lançamento</h4>
  <?php echo form_open(current_url()); ?>
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label>Data</label>
          <input type="date" name="date" class="form-control" value="<?php echo set_value('date', isset($entry) ? to_sql_date($entry->date) : date('Y-m-d')); ?>" required>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
          <label>Cliente</label>
          <?php echo render_select('client_id', $clients, ['userid','company'], 'select_customer', isset($entry) ? $entry->client_id : ''); ?>
        </div>
      </div>
      <div class="col-md-5">
        <div class="form-group">
          <label>Projeto</label>
          <?php echo render_select('project_id', $projects, ['id','name'], 'select_project', isset($entry) ? $entry->project_id : ''); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Descrição</label>
          <input type="text" name="description" class="form-control" value="<?php echo set_value('description', isset($entry) ? $entry->description : ''); ?>" required>
        </div>
      </div>
    </div>
    <hr>
    <h5>Linhas de Lançamento</h5>
    <table class="table" id="journal-lines">
      <thead>
        <tr>
          <th>Conta</th>
          <th>Débito</th>
          <th>Crédito</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if(isset($entry) && !empty($entry->lines)): ?>
          <?php foreach($entry->lines as $line): ?>
            <tr>
              <td><?php echo render_select('lines[][coa_id]', $accounts, ['id','code','name'], '', $line->coa_id, ['data-none-selected-text'=>'Selecione conta']); ?></td>
              <td><input type="number" step="0.01" name="lines[][debit]" class="form-control" value="<?php echo $line->debit; ?>" required></td>
              <td><input type="number" step="0.01" name="lines[][credit]" class="form-control" value="<?php echo $line->credit; ?>" required></td>
              <td><button type="button" class="btn btn-danger remove-line">Remover</button></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        <!-- Template row -->
        <tr id="line-template" style="display:none;">
          <td><?php echo render_select('lines[][coa_id]', $accounts, ['id','code','name'], '', '', ['data-none-selected-text'=>'Selecione conta']); ?></td>
          <td><input type="number" step="0.01" name="lines[][debit]" class="form-control" value="0.00" required></td>
          <td><input type="number" step="0.01" name="lines[][credit]" class="form-control" value="0.00" required></td>
          <td><button type="button" class="btn btn-danger remove-line">Remover</button></td>
        </tr>
      </tbody>
    </table>
    <button type="button" id="add-line" class="btn btn-secondary">Adicionar Linha</button>
    <hr>
    <button type="submit" class="btn btn-success"><?php echo isset($entry) ? 'Atualizar' : 'Salvar'; ?></button>
  <?php echo form_close(); ?>
</div>
<?php init_tail(); ?>
<script>
$(document).ready(function(){
  $('#add-line').on('click', function(){
    var newRow = $('#line-template').clone().removeAttr('id').show();
    $('#journal-lines tbody').append(newRow);
  });
  $('#journal-lines').on('click', '.remove-line', function(){
    $(this).closest('tr').remove();
  });
});
</script>
