<!DOCTYPE html>
<?php
  date_default_timezone_set('Asia/Jakarta');
?>
<html lang="en" data-footer="true" data-scrollspy="true" data-override='{"attributes": {"placement": "horizontal","navcolor": "default","layout": "fluid","radius": "rounded","behaviour":"unpinned"  }}'>
  <head>
    <?php $this->load->view("_partial/head") ?>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/vendor/quill.bubble.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/vendor/quill.snow.css" />
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
                  <input type="hidden" id="inputIdMeeting">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Meeting No</label>
                        <input type="text" class="form-control" id="inputMeetingNo" readonly />
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Meeting Date</label>
                        <input type="text" class="form-control date-picker datePickerBasic" id="inputDate" value="<?=date("m/d/Y")?>" />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Meeting Name</label>
                        <input type="text" class="form-control" id="inputMeetingName"/>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">Hour (start meeting)</label>
                        <input type="text" class="form-control hourMask" id="inputHour" value="<?=date("H:i")?>" />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="mb-3">
                        <label class="form-label">PIC Meeting</label>
                        <input type="text" class="form-control" id="inputPIC"/>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                     <section class="scroll-section" id="basicMultiple">
                      <div class="w-100">
                        <label class="form-label">Meeting Attendee</label>
                        <select multiple="multiple" class="select2Multiple" id="inputAttend">
                          <?php foreach ($pegawai as $pw): ?>
                            <option value="<?=$pw->nik?>"><?=$pw->namapeg?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </section>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="mb-3 w-100">
                        <label class="form-label">Category</label>
                        <select class="selectBasic" id="inputCategory">
                          <option value="Periodical" selected>Periodical</option>
                          <option value="Non Periodical">Non Periodical</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="mb-3 w-100">
                        <label class="form-label">Room</label>
                        <select class="selectBasic" id="inputRoom">
                          <option value="Ruang Meeting 1" selected>Ruang Meeting 1</option>
                          <option value="Ruang Meeting 2">Ruang Meeting 2</option>
                          <option value="Ruang Meeting 3">Ruang Meeting 3</option>
                          <option value="Ruang Meeting 4">Ruang Meeting 4</option>
                          <option value="Ruang Meeting Engineering">Ruang Meeting Engineering</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 col-sm-4">
                      <button class="btn btn-icon btn-icon-start btn-primary mb-1 btn-block active-scale-down" type="button" id="btnStart">
                        <i data-acorn-icon="play"></i>
                        <span>Start Meeting</span>
                      </button>
                    </div>
                  </div>
                  <div class="row afterRunning d-none" id="viewMOM">
                    <div class="col-12">
                      <section class="scroll-section" id="quillStandart">
                        <h2 class="small-title">MoM</h2>
                        <div class="html-editor sh-19" id="quillEditor"></div>
                      </section>
                    </div>
                  </div>
                  <input type="hidden" name="inputId" id="inputId">

                  <div class="row afterRunning d-none mt-4">
                    <div class="col-md-3 col-sm-4">
                      <button class="btn btn-icon btn-icon-plus btn-primary mb-1 btn-block active-scale-down" type="button" id="btnAddTask">
                        <i data-acorn-icon="plus"></i>
                        <span>Add Task</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row afterRunning d-none">
                <!-- Labels Start -->
                <div class="col-12 mb-5">
                  <div id="getTask"></div>
                </div>
                <!-- Labels End -->
              </div>
              <div class="row afterRunning mt-4 d-none">
                <div class="col-md-4 col-sm-4">
                  <button class="btn btn-icon btn-icon-plus btn-primary mb-1 btn-block active-scale-down" width="100%" type="button" id="btnSave">
                    <i data-acorn-icon="save"></i>
                    <span>Save Meeting</span>
                  </button>
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
        id="modal-task"
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
              <h5 class="modal-title" id="staticBackdropLabel">Task</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                  <label>Objek</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control date-picker datePickerBasic" id="inputPlanDate" name="inputPlanDate"/>
                  <label>Plan Date</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="inputPICApprove" name="inputPICApprove" placeholder="PIC Approve"/>
                  <label>PIC Approve</label>
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
              </section>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="btnSimpanTask">Simpan</button>
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
    <script src="<?=base_url()?>assets/js/vendor/imask.js"></script>
    <script src="<?=base_url()?>assets/js/forms/inputmask.js"></script>
    <script src="<?=base_url()?>assets/js/vendor/quill.min.js"></script>
    <script src="<?=base_url()?>assets/js/vendor/quill.active.js"></script>
    <script src="<?=base_url()?>assets/js/forms/controls.editor.js"></script>
    <script src="<?=base_url()?>assets/js/vendor/select2.full.min.js"></script>
    <script src="<?=base_url()?>assets/js/forms/controls.select2.js"></script>
    <script>
      $(document).ready(function(){
        
        getMeetingNo();
        $('#btnStart').on('click', function(){
          var inputMeetingNo = $('#inputMeetingNo').val();
          var inputDate = $('#inputDate').val();
          var inputMeetingName = $('#inputMeetingName').val();
          var inputHour = $('#inputHour').val();
          var inputPIC = $('#inputPIC').val();
          // var inputAttend = $('#inputAttend').val();
          var inputCategory = $('#inputCategory').val();
          var attend = [];
          $.each($("#inputAttend option:selected"), function(){            
              attend.push($(this).val());
          });
          var joinAttends = attend.join(",")
          var inputAttend = joinAttends.split(',');
          var inputRoom = $('#inputRoom').val();
          $.ajax({
            type:'post',
            data:{inputMeetingNo, inputDate, inputMeetingName, inputHour, inputPIC, inputAttend, inputCategory, inputRoom},
            dataType:'json',
            cache:false,
            async:true,
            url:'saveDraftMeeting',
            beforeSend:function(data){
              getMeetingNo();
              $('#btnStart').attr("disabled", true)
            },
            success:function(data){
              if (data.status=='Success') {
                $('#viewMOM').removeClass("d-none")
                $('#inputHour').attr("readonly",true)
                $('#inputDate').attr("readonly", true)
                $('#inputId').val(data.id);
                $('#btnStart').addClass("d-none")
                $('#btnAddTask').removeClass("d-none")
                $('#inputPIC').attr("readonly", true)
                $('#inputDate').attr("readonly", true)
                $('.afterRunning').removeClass("d-none")
                getTask();
              }else{
                $(data.trigger).focus();
              }
              notif(data.status, data.message)
              
            },
            complete:function(data){
              $('#btnStart').attr("disabled", false)
            },
            error:function(data){
              notif('Gagal','Gagal Menyimpan Data Meeting')
            }
          })
        })
        $('#btnAddTask').on('click', function(){
          $('#modal-task').modal("show")
        })
        $('#btnSimpanTask').on('click', function(){
          var inputId = $('#inputId').val();
          var inputStaff = $('#inputStaff').val();
          var inputProgram = $('#inputProgram').val();
          var inputDeskripsi = $('#inputDeskripsi').val();
          var inputObjek = $('#inputObjek').val();
          var inputPlanDate = $('#inputPlanDate').val();
          var inputPICApprove = $('#inputPICApprove').val();
          var inputPIC = $('#inputPIC').val();
          var inputDate = $('#inputDate').val();
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
          $.ajax({
            type:'post',
            data:{inputId,inputStaff, inputProgram, inputDeskripsi, inputObjek, inputPlanDate, inputPICApprove, inputPIC, inputDate, inputRevisi, inputNew, inputUrgent},
            dataType:'json',
            cache:false,
            async:true,
            url:'saveTaskMeeting',
            beforeSend:function(data){
              $('#btnSimpanTask').attr("disabled",true)
            },
            success:function(data){
              if (data.status=='Success') {
                $('#inputDeskripsi').val("")
                $('#inputObjek').val("")
                $('#inputPlanDate').val("")
                $('#inputPICApprove').val("")
                $('#modal-task').modal("hide")
                getTask();
              }else{
                $(data.trigger).focus();
              }
              notif(data.status, data.message)
            },
            complete:function(data){
              $('#btnSimpanTask').removeAttr("disabled",false)
            },
            error:function(data){
              notif("Gagal","Gagal Menyimpan Task Meeting")
            }
          })
        })
        $('#getTask').on('click','.hapusTask', function(){
          var taskID = $(this).attr("taskID");
          $.ajax({
            type:'post',
            data:{taskID},
            dataType:'json',
            url:'hapusTask',
            cache:false,
            async:true,
            success:function(data){
              getTask();
              notif("Berhasil","Task Berhasil Dihapus")
            },
            error:function(data){
              notif("Gagal","Task Gagal Dihapus")
            }
          })
        })
        $('#btnSave').on('click', function(){
          var inputMeetingName = $('#inputMeetingName').val();
          var inputPIC = $('#inputPIC').val();
          var attend = [];
          $.each($("#inputAttend option:selected"), function(){            
              attend.push($(this).val());
          });
          var joinAttends = attend.join(",")
          var inputAttend = joinAttends.split(',');
          var inputRoom = $('#inputRoom').val();
          var inputCategory = $('#inputCategory').val();
          var inputRoom = $('#inputRoom').val();

          var myEditor = document.querySelector('#quillEditor')
          var inputMoM = myEditor.children[0].innerHTML
          var inputId = $('#inputId').val();
          $.ajax({
            type:'post',
            data:{inputMeetingName, inputPIC, inputAttend, inputRoom, inputCategory, inputRoom, inputMoM, inputId},
            dataType:'json',
            url:'saveMeeting',
            cache:false,
            async:true,
            beforeSend:function(data){
              $('#btnSave').attr("disabled",true)
            },
            success:function(data){
              notif(data.status,data.notif);
              if (data.status=='Success') {
                var url = '<?=base_url()?>'
                window.location.href = url+'/meeting';
              }
            },
            complete:function(data){
              $('#btnSave').attr("disabled",false)
            },
            error:function(data){
              notif("Gagal","Gagal Menyimpan Data Meeting! Hubungi Staff IT!");
            }
          })
        })
      })


      function getMeetingNo() {
        $.ajax({
          type:'get',
          dataType:'json',
          cache:false,
          async:true,
          url:'getMeetingNo',
          success:function(data){
            $('#inputMeetingNo').val(data);
          },
          error:function(data){
            $('#inputMeetingNo').val("error");
          }
        })
      }
      function getTask() {
        var inputId = $('#inputId').val();
        var status = 'DRAFT';
        $.ajax({
          type:'get',
          data:{inputId, status},
          url:'getTaskMeeting',
          cache:false,
          async:true,
          success:function(data){
            $('#getTask').html(data)
          },
          error:function(data){
            $('#getTask').html("")
          }
        })
      }
    </script>
  </body>
</html>
