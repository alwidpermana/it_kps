<div class="row">
  <!-- Labels Start -->
  <div class="col-12 mb-5">
    <section class="scroll-section" id="labels">
      <div class="card mb-2 bg-transparent no-shadow d-none d-md-block sh-3">
        <div class="card-body pt-0 pb-0 h-100">
          <div class="row g-0 h-100 align-content-center">
            <div class="col-10 col-md-10 d-flex align-items-center text-alternate text-medium justify-content-start text-muted text-small">
              Meeting Name
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
                  <div class="col-10 col-md-10 d-flex flex-column justify-content-center text-left mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Meeting Name</div>
                    <div class="text-alternate"><?=$key->NAME_MEETING?></div>
                  </div>
                  <div class="col-2 col-md-2 d-flex flex-column justify-content-center text-center mb-1 mb-md-0">
                    <div class="text-muted text-small d-md-none">Action</div>
                    <div class="text-alternate">
                      <button class="btn btn-sm btn-icon btn-icon-start btn-outline-primary ms-1 editData" type="button" data="<?=$key->ID?>" meetingName="<?=$key->NAME_MEETING?>">
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
