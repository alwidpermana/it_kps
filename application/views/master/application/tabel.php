<div class="row">
  <!-- Labels Start -->
  <div class="col-12 mb-5">
    <section class="scroll-section" id="labels">
      <div class="card mb-2 bg-transparent no-shadow d-none d-md-block sh-3">
        <div class="card-body pt-0 pb-0 h-100">
          <div class="row g-0 h-100 align-content-center">
            <div class="col-1 col-md-1 d-flex align-items-center mb-2 mb-md-0 justify-content-center text-muted text-small">Picture</div>
            <div class="col-1 col-md-1 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">
              Type
            </div>
            <div
              class="col-3 col-md-3 d-flex align-items-center justify-content-center text-alternate text-medium justify-content-center text-muted text-small"
            >
              Name
            </div>
            <div class="col-3 col-md-3 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">Link</div>
            <div class="col-2 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">Staff</div>
            <div class="col-2 col-md-2 d-flex align-items-center text-alternate text-medium justify-content-center text-muted text-small">ACTION</div>
          </div>
        </div>
      </div>
      <div class="scroll-out">
        <div class="scroll-by-count" data-count="<?=count($data)?>">
          <?php foreach ($data as $key): ?>
            <div class="card mb-2 sh-19 sh-md-8">
              <div class="card-body pt-0 pb-0 h-100">
                <div class="row g-0 h-100 align-content-center">
                  <div class="col-1 col-md-1 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Picture</div>
                    <div class="text-alternate">
                      <?php if ($key->GAMBAR == null || $key->GAMBAR == ''): ?>
                        <img src="<?=base_url()?>assets/img/profile/profile-11.webp" class="card-img rounded-xl sh-6 sw-6" alt="thumb" />
                      <?php else: ?>
                        <div class="sw-7 me-1 mb-1 d-inline-block">
                          <img src="<?=base_url()?>assets/arsip/program/<?=$key->GAMBAR?>" class="img-fluid rounded-md" alt="thumb" />
                        </div>
                      <?php endif ?>
                    </div>
                  </div>
                  <div class="col-1 col-md-1 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Type</div>
                    <div class="text-alternate"><?=$key->TYPE?></div>
                  </div>
                  <div class="col-3 col-md-3 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Name</div>
                    <div class="text-alternate"><?=$key->NAME_PROGRAM?></div>
                  </div>
                  <div class="col-3 col-md-3 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Link</div>
                    <div class="text-alternate"><a href="<?=$key->LINK?>" class="text-primary" target="_blank"><?=$key->LINK?></a></div>
                  </div>
                  <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Staff</div>
                    <div class="text-alternate"><?=$key->NAMA?></div>
                  </div>
                  <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Action</div>
                    <div class="text-alternate">
                      <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1 editData" type="button" data="<?=$key->ID?>">
                        <i data-acorn-icon="edit-square" data-acorn-size="15"></i>
                        <span class="d-none d-xxl-inline-block">Edit</span>
                      </button>
                      <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1 deleteData" type="button" data="<?=$key->ID?>">
                        <i data-acorn-icon="bin" data-acorn-size="15"></i>
                        <span class="d-none d-xxl-inline-block">Delete</span>
                      </button>
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
