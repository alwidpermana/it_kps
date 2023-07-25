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
              <div class="row">
                <div class="col-md-3 col-sm-4">
                  <div class="mb-3 w-100">
                    <label class="form-label">Staff IT</label>
                    <select class="selectBasic" id="filStaff">
                      <option value="">ALL</option>
                      <?php foreach ($staff as $st): ?>
                        <option value="<?=$st->NIK?>"><?=$st->NAMA?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card mb-5">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-sm-5 col-lg-3 col-xxl-2 mb-1">
                      <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 border border-separator bg-foreground search-sm">
                        <input class="form-control form-control-sm datatable-search" id="filSearch" placeholder="Search" data-datatable="#datatableStripe" />
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
            <!-- Help Text End -->
          </div>
          <!-- Content End -->
        </div>
      </main>
      <!-- Layout Footer Start -->
      <div class="modal fade" id="modal-progress" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div id="getProgress"></div>
                </div>
              </div>
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
    <script>
      $(document).ready(function(){
        getTabel();
        $('#getTabel').on('click','.btnProgress', function(){
          var id =$(this).attr("data");
          $.ajax({
            type:'get',
            data:{id},
            url:'<?=base_url("job_order/getProgress")?>',
            success:function(data){
              $('#modal-progress').modal("show");
              $('#getProgress').html(data);    
            }
          })
          
        })
      })
      function getTabel() {
        var filStaff = $('#filStaff').val();
        var filSearch = $('#filSearch').val();
        $.ajax({
          type:'get',
          data:{filStaff, filSearch},
          url:'job_order/getListJobOrder',
          cache:false,
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
