<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<h3>Fluxo de Caixa (<?= esc($start_date) ?> a <?= esc($end_date) ?>)</h3>

<form method="post" class="form-inline mb-3">
    <input type="date" name="start_date" value="<?= esc($start_date) ?>" class="form-control mr-2">
    <input type="date" name="end_date"   value="<?= esc($end_date) ?>"   class="form-control mr-2">
    <button class="btn btn-primary">Filtrar</button>
</form>

<table id="fluxo_table" class="table table-striped">
    <thead>
        <tr><th>Data</th><th>Débito</th><th>Crédito</th></tr>
    </thead>
    <tbody>
    <?php foreach($rows as $r): ?>
        <tr>
            <td><?= esc($r->date) ?></td>
            <td><?= number_format($r->debito,2,',','.') ?></td>
            <td><?= number_format($r->credito,2,',','.') ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<script>
$(document).ready(function(){
    $('#fluxo_table').DataTable({
        dom: 'Bfrtip',
        buttons: ['pdfHtml5','excelHtml5']
    });
});
</script>

<?php init_tail(); ?>
