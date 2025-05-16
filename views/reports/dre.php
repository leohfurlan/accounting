<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<h3>Demonstração de Resultado do Exercício (DRE)</h3>

<form method="post" class="form-inline mb-3">
    <input type="date" name="start_date" value="<?= esc($this->request->getPost('start_date') ?? date('Y-01-01')) ?>" class="form-control mr-2">
    <input type="date" name="end_date"   value="<?= esc($this->request->getPost('end_date') ?? date('Y-m-d')) ?>"   class="form-control mr-2">
    <button class="btn btn-primary">Filtrar</button>
</form>

<table id="dre_table" class="table table-striped">
    <thead>
        <tr>
            <th>Categoria</th>
            <th>Débito</th>
            <th>Crédito</th>
            <th>Resultado</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($rows as $r): ?>
        <?php $resultado = $r->credito - $r->debito; ?>
        <tr>
            <td><?= esc($r->category) ?></td>
            <td><?= number_format($r->debito,2,',','.') ?></td>
            <td><?= number_format($r->credito,2,',','.') ?></td>
            <td><?= number_format($resultado,2,',','.') ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<script>
$(document).ready(function(){
    $('#dre_table').DataTable({
        dom: 'Bfrtip',
        buttons: ['pdfHtml5','excelHtml5']
    });
});
</script>

<?php init_tail(); ?>