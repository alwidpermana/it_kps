<!DOCTYPE html>
<html lang="en" data-footer="true" data-scrollspy="true" data-override='{"attributes": {"placement": "horizontal","navcolor": "default","layout": "fluid","radius": "rounded","behaviour":"unpinned"  }}'>
  <head>
    <?php $this->load->view("_partial/head") ?>
     <!-- Vendor Styles Start -->
    <!-- <link rel="stylesheet" href="<?=base_url()?>assets/css/vendor/bootstrap.min.css" /> -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/vendor/OverlayScrollbars.min.css" />

    <link rel="stylesheet" href="<?=base_url()?>assets/css/vendor/dropzone.min.css" />

    <!-- Vendor Styles End -->
  </head>

  <body>
    <div id="root">
      <div id="nav" class="nav-container d-flex">
        <?php $this->load->view("_partial/sidebar")?>
      </div>

      <main>
        <div class="container">
          <div class="row">
            <div class="col">
              <!-- Title Start -->
              <?php $this->load->view("_partial/content-header")?>
              <!-- Title End -->
            </div>
          </div>
          <!-- Content Start -->
          <br>
          <div class="row">
            <div class="col">
              <div class="row">
                <div class="col-3">
                  <button class="btn btn-primary mb-1 active-scale-down" type="button" data-bs-toggle="modal" data-bs-target="#tambahData" id="btnTambahData">Tambah Data</button>
                </div>
              </div>

              <br>
              <div id="getTabel"></div>  
            </div>
            <!-- Help Text End -->
          </div>
          
          <!-- Content End -->
        </div>
      </main>
      <div
        class="modal fade"
        id="tambahData"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        role="dialog"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Data Staff IT</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submitData">
              <input type="hidden" name="inputId" id="inputId">
              <div class="modal-body">
                <section class="scroll-section" id="singleImageUpload">
                  <h2 class="small-title">Foto</h2>
                  <div class="card">
                    <div class="card-body">
                      <div class="position-relative d-inline-block" id="singleImageUploadExample">
                        <img id="showImageStaffIT" alt="alternate text" class="rounded-xl border border-separator-light border-4 sw-11 sh-11" />
                        <button class="btn btn-sm btn-icon btn-icon-only btn-separator-light rounded-xl position-absolute e-0 b-0" type="button">
                          <i data-acorn-icon="upload"></i>
                        </button>
                        <input class="file-upload d-none" type="file" accept="image/*" name="inputFile" />
                      </div>
                    </div>
                  </div>
                </section>
                <section class="scroll-section" id="floatingLabel">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputNIK" name="inputNIK" placeholder="NIK" required />
                    <label>NIK</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Nama" required />
                    <label>Nama</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required />
                    <label>Email</label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputNoHP" name="inputNoHP" placeholder="No HP" required />
                    <label>No HP</label>
                  </div>
                  <div class="form-floating mb-3 w-100">
                    <select class="select2FloatingLabel" id="inputStatus" name="inputStatus">
                      <option value="AKTIF" selected>AKTIF</option>
                      <option value="TIDAK AKTIF">TIDAK AKTIF</option>
                    </select>
                    <label>Status</label>
                  </div>
                </section>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Layout Footer Start -->
      <footer>
        <?php $this->load->view("_partial/footer")?>
      </footer>
      <!-- Layout Footer End -->
    </div>

    <!-- Theme Settings Modal Start -->
    <?php $this->load->view("_partial/theme-setting")?>
    <!-- Theme Settings Modal End -->

    <!-- Theme Settings & Niches Buttons Start -->
    <div class="settings-buttons-container">
      <button type="button" class="btn settings-button btn-primary p-0" data-bs-toggle="modal" data-bs-target="#settings" id="settingsButton">
        <span class="d-inline-block no-delay" data-bs-delay="0" data-bs-offset="0,3" data-bs-toggle="tooltip" data-bs-placement="left" title="Settings">
          <i data-acorn-icon="paint-roller" class="position-relative"></i>
        </span>
      </button>
    </div>
    <!-- Theme Settings & Niches Buttons End -->
    <script src="<?=base_url()?>assets/js/plugins/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendor/dropzone.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendor/singleimageupload.js"></script>
    <script src="<?=base_url()?>assets/js/forms/controls.dropzone.js"></script>
    <?php $this->load->view("_partial/script")?>
    <script>
      $(function(){
        getTabel();
        var url = '<?=base_url()?>'
        $('#btnTambahData').on('click', function(){
          $('#inputId').val("");
          $('#showImageStaffIT').attr('src',url+'assets/img/profile/profile-11.webp');
        })

        $('#submitData').submit(function(event){
          event.preventDefault();
          $.ajax({
            url:'saveDataStaffIT',
            type:"post",
            data:new FormData(this), //this is formData
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
              notif('Berhasil','Berhasil Menyimpan Data')
              $('#tambahData').modal("hide")
              getTabel()
            },
            error: function(data){
                notif("Gagal","Gagal Menyimpan Data");
            }
         });
          
        });
        $('#getTabel').on('click','.editData', function(){
          var id = $(this).attr("data");
          $.ajax({
            type:'get',
            url:'getStaffById',
            data:{id},
            dataType:'json',
            cache:true,
            async:true,
            success:function(data){
              $('#tambahData').modal("show")
              $('#showImageStaffIT').attr('src',url+'assets/arsip/master-staff/'+data.FOTO);
              $('#inputId').val(data.ID);
              $('#inputNIK').val(data.NIK);
              $('#inputNama').val(data.NAMA);
              $('#inputEmail').val(data.EMAIL);
              $('#inputNoHP').val(data.NO_HP);
              $("select#inputStatus option[value='"+data.STATUS+"']").prop("selected","selected");
              $("select#inputStatus").trigger("change")
            },
            error:function(data){

            }
          })  
        })
      })
      function getTabel() {
        $.ajax({
          type:'get',
          url:'getStaff',
          cache:true,
          async:true,
          success:function(data){
            $('#getTabel').html(data);
          },
          error:function(data){

          }
        })
      }
    </script>
  </body>
</html>
