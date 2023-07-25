<!DOCTYPE html>
<html lang="en" data-footer="true" data-override='{"attributes": {"placement": "horizontal","navcolor": "default","layout": "fluid","radius": "rounded","behaviour":"unpinned"  }}'>
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
                  <p class="mb-0">Examples and usage guidelines for form control styles and layout options.</p>
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
  </body>
</html>
