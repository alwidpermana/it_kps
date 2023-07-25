<section class="scroll-section" id="labels">
  <div class="card mb-2 bg-transparent no-shadow d-none d-md-block sh-3">
    <div class="card-body pt-0 pb-0 h-100">
      <div class="row g-0 h-100 align-content-center">
        <div class="col-2 col-md-2 d-flex align-items-center mb-2 mb-md-0 justify-content-center text-muted text-small">Staff IT</div>
        <div class="col-1 col-md-1 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">
          Program
        </div>
        <div
          class="col-2 col-md-2 d-flex align-items-center justify-content-center text-alternate text-medium justify-content-center text-muted text-small"
        >
          Deskripsi
        </div>
        <div class="col-2 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">Objek/Form</div>
        <div class="col-1 col-md-1 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">Plan Date</div>
        <div class="col-2 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">
          Approve PIC
        </div>
        <div class="col-1 col-md-1 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">
          Jenis
        </div>
        <?php if ($status == 'DRAFT'): ?>
          <div class="col-1 col-md-1 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">
            Action
          </div>
        <?php else: ?>
          <div class="col-1 col-md-1 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">
            Status
          </div>  
        <?php endif ?>
        
      </div>
    </div>
  </div>
  <div class="scroll-out">
    <div class="scroll-by-count" id="listTask" data-count="<?=count($data)?>">
      <?php foreach ($data as $key): ?>
        <div class="card mb-2 sh-19 sh-md-8">
          <div class="card-body pt-0 pb-0 h-100">
            <div class="row g-0 h-100 align-content-center">
              <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                <div class="text-muted text-small d-md-none">Staff IT</div>
                <div class="text-alternate"><?=$key->NAMA?></div>
              </div>
              <div class="col-1 col-md-1 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                <div class="text-muted text-small d-md-none">Program</div>
                <div class="text-alternate"><?=$key->NAME_PROGRAM?></div>
              </div>
              <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                <div class="text-muted text-small d-md-none">Deksripsi</div>
                <div class="text-alternate"><?=$key->DESKRIPSI?></div>
              </div>
              <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                <div class="text-muted text-small d-md-none">Objek</div>
                <div class="text-alternate"><?=$key->OBJEK?></div>
              </div>
              <div class="col-1 col-md-1 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                <div class="text-muted text-small d-md-none">Plan Date</div>
                <div class="text-alternate"><?=date("Y-m-d", strtotime($key->PLAN_DATE))?></div>
              </div>
              <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                <div class="text-muted text-small d-md-none">PIC Approve</div>
                <div class="text-alternate"><?=$key->APPROVE_PIC?></div>
              </div>
              <div class="col-1 col-md-1 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                <div class="text-muted text-small d-md-none">Status</div>
                <div class="text-alternate">
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
                </div>
              </div>
              <?php if ($status == 'DRAFT'): ?>
                <div class="col-1 col-md-1 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                  <div class="text-muted text-small d-md-none">Action</div>
                  <div class="text-alternate">
                    <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1 hapusTask" type="button" taskID = "<?=$key->ID?>">
                      <i data-acorn-icon="bin" data-acorn-size="15"></i>
                      <span class="d-none d-xxl-inline-block">Delete</span>
                    </button>
                  </div>
                </div>
              <?php else: ?>
                <div class="col-1 col-md-1 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                  <div class="text-muted text-small d-md-none">Status</div>
                  <div class="text-alternate">
                    <?php
                      switch ($key->STATUS_JOB_ORDER) {
                        case 'Open':
                          $warnaStatus = 'bg-success';
                          break;
                        case 'Waiting For Approve':
                          $warnaStatus = 'bg-success';
                          break;
                        default:
                          $warnaStatus = 'bg-primary';
                          break;
                      }
                    ?>
                    <span class="badge <?=$warnaStatus?>"><?=$key->STATUS_JOB_ORDER?></span>
                  </div>
                </div>
              <?php endif ?>
            </div>
          </div>
        </div>    
      <?php endforeach ?>
    </div>
  </div>
</section>