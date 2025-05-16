<?php init_head(); ?>
<div class="content">
  <h4>Dashboard de Saldos</h4>
  <div class="row">
    <?php foreach ($accounts as $a): ?>
      <div class="col-md-3 mb-3">
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title"><?php echo $a->name; ?></h5>
            <p class="card-text"><?php echo $a->type; ?></p>
            <h3><?php echo app_format_money($a->balance); ?></h3>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <hr>
  <h5>Evolução Mensal de Saldos</h5>
  <div style="height:400px">
    <canvas id="saldoChart"></canvas>
  </div>
</div>
<?php init_tail(); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  var ctx = document.getElementById('saldoChart').getContext('2d');
  var labels = <?php echo json_encode(array_column($accounts, 'name')); ?>;
  var data   = <?php echo json_encode(array_column($accounts, 'balance')); ?>;
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
        label: 'Saldo Atual',
        data: data
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false
    }
  });
});
</script>