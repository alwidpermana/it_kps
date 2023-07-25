<div class="row">
  <!-- Labels Start -->
  <div class="col-12 mb-5">
    <section class="scroll-section" id="labels">
      <div class="card mb-2 bg-transparent no-shadow d-none d-md-block sh-3">
        <div class="card-body pt-0 pb-0 h-100">
          <div class="row g-0 h-100 align-content-center">
            <div class="col-2 col-md-2 d-flex align-items-center mb-2 mb-md-0 justify-content-center text-muted text-small">FOTO</div>
            <div class="col-1 col-md-1 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">
              NIK
            </div>
            <div
              class="col-2 col-md-2 d-flex align-items-center justify-content-center text-alternate text-medium justify-content-center text-muted text-small"
            >
              NAMA
            </div>
            <div class="col-2 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">EMAIL</div>
            <div class="col-2 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">NO_HP</div>
            <div class="col-1 col-md-1 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">
              Status
            </div>
            <div class="col-2 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">ACTION</div>
          </div>
        </div>
      </div>
      <div class="scroll-out">
        <div class="scroll-by-count" data-count="3">
          <?php foreach ($data as $key): ?>
            <div class="card mb-2 sh-19 sh-md-8">
              <div class="card-body pt-0 pb-0 h-100">
                <div class="row g-0 h-100 align-content-center">
                  <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Foto</div>
                    <div class="text-alternate">
                      <?php if ($key->FOTO == null || $key->FOTO == ''): ?>
                        <img src="<?=base_url()?>assets/img/profile/profile-11.webp" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                      <?php else: ?>
                        <img src="<?=base_url()?>assets/arsip/master-staff/<?=$key->FOTO?>" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                      <?php endif ?>
                      
                    </div>
                  </div>
                  <div class="col-1 col-md-1 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">NIK</div>
                    <div class="text-alternate"><?=$key->NIK?></div>
                  </div>
                  <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Nama</div>
                    <div class="text-alternate"><?=$key->NAMA?></div>
                  </div>
                  <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Email</div>
                    <div class="text-alternate"><?=$key->EMAIL?></div>
                  </div>
                  <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">No HP</div>
                    <div class="text-alternate"><?=$key->NO_HP?></div>
                  </div>
                  <div class="col-1 col-md-1 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Status</div>
                    <div class="text-alternate"><?=$key->STATUS?></div>
                  </div>
                  <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Action</div>
                    <div class="text-alternate">
                      <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1 editData" type="button" data="<?=$key->ID?>">
                        <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                        <span class="d-none d-xxl-inline-block">Edit</span>
                      </button>
                      <a href="<?=base_url()?>master/staff_detail/<?=$key->ID?>" class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1">
                        <i data-acorn-icon="info-circle" data-acorn-size="15"></i>
                      </a>
                      <!-- <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1" type="button">
                        <i data-acorn-icon="bin" data-acorn-size="15"></i>
                        <span class="d-none d-xxl-inline-block">Delete</span>
                      </button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>
  </div>
  <!-- Labels End -->
</div> 
