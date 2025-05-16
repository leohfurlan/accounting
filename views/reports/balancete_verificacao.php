<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<h3>Balancete de Verificação (Nível <?= esc($level) ?>)</h3>

<form method="post" class="form-inline mb-3">
    <input type="date" name="start_date" value="<?= esc($this->request->getPost('start_date') ?? date('Y-01-01')) ?>" class="form-control mr-2">
    <input type="date" name="end_date"   value="<?= esc($this->request->getPost('end_date') ?? date('Y-m-d')) ?>"   class="form-control mr-2">
    <select name="level" class="form-control mr-2">
        <?php for($i=1; $i<=4; $i++): ?>
            <option value="<?= $i ?>" <?= $i == $level ? 'selected' : '' ?>>Nível <?= $i ?></option>
        <?php endfor ?>
    </select>
    <button class="btn btn-primary">Filtrar</button>
</form>

<table id="balancete_table" class="table table-striped">
    <thead>
        <tr>
            <th>Conta</th>
            <th>Descrição</th>
            <th>Débito</th>
            <th>Crédito</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($rows as $r): ?>
        <tr>
            <td><?= esc($r->code) ?></td>
            <td><?= esc($r->description) ?></td>
            <td><?= number_format($r->debito,2,',','.') ?></td>
            <td><?= number_format($r->credito,2,',','.') ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<script>
$(document).ready(function(){
    $('#balancete_table').DataTable({
        dom: 'Bfrtip',
        buttons: ['pdfHtml5','excelHtml5']
    });
});
</script>

<?php init_tail(); ?>