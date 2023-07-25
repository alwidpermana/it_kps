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
              <div class="card mb-5">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <label>Meeting No</label>
                        </div>
                        <div class="col-md-8 col-md-8">
                          : <?=$data->MEETING_NO?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <label>Meeting Name</label>
                        </div>
                        <div class="col-md-8 col-md-8">
                          : <?=$data->MEETING_NAME?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <label>Meeting PIC</label>
                        </div>
                        <div class="col-md-8 col-md-8">
                          : <?=$data->MEETING_PIC?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <label>Category</label>
                        </div>
                        <div class="col-md-8 col-md-8">
                          : <?=$data->CATEGORY?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <label>Meeting Date</label>
                        </div>
                        <div class="col-md-8 col-md-8">
                          : <?=$data->MEETING_DATE?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <label>Meeting Hours</label>
                        </div>
                        <div class="col-md-8 col-md-8">
                          : <?=$data->START_HOUR?> s/d <?=$data->FINISH_HOUR?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <label>Meeting Attend</label>
                        </div>
                        <div class="col-md-8 col-md-8">
                          : <?php
                              $no = 1;
                              $jmlAttende = count($attende);
                              $listAttende = '';
                              foreach ($attende as $key) {
                                $listAttende = $key->namapeg;
                                // $listAttende.=$key->namapeg;
                                if ($no != $jmlAttende) {
                                  $listAttende.=', ';
                                }
                                echo $listAttende;
                                $no++;
                              }
                            ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 col-sm-4">
                          <label>Room</label>
                        </div>
                        <div class="col-md-8 col-md-8">
                          : <?=$data->ROOM?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12">
                      <label>MoM :</label>
                      <br>
                      <?=$data->MOM?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12 mb-5">
                  <div id="getTask"></div>
                </div>
              </div>  
            </div>
            <!-- Help Text End -->
          </div>
          <!-- Content End -->
        </div>
      </main>
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
    <script type="text/javascript">
      $(document).ready(function(){
        getTask();
      })
      function getTask() {
        var inputId = '<?=$this->uri->segment("3")?>';
        var url='<?=base_url()?>';
        var status='SAVED';
        console.log(inputId)
        console.log(url)
        $.ajax({
          type:'get',
          data:{inputId,status},
          url:url+'/meeting/getTaskMeeting',
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
