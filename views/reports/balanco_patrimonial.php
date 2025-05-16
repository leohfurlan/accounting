<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<h3>Balanço Patrimonial (<?= esc($date) ?>)</h3>

<form method="post" class="form-inline mb-3">
    <input type="date" name="date" value="<?= esc($date) ?>" class="form-control mr-2">
    <button class="btn btn-primary">Filtrar</button>
</form>

<table id="balanco_table" class="table table-striped">
    <thead>
        <tr>
            <th>Categoria</th>
            <th>Débito</th>
            <th>Crédito</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($rows as $r): ?>
        <tr>
            <td><?= esc($r->category) ?></td>
            <td><?= number_format($r->debito,2,',','.') ?></td>
            <td><?= number_format($r->credito,2,',','.') ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<script>
$(document).ready(function(){
    $('#balanco_table').DataTable({
        dom: 'Bfrtip',
        buttons: ['pdfHtml5','excelHtml5']
    });
});
</script>
<?php init_tail(); ?>