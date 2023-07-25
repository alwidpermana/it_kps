<!DOCTYPE html>
<html lang="en" data-footer="true" data-scrollspy="true" data-override='{"attributes": {"placement": "horizontal","navcolor": "default","layout": "fluid","radius": "rounded","behaviour":"unpinned"  }}'>
  <head>
    <?php $this->load->view("_partial/head") ?>
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
                <section class="scroll-section">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-floating mb-3 w-100">
                        <select class="select2FloatingLabel" id="inputType" name="inputType">
                          <option value="Web Base" selected>Web Base</option>
                          <option value="Desktop">Desktop</option>
                        </select>
                        <label>Type</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Gambar</label>
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" id="inputFile" name="inputFile" required />
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <section class="scroll-section" id="floatingLabel">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <label for="basic-url" class="form-label">Link Program</label>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="sumberLink"></span>
                        <input type="text" class="form-control" id="inputLink" name="inputLink" required />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Nama" required />
                        <label>Nama Program</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-floating mb-3 w-100">
                        <select class="select2FloatingLabel" id="inputStaff" name="inputStaff">
                          
                        </select>
                        <label>Staff IT</label>
                      </div>
                    </div>
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
    <?php $this->load->view("_partial/script")?>
    <script type="text/javascript">
      $(function () {
        getTabel();
        getStaffFotApplication("");
        $('#btnTambahData').on('click', function(){
          settingLink();
          $('#inputFile').attr("required","required")
        })
        $('#inputType').on('change', function(){
          settingLink();
        })
        $('#submitData').submit(function(event){
          event.preventDefault();
          $.ajax({
            url:'saveProgram',
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
            data:{id},
            dataType:'json',
            url:'getProgramById',
            cache:true,
            async:true,
            success:function(data){
              $('#inputId').val(data.ID);
              $('#inputNama').val(data.NAME_PROGRAM)
              var getLink = data.TYPE == 'Web Base'?data.LINK.substring(26,100):data.LINK.substring(30,100);
              $('#inputLink').val(getLink)
              $("select#inputType option[value='"+data.TYPE+"']").prop("selected","selected");
              $("select#inputType").trigger("change")
              $("select#inputStaff option[value='"+data.STAFF_ID+"']").prop("selected","selected");
              $("select#inputStaff").trigger("change")
              $('#tambahData').modal("show")
              var el = $('#inputFile');
              el.wrap('<form>').closest('form').get(0).reset();
              el.unwrap();
              $('#inputFile').removeAttr("required","required")
            },
            error:function(data){

            }
          })
        })
        $('#getTabel').on('click','.deleteData', function(){
          var id = $(this).attr("data")
          $.ajax({
            type:'post',
            data:{id},
            dataType:'json',
            cache:false,
            async:true,
            url:'deleteProgram',
            success:function(data){
              notif('Berhasil','Berhasil Menghapus Data')
              getTabel();
            },
            error:function(data){
              notif('Gagal','Gagal Menghapus Data')
            }
          })
        })
      });

      function settingLink() {
        var inputType = $('#inputType').val()
        if (inputType == 'Web Base') {
          $('#sumberLink').html("http://192.168.0.213/")
        }else{
          $('#sumberLink').html("assets/arsip/program-desktop/")
        }
      }
      function getStaffFotApplication(staffId) {
        $.ajax({
          type:'get',
          dataType:'json',
          data:{staffId},
          cache:true,
          async:true,
          url:'getStaffForApplication',
          success:function(data){
            $('#inputStaff').html(data);
          },
          error:function(data){

          }
        })
      }
      function getTabel() {
        $.ajax({
          type:'get',
          url:'getProgram',
          cache:true,
          async:true,
          success:function(data){
            $('#getTabel').html(data)
          },
          error:function(data){

          }
        })
      }
  </script>
  </body>
</html>
