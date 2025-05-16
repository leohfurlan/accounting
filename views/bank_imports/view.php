<?php init_head(); ?>
<div class='content'>
  <h4>Conciliação do Extrato #<?php echo $import_id; ?></h4>
  <table class='table'>
    <thead>
      <tr><th>Data</th><th>Descrição</th><th>Valor</th><th>Conciliado</th><th>Ações</th></tr>
    </thead>
    <tbody>
      <?php foreach($lines as $line): ?>
      <tr class="<?php echo $line->matched ? 'table-success' : ''; ?>">
        <td><?php echo _d($line->line_date); ?></td>
        <td><?php echo $line->description; ?></td>
        <td><?php echo app_format_money($line->amount); ?></td>
        <td><?php echo $line->matched ? 'Sim' : 'Não'; ?></td>
        <td>
          <?php if(!$line->matched): ?>
            <form method='post' action="<?php echo admin_url('accounting/bank_imports/match/'.$line->id); ?>">
              <?php echo render_select('journal_line_id',$journal_lines,['id','coa_code','coa_name'],'Conta',null); ?>
              <button type='submit' class='btn btn-sm btn-success'>Conciliar</button>
            </form>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php init_tail(); ?>
