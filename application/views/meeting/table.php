<table
  class="data-table data-table-pagination data-table-standard responsive nowrap table-hover"
  id="datatableStripe"
  data-order='[[ 0, "desc" ]]'
>
  <thead class="text-center">
    <tr>
      <th class="text-muted text-small text-uppercase">Doc No</th>
      <th class="text-muted text-small text-uppercase">Meeting Date</th>
      <th class="text-muted text-small text-uppercase">Meeting Name</th>
      <th class="text-muted text-small text-uppercase">Category</th>
      <th class="text-muted text-small text-uppercase">PIC</th>
      <th class="text-muted text-small text-uppercase">Room</th>
      <th class="text-muted text-small text-uppercase">Status</th>
      <th class="text-muted text-small text-uppercase">Progress</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key): ?>
      <tr class="text-center">
        <td><?=$key->MEETING_NO?></td>
        <td><?=date("Y-m-d", strtotime($key->MEETING_DATE))?></td>
        <td><?=$key->MEETING_NAME?></td>
        <td><?=$key->CATEGORY?></td>
        <td><?=$key->MEETING_PIC?></td>
        <td><?=$key->ROOM?></td>
        <td>
          <?php
            switch ($key->STATUS) {
              case 'DRAFT':
                $color = 'bg-warning';
                break;
              case 'OPEN':
                $color = 'bg-success';
                break;
              default:
                $color = 'bg-primary';
                break;
            }
          ?>
          <span class="badge rounded-pill <?=$color?>"><?=$key->STATUS?></span>
        </td>
        <td>
          <?php
            $jmlTask = $key->JML == null ? 0 : $key->JML;
            $jmlClose = $key->JML_CLOSE == null ? 0 : $key->JML_CLOSE;
            $total = $jmlTask == 0 ? 0 : ($jmlClose/$jmlTask)*100;
          ?>
          <div class="progress sh-2">
            <div class="progress-bar" role="progressbar" aria-valuenow="<?=round($total, 2)?>" aria-valuemin="0" aria-valuemax="100"><?=round($total, 2)?>%</div>
          </div>
        </td>
        <td>
          <?php if ($key->STATUS == 'DRAFT'): ?>
            <a href="<?=base_url()?>meeting/edit/<?=$key->ID?>" class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1 editData">
              <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
              <span class="d-none d-xxl-inline-block">Edit</span>
            </a>
          <?php endif ?>
          <a href="<?=base_url()?>meeting/view/<?=$key->ID?>" class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1 editData">
            <i data-acorn-icon="eye" data-acorn-size="15"></i>
            <span class="d-none d-xxl-inline-block">View</span>
          </a>
          <!-- <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
            <i data-acorn-icon="bin" data-acorn-size="15"></i>
            <span class="d-none d-xxl-inline-block">Delete</span>
          </button> -->
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>