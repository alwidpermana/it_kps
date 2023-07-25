<table class="table">
  <thead>
    <tr>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">Status</th>
      <th scope="col">Review Date</th>
      <th scope="col">Review PIC</th>
      <th scope="col">Review Status</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">Status Progress</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key): ?>
      <tr>
        <td><?=$key->START_DATE==null?'':date("Y-m-d", strtotime($key->START_DATE))?></td>
        <td><?=$key->END_DATE==null?'':date("Y-m-d", strtotime($key->END_DATE))?></td>
        <td><?=$key->STATUS?></td>
        <td><?=$key->REVIEW_DATE==null?'':date("Y-m-d", strtotime($key->REVIEW_DATE))?></td>
        <td><?=$key->REVIEW_PIC?></td>
        <td><?=$key->REVIEW_STATUS?></td>
        <td><?=$key->DESKRIPSI?></td>
        <td><?=$key->STATUS_DATA?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>