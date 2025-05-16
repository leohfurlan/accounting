<?php init_head(); ?>
<div class="content">
  <h4>Detalhes da NF-e #<?php echo $nfe->id; ?></h4>
  <p><strong>Cliente:</strong> <?php echo get_company_name($nfe->customer_id); ?></p>
  <p><strong>Data de Emissão:</strong> <?php echo _dt($nfe->created_at); ?></p>
  <p><strong>Chave:</strong> <?php echo $nfe->chave; ?></p>
  <p><strong>Protocolo:</strong> <?php echo $nfe->protocolo; ?></p>
  <p><strong>Status:</strong> <?php echo ucfirst($nfe->status); ?></p>
  <hr>
  <h5>XML Assinado</h5>
  <textarea class="form-control" rows="10" readonly><?php echo htmlspecialchars($nfe->xml); ?></textarea>
  <hr>
  <?php if ($nfe->status === 'autorizado'): ?>
    <a href="<?php echo admin_url('accounting/nfe/danfe/'.$nfe->id); ?>" class="btn btn-success">Gerar DANFE</a>
  <?php endif; ?>
</div>
<?php init_tail(); ?>