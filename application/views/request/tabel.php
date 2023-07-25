<div class="table-responsive">
  <table
    class="table table-striped table-hover table-bordered"
    id="datatable"
    data-order='[[ 1, "desc" ]]'
  >
    <thead class="text-center">
      <tr>
        <th class="text-muted text-small text-uppercase"></th>
        <th class="text-muted text-small text-uppercase">Request Date</th>
        <th class="text-muted text-small text-uppercase">Staff</th>
        <th class="text-muted text-small text-uppercase">Program</th>
        <th class="text-muted text-small text-uppercase">Deskripsi</th>
        <th class="text-muted text-small text-uppercase">Objek/Form</th>
        <th class="text-muted text-small text-uppercase">Jenis</th>
        <th class="text-muted text-small text-uppercase">Plan Date</th>
        <th class="text-muted text-small text-uppercase">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $key): ?>
        <tr class="text-center">
          <td>
            <button
              class="btn btn-primary btn-sm dropdown-toggle active-scale-down"
              type="button"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
            Aksi
            </button>
            <div class="dropdown-menu">
              <a 
                class="dropdown-item edit" 
                href="javascript:;"
                data="<?=$key->ID?>"
                staff = "<?=$key->STAFF_ID?>"
                program = "<?=$key->PROGRAM_ID?>"
                deskripsi = "<?=$key->DESKRIPSI?>"
                objek = "<?=$key->OBJEK?>"
                inputRevisi = "<?=$key->REVISI?>"
                inputBaru = "<?=$key->NEW?>"
                inputUrgent = "<?=$key->URGENT?>"
                inputError = "<?=$key->ERROR?>">Edit</a>
              <a class="dropdown-item cancel" href="javascript:;" data="<?=$key->ID?>">Cancel</a>
            </div>
          </td>
          <td><?=date($key->REQUEST_DATE)?></td>
          <td><?=$key->NAMA?></td>
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
          <td>
            <?php if ($key->PLAN_DATE == null || $key->STATUS_JOB_ORDER == 'Reject'): ?>
              <button
                class="btn btn-primary btn-sm dropdown-toggle active-scale-down"
                type="button"
                data-bs-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
              Aksi
              </button>
              <div class="dropdown-menu">
                <a 
                  class="dropdown-item approve" 
                  href="javascript:;"
                  jenis="APPROVE"
                  pic = "<?=$key->PIC_INPUT?>"
                  data="<?=$key->ID?>">Approve</a>
                <a 
                  class="dropdown-item approve" 
                  href="javascript:;"
                  jenis="REJECT"
                  pic = "<?=$key->PIC_INPUT?>"
                  data="<?=$key->ID?>">Reject</a>
              </div>  
            <?php else: ?>
              
            <?php endif ?>
            <?=$key->PLAN_DATE == null ? '' : date("Y-m-d", strtotime($key->PLAN_DATE))?>
              
          </td>
          <td>
            <?php
              switch ($key->STATUS_JOB_ORDER) {
                case 'Open':
                  $warnaStatus = 'bg-success';
                  break;
                case 'Waiting Confirmation':
                  $warnaStatus = 'bg-success';
                  break;
                default:
                  $warnaStatus = 'bg-primary';
                  break;
              }
            ?>
            <span class="badge <?=$warnaStatus?>"><?=$key->STATUS_JOB_ORDER?></span>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  var jmlData = '<?=count($data)?>';
  if (jmlData>0 && jmlData<3) {
    var table = $('#datatable').DataTable( {
        paging:         false,
        'searching': false,
        'ordering':true,
        order: [[1, 'desc']]
        
    } );
  } else {
    var table = $('#datatable').DataTable( {
        scrollY:        "350px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        'searching': false,
        'ordering':true,
        order: [[1, 'desc']]
        
    } );
  }
</script>