<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<h3>Extrato de Conta (<?= esc($start_date) ?> a <?= esc($end_date) ?>)</h3>

<form method="post" class="form-inline mb-3">
    <select name="account_id" class="form-control mr-2">
        <?php foreach($accounts_list as $acct): ?>
            <option value="<?= esc($acct->id) ?>" <?= $acct->id == $account_id ? 'selected' : '' ?>>
                <?= esc($acct->code . ' - ' . $acct->description) ?>
            </option>
        <?php endforeach ?>
    </select>
    <input type="date" name="start_date" value="<?= esc($start_date) ?>" class="form-control mr-2">
    <input type="date" name="end_date"   value="<?= esc($end_date) ?>"   class="form-control mr-2">
    <button class="btn btn-primary">Filtrar</button>
</form>

<table id="extrato_table" class="table table-striped">
    <thead>
        <tr>
            <th>Data</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Saldo</th>
        </tr>
    </thead>
    <tbody>
    <?php $saldo = 0; ?>
    <?php foreach($rows as $r): ?>
        <?php if($r->type === 'debit'): ?>
            <?php $saldo += $r->amount; ?>
        <?php else: ?>
            <?php $saldo -= $r->amount; ?>
        <?php endif ?>
        <tr>
            <td><?= esc($r->date) ?></td>
            <td><?= esc(ucfirst($r->type)) ?></td>
            <td><?= number_format($r->amount,2,',','.') ?></td>
            <td><?= number_format($saldo,2,',','.') ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<script>
$(document).ready(function(){
    $('#extrato_table').DataTable({
        dom: 'Bfrtip',
        buttons: ['pdfHtml5','csvHtml5']
    });
});
</script>
<?php init_tail(); ?>