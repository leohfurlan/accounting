<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>table{width:100%;border-collapse:collapse;}th,td{border:1px solid #333;padding:5px;text-align:left;}h4{text-align:center;}</style></head>
<body>
  <h4><?php echo strtoupper($report); ?> REPORT</h4>
  <table>
    <thead><tr>
      <?php foreach(array_keys((array)$data[0]) as $col): ?>
        <th><?php echo $col; ?></th>
      <?php endforeach; ?>
    </tr></thead>
    <tbody>
      <?php foreach($data as $row): ?>
        <tr>
          <?php foreach($row as $val): ?>
            <td><?php echo $val; ?></td>
          <?php endforeach; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
