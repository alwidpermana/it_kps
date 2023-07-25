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
              <h5 class="modal-title" id="staticBackdropLabel">Data Meeting Periodical</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="submitData">
              <input type="hidden" name="inputId" id="inputId">
              <div class="modal-body">
                <section class="scroll-section" id="floatingLabel">
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="" required />
                    <label>Meeting Name</label>
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
        })

        $('#submitData').submit(function(event){
          event.preventDefault();
          $.ajax({
            url:'saveDataMeetingPeriodical',
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
              $('#inputId').val("")
              $('#inputNama').val
            },
            error: function(data){
                notif("Gagal","Gagal Menyimpan Data");
            }
         });
          
        });
        $('#getTabel').on('click','.editData', function(){
          var id = $(this).attr("data");
          var meetingName = $(this).attr("meetingName");
          $('#tambahData').modal("show")
        })
      })
      function getTabel() {
        $.ajax({
          type:'get',
          url:'getMeetingPeriodical',
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
