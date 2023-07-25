<?php if (count($data) == 0): ?>
  <div class="text-center">
    <i class="cs-warning-hexagon text-primary"></i>
    <p class="mb-0">No tasks found!</p>
  </div>
<?php else: ?>
  <?php foreach ($data as $key): ?>
  <div class="card h-100 mb-3">
    <div class="card-body position-relative">
      <?php if ($tipe == 'job order' | $tipe == 'on progress' || $tipe == 'review'): ?>
        <button
          type="button"
          class="btn btn-foreground hover-outline btn-icon btn-icon-only btn-sm position-absolute e-0 t-0 me-card mt-card z-index-1"
          data-bs-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <i data-acorn-icon="more-horizontal" data-acorn-size="15"></i>
        </button>  
      <?php endif ?>
      <div class="dropdown-menu dropdown-menu-end task-buttons">
        <?php
          switch ($tipe) {
            case 'job order':
              $next = 'On Progress';
              $text = 'On Progress';
              $before = '';
              break;
            case 'on progress':
              $next = 'Review';
              $text = 'Done';
              $before = 'Job Order';
              break;
            case 'review':
              $next = 'Done';
              $text = '';
              $before = 'On Progress';
              break;
            default:
              $next = '';
              $text = '';
              $before='';
              break;
          }
        ?>
        <?php if ($before != ''): ?>
          <a class="dropdown-item btnNext" href="javascript:;" jenis="cancel" next="<?=$before?>" now="<?=$tipe?>" data="<?=$key->ID?>">Cancel</a>
        <?php endif ?>
        <?php if ($tipe == 'review'): ?>
          <a class="dropdown-item approve" jenis="revisi" href="javascript:;" data="<?=$key->ID?>" progressId="<?=$key->PROGRESS_ID?>">Revisi</a>
          <a class="dropdown-item approve" jenis='approve' href="javascript:;" data="<?=$key->ID?>" progressId="<?=$key->PROGRESS_ID?>">Approve</a>
        <?php else: ?>
          <?php if ($text != ''): ?>
            <a class="dropdown-item btnNext" href="javascript:;" jenis="next" data="<?=$key->ID?>" next="<?=$next?>" now="<?=$tipe?>" status="<?=$key->STATUS?>"><?=$text?></a>  
          <?php endif ?>
        <?php endif ?>
      </div>
      <div class="h-100">
        <label class="form-check custom-icon mb-0 checked-line-through checked-opacity-75 h-100">
          <span class="form-check-label h-100 text-decoration-none">
            <span class="content h-100 text-decoration-none d-flex flex-column justify-content-between">
              <span class="mb-1 h5 pe-7 lh-1-5 title"><?=$key->OBJEK?></span>
              <p class="mb-3" style="font-size: 11px;"><?=$key->NAME_PROGRAM?> (<span class="text-primary"><?=$key->SOURCE?></span>) - <?=date("Y/m/d", strtotime($key->REQUEST_DATE))?></p>
              <span class="text-alternate mb-4 flex-grow-1 detail">
                <?=$key->DESKRIPSI?>
              </span>
              <div class="tags">
                <?php if ($key->REVISI == 'Y'): ?>
                  <span class="badge bg-outline-warning">Revisi</span>
                <?php endif ?>
                <?php if ($key->NEW == 'Y'): ?>
                  <span class="badge bg-outline-primary">New</span>
                <?php endif ?>
                <?php if ($key->URGENT == 'Y'): ?>
                  <span class="badge bg-outline-danger">Urgent</span>
                <?php endif ?>
                <?php if ($key->ERROR == 'Y'): ?>
                  <span class="badge bg-outline-danger">Error</span>
                <?php endif ?>
              </div>
            </span>
          </span>
          <hr>
          <p class="mt-3" style="font-size: 11px;">
            Plan Date: <strong><?=date("Y/m/d", strtotime($key->PLAN_DATE))?></strong>
            <br>
            Request PIC: <strong><?=$key->REQUEST_PIC?></strong>
            <?php if ($tipe == 'review' && $key->REVIEW_STATUS == 'REVISI'): ?>
              <br>
            Review Date: <strong><?=date("Y-m-d", strtotime($key->REVIEW_DATE))?></strong>
            <br>
            <span class="badge bg-danger">REVISI JOB</span>
            <?php endif ?>
          </p>
          <br>
          <div class="d-flex align-items-center me-3">
            <div class="sw-6 sh-6 d-inline-block position-relative me-2">
              <img src="<?=base_url().''.$key->FOTO?>" class="img-fluid rounded-xl border border-2 border-foreground sw-5 sh-5" alt="thumb" />
            </div>
            <div class="d-inline-block">
              <div class="text-primary"><?=$key->NAMA?></div>
            </div>
          </div>
          <?php
            if ($tipe == 'review') {
              $capture = $this->M_Task->getRevisiCapture($key->PROGRESS_ID);
              if ($capture->num_rows()>0) {
                foreach ($capture->result() as $cp) {
                  echo '<div class="d-flex align-items-center me-3">
                          <div class="sw-10 sh-8 me-2 mb-2">
                            <div class="row g-0 rounded-sm sh-8 border">
                              <div class="col-auto">
                                <a href="javascript:;" class="btnViewCapture" foto="'.base_url().'assets/arsip/capture-progress/'.$cp->FILE_NAME.'">
                                  <img
                                    src="'.base_url().'assets/arsip/capture-progress/'.$cp->FILE_NAME.'"
                                    class="rounded-md sw-10 sh-8"
                                    alt="product image 1"
                                  />
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>';
                }
              }
            }
          ?>
          </label>
          <?php if ($tipe == 'review' && $key->REVIEW_STATUS == 'REVISI'): ?>
            <hr>
            <div class="d-flex align-items-center me-3">
              <center>
                <button type="button" class="btn btn-primary mb-1 active-scale-down btnRevisi btn-block" data="<?=$key->ID?>">Start Revisi</button>
              </center>
            </div>    
          <?php endif ?>
      </div>
    </div>
  </div>
<?php endforeach ?>
<?php endif ?>