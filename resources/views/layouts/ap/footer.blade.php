<!-- Vendor -->
<script src="/resources/themes/ap/js/vendor-all.min.js"></script>
<!-- Bootstrap -->
<script src="/resources/themes/ap/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI -->
<script src="/resources/jquery/ui/v1.12.1/js/jquery-v1.12.1.ui.js"></script>
<!-- Data Tables -->
<script src="/resources/jquery/addons/datatables/datatables.js"></script>
<!-- PCoded -->
<script src="/resources/themes/ap/js/pcoded.min.js"></script>
<!-- CK Editor -->
<script src="/resources/themes/ap/plugins/ckeditor/js/ckeditor.js"></script>
<script type="text/javascript">
  $(window).on('load', function() {
  // classic editor
  ClassicEditor
    .create( document.querySelector( '#classic-editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
  });
</script>
<!-- Custom JS -->
<script src="/resources/themes/ap/js/custom.js"></script>
<!-- Tiny MCE -->
<script src="/resources/jquery/addons/tinymce/v4.9.0/js/tinymce.min.js"></script>
<script src="/resources/jquery/addons/tinymce/v4.9.0/js/init.tinymce.js"></script>
<!-- Tabs -->
<script src="/resources/jquery/addons/tabs/tabs.js"></script>
