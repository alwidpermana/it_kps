<div class="table-responsive">
  <table
    class="table table-striped table-hover table-bordered"
    id="datatable"
    data-order='[[ 5, "desc" ]]'
  >
    <thead>
      <tr class="text-center">
        <th class="text-muted text-small text-uppercase" rowspan="3">Progress</th>
        <th class="text-muted text-small text-uppercase" rowspan="3">Staff</th>
        <th class="text-muted text-small text-uppercase" rowspan="3">Program</th>
        <th class="text-muted text-small text-uppercase" rowspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deskripsi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th class="text-muted text-small text-uppercase" rowspan="3">Objek/Form</th>
        <th class="text-muted text-small text-uppercase" rowspan="3">Jenis</th>
        <th class="text-muted text-small text-uppercase" rowspan="3">Request Date</th>
        <th class="text-muted text-small text-uppercase" rowspan="3">Request PIC</th>
        <th class="text-muted text-small text-uppercase" rowspan="3">Source</th>
        <th class="text-muted text-small text-uppercase" colspan="6">Task Date</th>
        <th class="text-muted text-small text-uppercase" colspan="4">Approval</th>
        <th class="text-muted text-small text-uppercase" rowspan="3">Status</th>
        
      </tr>
      <tr class="text-center">
        <th class="text-muted text-small text-uppercase" rowspan="2">Plan Date</th>
        <th class="text-muted text-small text-uppercase" rowspan="2">Actual Date</th>
        <th class="text-muted text-small text-uppercase" rowspan="2">GAP</th>
        <th class="text-muted text-small text-uppercase" colspan="3">Development Date</th>
        <th class="text-muted text-small text-uppercase" rowspan="2">PIC</th>
        <th class="text-muted text-small text-uppercase" rowspan="2">Status</th>
        <th class="text-muted text-small text-uppercase" rowspan="2">Date</th>
        <th class="text-muted text-small text-uppercase" rowspan="2">GAP</th>
      </tr>
      <tr class="text-center">
        <th class="text-muted text-small text-uppercase">Start</th>
        <th class="text-muted text-small text-uppercase">End</th>
        <th class="text-muted text-small text-uppercase">GAP</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $key): ?>
        <tr>
          <td class="text-center">
            <a href="javascript:;" class="btn btn-sm btn-primary mb-1 active-scale-down btnProgress" data="<?=$key->ID?>">
              <i data-acorn-icon="chart-4" class="light" data-acorn-size="18"></i>
            </a>
          </td>
          <td><?=str_replace(' ', '&nbsp;', $key->NAMA)?></td>
          <td><?=$key->NAME_PROGRAM?></td>
          <td><?=$key->DESKRIPSI?></td>
          <td><?=$key->OBJEK?></td>
          <td>
            <?php if ($key->REVISI == 'Y'): ?>
              <span class="badge bg-warning">Revisi</span>
            <?php endif ?>
            <?php if ($key->NEW == 'Y'): ?>
              <span class="badge bg-primary">New</span>
            <?php endif ?>
            <?php if ($key->URGENT == 'Y'): ?>
              <span class="badge bg-danger">Urgent</span>
            <?php endif ?>
            <?php if ($key->ERROR == 'Y'): ?>
              <span class="badge bg-danger">Error</span>
            <?php endif ?>
          </td>
          <td><?=$key->REQUEST_DATE == null ? '' : date("Y-m-d", strtotime($key->REQUEST_DATE))?></td>
          <td><?=$key->REQUEST_PIC?></td>
          <td><?=$key->SOURCE?></td>
          <td><?=$key->PLAN_DATE == null ? '' : date("Y-m-d", strtotime($key->PLAN_DATE))?></td>
          <td><?=$key->ACTUAL_DATE == null ? '' : date("Y-m-d", strtotime($key->ACTUAL_DATE))?></td>
          <td></td>
          <td><?=$key->START_PROGRESS == null ? '' : date("Y-m-d", strtotime($key->START_PROGRESS))?></td>
          <td><?=$key->END_PROGRESS == null ? '' : date("Y-m-d", strtotime($key->END_PROGRESS))?></td>
          <td></td>
          <td><?=$key->APPROVE_PIC?></td>
          <td><?=$key->APPROVE_STATUS?></td>
          <td><?=$key->APPROVE_DATE == null ? '' : date("Y-m-d", strtotime($key->APPROVE_DATE))?></td>
          <td></td>
          <td><?=$key->STATUS_JOB_ORDER?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  var table = $('#datatable').DataTable( {
        scrollY:        "350px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        'searching': false,
        'ordering':true,
        order: [[6, 'asc']]
        
    } );
</script>