<?php init_head(); ?>
<div class="content">
  <h4>Emitir NF-e</h4>
  <?php echo form_open(current_url()); ?>
    <div class="form-group">
      <label>Cliente</label>
      <?php echo render_select('customer_id',$customers,['userid','company'],'',set_value('customer_id')); ?>
    </div>
    <h5>Itens</h5>
    <table class="table" id="nfe-items">
      <thead><tr><th>Produto</th><th>Qtd</th><th>Valor Unit.</th><th>Ações</th></tr></thead>
      <tbody></tbody>
    </table>
    <button type="button" id="add-item" class="btn btn-secondary">Adicionar Item</button>
    <hr>
    <button type="submit" class="btn btn-success">Gerar e Enviar</button>
  <?php echo form_close(); ?>
</div>
<?php init_tail(); ?>
