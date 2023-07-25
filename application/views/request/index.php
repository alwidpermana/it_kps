<!DOCTYPE html>
<html lang="en" data-footer="true" data-scrollspy="true" data-override='{"attributes": {"placement": "horizontal","navcolor": "default","layout": "fluid","radius": "rounded","behaviour":"unpinned"  }}'>
  <head>
    <?php $this->load->view("_partial/head") ?>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/vendor/datatables.min.css" />
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
              <div class="card mb-5">
                <div class="card-body">
                  <div class="row mb-3">
                    <div class="col-3">
                      <button class="btn btn-primary mb-1 active-scale-down" type="button" data-bs-toggle="modal" data-bs-target="#modal-request" id="btnTambahRequest">Request Program</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-12 col-sm-5 col-lg-3 col-xxl-2 mb-1">
                          <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 border border-separator bg-foreground search-sm">
                            <input class="form-control form-control-sm datatable-search" id="filSearch" placeholder="Search" data-datatable="#datatableStripe" value="" />
                            <span class="search-magnifier-icon">
                              <i data-acorn-icon="search"></i>
                            </span>
                            <span class="search-delete-icon d-none">
                              <i data-acorn-icon="close"></i>
                            </span>
                          </div>
                        </div>
                        <div class="col-12 col-sm-7 col-lg-9 col-xxl-10 text-end mb-1">
                          <div class="d-inline-block">
                            <!-- <button class="btn btn-icon btn-icon-only btn-outline-muted btn-sm datatable-print" type="button" data-datatable="#datatableStripe">
                              <i data-acorn-icon="print"></i>
                            </button>

                            <div class="d-inline-block datatable-export" data-datatable="#datatableStripe">
                              <button
                                class="btn btn-icon btn-icon-only btn-outline-muted btn-sm dropdown"
                                data-bs-toggle="dropdown"
                                type="button"
                                data-bs-offset="0,3"
                              >
                                <i data-acorn-icon="download"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                <button class="dropdown-item export-copy" type="button">Copy</button>
                                <button class="dropdown-item export-excel" type="button">Excel</button>
                                <button class="dropdown-item export-cvs" type="button">Cvs</button>
                              </div>
                            </div> -->
                            <div class="dropdown-as-select d-inline-block datatable-length" data-datatable="#datatableStripe">
                              <button
                                class="btn btn-outline-muted btn-sm dropdown-toggle"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                data-bs-offset="0,3"
                              >
                                10 Items
                              </button>
                              <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                <a class="dropdown-item" href="#">5 Items</a>
                                <a class="dropdown-item active" href="#">10 Items</a>
                                <a class="dropdown-item" href="#">20 Items</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Stripe Controls End -->

                      <!-- Stripe Table Start -->
                      
                      <div id="getTabel"></div>
                      <div id="paging"></div>
                      <!-- Stripe Table End -->
                    </div>
                  </div>
                </div>
              </div>  
            </div>
            <!-- Help Text End -->
          </div>
          <!-- Content End -->
        </div>
      </main>
      <!-- Layout Footer Start -->
      <div
        class="modal fade"
        id="modal-request"
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
              <h5 class="modal-title" id="staticBackdropLabel">Request</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="inputId">
              <div class="alert alert-primary d-none notifAlert" role="alert"><span id="notifMessage"></span></div>
              <section class="scroll-section" id="floatingLabel">
                <div class="form-floating mb-3 w-100">
                  <select class="select2FloatingLabel" id="inputStaff" name="inputStaff">
                    <?php foreach ($staff_it as $si): ?>
                      <option value="<?=$si->ID?>"><?=$si->NAMA?></option>
                    <?php endforeach ?>
                  </select>
                  <label>Staff IT</label>
                </div>
                <div class="form-floating mb-3 w-100">
                  <select class="select2FloatingLabel" id="inputProgram" name="inputProgram">
                    <?php foreach ($program as $pr): ?>
                      <option value="<?=$pr->ID?>"><?=$pr->NAME_PROGRAM?></option>
                    <?php endforeach ?>
                  </select>
                  <label>Program</label>
                </div>
                <div class="form-floating mb-3">
                  <textarea class="form-control" placeholder="Deskripsi" rows="3" id="inputDeskripsi" name="inputDeskripsi"></textarea>
                  <label>Deskripsi</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="inputObjek" name="inputObjek" placeholder="Objek"/>
                  <label>Objek/Form</label>
                </div>
                <label class="form-label">Jenis</label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="inputRevisi" />
                  <label class="form-check-label" for="inputRevisi">Revisi</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="inputNew" />
                  <label class="form-check-label" for="inputNew">New</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="inputUrgent" />
                  <label class="form-check-label" for="inputUrgent">Urgent</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="inputError" />
                  <label class="form-check-label" for="inputError">Error</label>
                </div>
              </section>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="btnSimpanRequest">Simpan</button>
            </div>
          </div>
        </div>
      </div>
      <div
        class="modal fade"
        id="modal-approve"
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
              <h5 class="modal-title" id="staticBackdropLabel">Request</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="inputIdApprove">
              <input type="hidden" id="inputJenisApprove">
              <input type="hidden" id="inputPIC">
              <div class="alert alert-primary d-none notifAlertRequest" role="alert"><span id="notifMessageRequest"></span></div>
              <div class="mb-3 mt-3">
                <label class="form-label">Plan Date</label>
                <input type="text" class="form-control date-picker datePickerBasic" id="inputPlanDate" value="<?=date("m/d/Y")?>" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="btnSimpanApprove">Simpan</button>
            </div>
          </div>
        </div>
      </div>
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
    <?php $this->load->view("_partial/script")?>
    <script src="<?=base_url()?>assets/js/vendor/datatables.min.js"></script>
    <script src="<?=base_url()?>assets/js/plugins/datatable.boxedvariations.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        getTabel();
        $('#btnTambahRequest').on('click', function(){
          $('.notifAlert').addClass("d-none")
          $('#inputId').val()
        })
        $('.editRequest').on('click', function(){
          $('.notifAlert').addClass("d-none")
        })
        $('#btnSimpanRequest').on('click', function(){
          var inputId = $('#inputId').val();
          var inputStaff = $('#inputStaff').val();
          var inputProgram = $('#inputProgram').val();
          var inputDeskripsi = $('#inputDeskripsi').val();
          var inputObjek = $('#inputObjek').val();
          if($('#inputRevisi').is(":checked")){
            var inputRevisi = 'Y'
          }else{
            var inputRevisi = 'N'
          }
          if($('#inputNew').is(":checked")){
            var inputNew = 'Y'
          }else{
            var inputNew = 'N'
          }
          if($('#inputUrgent').is(":checked")){
            var inputUrgent = 'Y'
          }else{
            var inputUrgent = 'N'
          }
          if($('#inputError').is(":checked")){
            var inputError = 'Y'
          }else{
            var inputError = 'N'
          }
          $.ajax({
            type:'post',
            data:{inputId, inputStaff, inputProgram, inputDeskripsi, inputObjek, inputRevisi, inputNew, inputUrgent, inputError},
            dataType:'json',
            url:'request/saveRequest',
            cache:false,
            async:true,
            beforeSend:function(data){
              $('#btnSimpanRequest').attr("disabled", true)
            },
            success:function(data){
              if (data.status == 'success') {
                var message = inputId == ''?'Berhasil Membuat Request Program':"Berhasil Update Request Program"
                notif("Berhasil", message);
                getTabel()
                $('.notifAlert').addClass("d-none")
                $('#modal-request').modal("hide")
              }else{
                $('.notifAlert').removeClass("d-none")
                $('#notifMessage').html(data.message)
                $(data.field).focus();
              }
            },
            complete:function(data){
              $('#btnSimpanRequest').attr("disabled",false)
            },
            error:function(data){
              // notif('Gagal',"Gagal Membuat Request! Mohon Hubungi Staff IT")
              $('.notifAlert').removeClass("d-none")
              $('#notifMessage').html("Gagal Membuat Request! Mohon Hubungi Staff IT")
            }
          })
        })
        $('#getTabel').on('click', '.edit', function(){
          var id = $(this).attr("data");
          var staff = $(this).attr("staff");
          var deskripsi = $(this).attr("deskripsi");
          var program = $(this).attr("program");
          var objek = $(this).attr("objek");
          var inputRevisi = $(this).attr("inputRevisi");
          var inputNew = $(this).attr("inputNew");
          var inputUrgent = $(this).attr("inputUrgent");
          var inputError = $(this).attr("inputError");
          $("select#inputStaff option[value='"+staff+"']").prop("selected","selected");
          $("select#inputStaff").trigger("change")
          $("select#inputProgram option[value='"+program+"']").prop("selected","selected");
          $("select#inputProgram").trigger("change")
          $('#inputDeskripsi').val(deskripsi)
          $('#inputObjek').val(objek)
          $('#inputId').val(id)
          $('#modal-request').modal("show")
          if (inputError == 'Y') {
            $('#inputError').prop('checked', true)
          }else{
            $('#inputError').prop('checked', false)
          }
        })
        $('#getTabel').on('click','.cancel', function(){
          var id = $(this).attr("data");
          $.ajax({
            type:'post',
            data:{id},
            dataType:'json',
            url:'request/cancelRequest',
            cache:false,
            async:true,
            success:function(data){
              notif('Berhasil',"Berhasil Cancel Request Program")
              getTabel();
            },
            error:function(data){
              $('.notifAlert').removeClass("d-none")
              $('#notifMessage').html("Gagal Membuat Request! Mohon Hubungi Staff IT")
            }
          })
        })
        $('#getTabel').on('click','.approve', function(){
          var id = $(this).attr("data");
          var jenis = $(this).attr("jenis")
          var pic = $(this).attr("pic");
          $('.notifAlertRequest').addClass("d-none")
          if (jenis == 'APPROVE') {
            $('#modal-approve').modal("show")
            $('#inputIdApprove').val(id)
            $('#inputJenisApprove').val(jenis)
            $('#inputPIC').val(pic)
          }else{
            var plan = '';
            saveApprove(id, jenis, plan, pic);  
          }
        })
        $('#btnSimpanApprove').on('click', function(){
          var inputPlanDate = $('#inputPlanDate').val();
          var inputIdApprove = $('#inputIdApprove').val();
          var inputJenisApprove = $('#inputJenisApprove').val();
          var inputPIC = $('#inputPIC').val();
          if (inputPlanDate == '') {
            $('#inputPlanDate').focus()
            $('.notifAlertRequest').removeClass("d-none")
            $('#notifMessageRequest').html("Isi Plan Date Terlebih Dahulu!")
          }else{
            saveApprove(inputIdApprove, inputJenisApprove, inputPlanDate, inputPIC);  
          }
          
        })
      })
      function getTabel() {
        var filSearch = $('#filSearch').val();
        $.ajax({
          type:'get',
          data:{filSearch},
          url:'request/getDataRequest',
          cache:false,
          async:true,
          success:function(data){
            $('#getTabel').html(data);
          },
          error:function(data){

          }
        })
      }
      function saveApprove(id, jenis, plan, pic) {
        $.ajax({
          type:'post',
          data:{id, jenis, plan, pic},
          dataType:'json',
          url:'request/saveApprove',
          cache:false,
          async:true,
          beforeSend:function(data){
            $('#btnSimpanApprove').attr("disabled", true)
          },
          success:function(data){
            notif("Berhasil","Berhasil Approve Request Program")
            getTabel()
            $('#modal-approve').modal("hide")
            $('.notifAlertRequest').addClass("d-none")
          },
          complete:function(data){
            $('#btnSimpanApprove').attr("disabled", false)
          },
          error:function(data){
            $('.notifAlertRequest').removeClass("d-none")
            $('#notifMessageRequest').html("Gagal Approve Request!")
          }
        })
      }
    </script>
  </body>
</html>
