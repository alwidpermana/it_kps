<!-- Vendor Scripts Start -->
<script src="<?=base_url()?>assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="<?=base_url()?>assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/js/vendor/OverlayScrollbars.min.js"></script>
<script src="<?=base_url()?>assets/js/vendor/autoComplete.min.js"></script>
<script src="<?=base_url()?>assets/js/vendor/clamp.min.js"></script>

<script src="<?=base_url()?>assets/icon/acorn-icons.js"></script>
<script src="<?=base_url()?>assets/icon/acorn-icons-interface.js"></script>
<script src="<?=base_url()?>assets/js/vendor/bootstrap-notify.min.js"></script>
<script src="<?=base_url()?>assets/js/cs/scrollspy.js"></script>

<script src="<?=base_url()?>assets/js/vendor/select2.full.min.js"></script>

<script src="<?=base_url()?>assets/js/vendor/datepicker/bootstrap-datepicker.min.js"></script>

<script src="<?=base_url()?>assets/js/vendor/tagify.min.js"></script>

<!-- Vendor Scripts End -->

<!-- Template Base Scripts Start -->
<script src="<?=base_url()?>assets/js/base/helpers.js"></script>
<script src="<?=base_url()?>assets/js/base/globals.js"></script>
<script src="<?=base_url()?>assets/js/base/nav.js"></script>
<!-- <script src="<?=base_url()?>assets/js/base/search.js"></script> -->
<script src="<?=base_url()?>assets/js/base/settings.js"></script>
<!-- Template Base Scripts End -->
<!-- Page Specific Scripts Start -->

<script src="<?=base_url()?>assets/js/forms/layouts.js"></script>

<script src="<?=base_url()?>assets/js/common.js"></script>
<script src="<?=base_url()?>assets/js/scripts.js"></script>
<script>
  $(document).ready(function(){
    $('#btnLogin').on('click', function(){
      $('#modal-login').modal("show");
    })
    $('#btnProsesLogin').on('click', function(){
      var inputLoginNIK = $('#inputLoginNIK').val();
      var inputLoginPassword = $('#inputLoginPassword').val()
      var url = '<?=base_url()?>';
      $.ajax({
        type:'post',
        data:{inputLoginNIK, inputLoginPassword},
        dataType:'json',
        cache:false,
        async:true,
        url:url+'dashboard/proses_login',
        beforeSend:function(data){
          $('#btnProsesLogin').attr("disabled",true)
        },
        success:function(data){
          if (data.status == 'success') {
            $('#modal-login').modal("hide")
            $('#btnLogin').addClass("d-none")
            $('#btnLogout').removeClass("d-none")
            notif('Berhasil',"Anda Berhasil Login")
          }else{
            $('#alertLogin').html(data.alert);

          }
          
        },
        complete:function(data){
          $('#btnProsesLogin').attr("disabled",false)
        },
        error:function(data){
          $('#alertLogin').html('<div class="alert alert-primary" role="alert">Gagal Login!</div>');
        }
      })
    })
  })
	function notif(status, isiPesan) {
		jQuery.notify(
        {title: status, message: isiPesan},
        {
          type: 'primary',
          delay: 5000,
          placement: {
            from: 'top',
            align: 'right',
          },
        },
      );
	}
</script>
<!-- Page Specific Scripts End -->