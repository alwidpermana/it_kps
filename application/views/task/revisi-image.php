<div class="mt-4 d-flex flex-row flex-wrap">
  <?php foreach ($data as $key): ?>
    <div class="sw-20 sh-8 me-2 mb-2">
      <div class="row g-0 rounded-sm sh-8 border">
        <div class="col-auto">
          <img
              src="<?=base_url()?>assets/arsip/capture-progress/<?=$key->FILE_NAME?>"
              class="card-img card-img-horizontal rounded-sm-start sw-10 sh-8"
              alt="product image 1"
            />
        </div>
        <div class="col rounded-sm-end d-flex flex-column justify-content-center px-3">
          <div class="d-flex justify-content-between">
            <a href="javascript:;" class="text-primary hapusCapture" data="<?=$key->ID?>">
              Hapus
            </a>
          </div>
        </div>
      </div>
    </div>    
  <?php endforeach ?>
</div>