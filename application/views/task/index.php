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
                <div class="col-md-3 col-sm-4">
                  <div class="mb-3 w-100">
                    <label class="form-label">Staff IT</label>
                    <select class="selectBasic" id="filStaff">
                      <option value="&nbsp;">ALL</option>
                      <?php foreach ($staff as $st): ?>
                        <option value="<?=$st->NIK?>"><?=$st->NAMA?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 col-sm-6">
                  <h4>Job Order</h4><br>
                  <div class="col task-item">
                    <div id="getJobOrder"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <h4>On Progress</h4><br>
                  <div class="col task-item">
                    <div id="getOnProgress"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <h4>Revisi/Review</h4><br>
                  <div class="col task-item">
                    <div id="getReview"></div>
                  </div>
                </div>
                <div class="col-md-3 col-sm-6">
                  <h4>Done</h4><br>
                  <div class="col task-item">
                    <div id="getDone"></div>
                  </div>
                </div>
              </div>  
            </div>
            <!-- Help Text End -->
          </div>
          <!-- Content End -->
        </div>
      </main>
      <div
        class="modal fade"
        id="modal-revisi"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        role="dialog"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Revisi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              
              
              <div class="alert alert-primary d-none notifAlertRequest" role="alert"><span id="notifMessageRequest"></span></div>
              <section class="scroll-section" id="floatingLabel">
                <div class="form-floating mb-3">
                  <textarea class="form-control" placeholder="Deskripsi" rows="3" id="inputDeskripsi"></textarea>
                  <label>Deskripsi</label>
                </div>
              </section>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <form id="submitGambar">
                    <input type="hidden" id="inputJobOrderId" name="inputJobOrderId">
                    <input type="hidden" id="inputIdRevisi" name="inputIdRevisi">
                    <input type="hidden" name="inputTipe" value="REVISI">
                    <div class="form-group">
                      <label>Gambar</label>
                      <div class="input-group">
                        <input type="file" class="form-control" id="inputGroupFile04" name="inputFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload" />
                        <button class="btn btn-outline-primary" type="submit" id="inputGroupFileAddon04">Upload</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-2 col-sm-4">
                  <div class="form-group">
                    <label>&nbsp;</label>

                  </div>
                </div>
              </div>
              <div id="getImageRevisi"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="btnSimpanRevisi">Simpan</button>
            </div>
          </div>
        </div>
      </div>
      <div
        class="modal fade"
        id="modal-capture"
        data-bs-keyboard="false"
        tabindex="-1"
        role="dialog"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <div id="getViewCapture"></div>
            </div>
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
    <?php $this->load->view("_partial/script")?>
    

    <script>
      $(document).ready(function(){
        getJobOrder();
        getOnProgress();
        getReview();
        getDone();
        $('#getJobOrder').on('click','.btnNext', function(){
          var id = $(this).attr("data")
          var next = $(this).attr("next")
          var now = $(this).attr("now")
          var jenis = $(this).attr("jenis")
          var status = $(this).attr("status")
          console.log(next)
          if (jenis == 'next') {
            processNext(id, next, now, status);
          } else {
            processCancel(id, next, now);
          }
        })
        $('#getOnProgress').on('click','.btnNext', function(){
          var id = $(this).attr("data")
          var next = $(this).attr("next")
          var now = $(this).attr("now")
          var jenis = $(this).attr("jenis")
          var status = $(this).attr("status")
          console.log(next)
          if (jenis == 'next') {
            processNext(id, next, now, status);
          } else {
            processCancel(id, next, now);
          }
        })
        $('#getReview').on('click','.btnNext', function(){
          var id = $(this).attr("data")
          var next = $(this).attr("next")
          var now = $(this).attr("now")
          var jenis = $(this).attr("jenis")
          var status = $(this).attr("status")
          console.log(next)
          if (jenis == 'next') {
            processNext(id, next, now, status);
          } else {
            processCancel(id, next, now);
          }
        })

        $('#getJobOrder').on('click','.approve', function(){
          var id = $(this).attr("data")
          var jenis = $(this).attr("jenis")
          var progressId = $(this).attr("progressId");
          if (jenis == 'approve') {
            progressDone(id, jenis)
          }else{
            $('#inputJobOrderId').val(id);
            getModalRevisi(progressId);
          }
        })
        $('#getOnProgress').on('click','.approve', function(){
          var id = $(this).attr("data")
          var jenis = $(this).attr("jenis")
          var progressId = $(this).attr("progressId");
          if (jenis == 'approve') {
            progressDone(id, jenis)
          }else{
            $('#inputJobOrderId').val(id);
            getModalRevisi(progressId);
          }
        })
        $('#getReview').on('click','.approve', function(){
          var id = $(this).attr("data")
          var jenis = $(this).attr("jenis")
          var progressId = $(this).attr("progressId");
          if (jenis == 'approve') {
            progressDone(id, jenis)

          }else{
            $('#inputJobOrderId').val(id);
            getModalRevisi(progressId);
          }
        })
        $('#submitGambar').submit(function(event){
          event.preventDefault();
          $.ajax({
            url:'task/saveCaptureProgress',
            type:"post",
            data:new FormData(this), //this is formData
            processData:false,
            contentType:false,
            cache:false,
            async:false,
            success: function(data){
              getImageRevisi()
            },
            error: function(data){
               
            }
         });
          
        });
        $('#getImageRevisi').on('click','.hapusCapture', function(){
          var id = $(this).attr("data");
          $.ajax({
            type:'post',
            data:{id},
            dataType:'json',
            cache:true,
            async:false,
            url:'task/hapusCapture',
            success:function(data){
              getImageRevisi();
            },
            error:function(data){

            }
          })
        });
        $('#btnSimpanRevisi').on('click', function(){
          var inputIdRevisi = $('#inputIdRevisi').val();
          var inputDeskripsi = $('#inputDeskripsi').val();
          if (inputDeskripsi == '') {
            $('#inputDeskripsi').focus();
          }else{
            $.ajax({
              type:'post',
              data:{inputIdRevisi, inputDeskripsi},
              dataType:'json',
              cache:false,
              async:true,
              url:'task/saveRevisi',
              success:function(data){
                // getJobOrder()
                notif("Success","Berhasil Menyimpan Revisi");
                $('#modal-revisi').modal("hide")
                getReview()
              },
              error:function(data){
                notif("Error","Gagal Menyimpan Revisi! Hubungi Staff IT")
              }

            })  
          }
        })
        $('#getReview').on('click','.btnRevisi', function(){
          var id = $(this).attr("data");
          $.ajax({
            type:'post',
            data:{id},
            dataType:'json',
            cache:false,
            async:true,
            url:'task/startRevisi',
            success:function(data){
              getOnProgress();
              getReview();
            },
            error:function(data){
              notif("Error","Gagal Memulai Revisi! Hubungi Staff IT")
            }
          })
        })
        $('#getReview').on('click', '.btnViewCapture', function(){
          var foto = $(this).attr("foto");
          $('#modal-capture').modal("show")
          var html='<img src="'+foto+'" class="img-fluid rounded" alt="Responsive image" />'
          $('#getViewCapture').html(html);
        })
      })
      function getJobOrder() {
        var filStaff = $('#filStaff').val()
        $.ajax({
          type:'get',
          data:{filStaff, tipe:'job order'},
          url:'task/listTask',
          cache:false,
          async:true,
          success:function(data){
            $('#getJobOrder').html(data)
          },
          error:function(data){
            var html = '<div class="text-center">'
            html+='<i class="cs-warning-hexagon text-primary"></i>'
            html+='<p class="mb-0">No tasks found!</p>'
            html+='</div>'
                      
            $('#getJobOrder').html(html)
          }
        })
      }
      function getOnProgress() {
        var filStaff = $('#filStaff').val()
        $.ajax({
          type:'get',
          data:{filStaff, tipe:'on progress'},
          url:'task/listTask',
          cache:false,
          async:true,
          success:function(data){
            $('#getOnProgress').html(data)
          },
          error:function(data){
            var html = '<div class="text-center">'
            html+='<i class="cs-warning-hexagon text-primary"></i>'
            html+='<p class="mb-0">No tasks found!</p>'
            html+='</div>'
                      
            $('#getOnProgress').html(html)
          }
        })
      }
      function getReview() {
        var filStaff = $('#filStaff').val()
        $.ajax({
          type:'get',
          data:{filStaff, tipe:'review'},
          url:'task/listTask',
          cache:false,
          async:true,
          success:function(data){
            $('#getReview').html(data)
          },
          error:function(data){
            var html = '<div class="text-center">'
            html+='<i class="cs-warning-hexagon text-primary"></i>'
            html+='<p class="mb-0">No tasks found!</p>'
            html+='</div>'
                      
            $('#getReview').html(html)
          }
        })
      }
      function getDone() {
        var filStaff = $('#filStaff').val()
        $.ajax({
          type:'get',
          data:{filStaff, tipe:'done'},
          url:'task/listTask',
          cache:false,
          async:true,
          success:function(data){
            $('#getDone').html(data)
          },
          error:function(data){
            var html = '<div class="text-center">'
            html+='<i class="cs-warning-hexagon text-primary"></i>'
            html+='<p class="mb-0">No tasks found!</p>'
            html+='</div>'
                      
            $('#getDone').html(html)
          }
        })
      }
      function processNext(id, next, now, status) {
        $.ajax({
          type:'post',
          data:{id, next, now, status},
          dataType:'json',
          cache:false,
          async:true,
          url:'<?=base_url("task/nextTask")?>',
          success:function(data){
            if (data.status=='success') {
              notif("Berhasil","Progress Berhasil Menuju "+next);  
              loadProgress(now, next);
            }else{
              notif("Warning","Data Tidak Diketahui");
            }
            
          },
          error:function(data){
            notif("Gagal","Gagal Menuju Step Selanjutnya! Hubungi Staff IT");
          }
        })
      }
      function processCancel(id, next, now) {
        $.ajax({
          type:'post',
          data:{id, next, now},
          dataType:'json',
          cache:false,
          async:true,
          url:'<?=base_url("task/cancelTask")?>',
          success:function(data){
            if (data.status=='success') {
              notif("Berhasil","Progress Berhasil Di Cancel");  
              loadProgress(now, next);
            }else{
              notif("Warning","Data Tidak Diketahui");
            }
            
          },
          error:function(data){
            notif("Gagal","Gagal Meng-cancel progress! Hubungi Staff IT");
          }
        })
      }
      function progressDone(id, jenis) {
        $.ajax({
          type:'post',
          data:{id, jenis},
          dataType:'json',
          cache:false,
          async:true,
          url:'<?=base_url("task/progressDone")?>',
          success:function(data){
            notif("Berhasil","Progress Berhasil Disimpan");
            getDone()
            getReview();
          },
          error:function(data){
            notif("Gagal","Progress Gagal Disimpan! Hubungi Staff IT");
          }
        })
      }
      function loadProgress(first, second) {
        console.log(first)
        console.log(second)
        switch(first) {
          case 'job order':
            getJobOrder();
            break;
          case 'on progress':
            getOnProgress();
            break;
          case 'review':
            getReview();
            break;
          case 'done':
            getDone();
            break;
          default:
            
        }
        switch(second) {
          case 'Job Order':
            getJobOrder();
            break;
          case 'On Progress':
            getOnProgress();
            break;
          case 'Review':
            getReview();
            break;
          case 'Done':
            getDone();
            break;
          default:
        }
      }
      function getModalRevisi(id) {
        $.ajax({
          type:'get',
          data:{id},
          dataType:'json',
          cache:false,
          async:true,
          url:'task/getProgressById',
          success:function(data){
            $('#inputIdRevisi').val(id);
            $('#modal-revisi').modal("show")
            $('#inputDeskripsi').val(data.DESKRIPSI);
            getImageRevisi(); 
          },
          error:function(data){
            notif("Error","Gagal Mengambil Data! Hubungi Staff IT")
          }
        })
        
      }
      function getImageRevisi() {
        var inputIdRevisi = $('#inputIdRevisi').val()
        $.ajax({
          type:'get',
          data:{inputIdRevisi},
          cache:false,
          async:true,
          url:'<?=base_url("task/getImageRevisi")?>',
          success:function(data){
            $('#getImageRevisi').html(data);
          },
          error:function(data){
            $('#getImageRevisi').html("error")
          }
        })
      }
    </script>
  </body>
</html>
