$(document).ready(function ($) {
  $('form:not(.filter) :input:visible:enabled:first').focus();

 $('#imageUpload').on('change',function(){
   //get the file name
   var files = $(this)[0].files.length;
   //replace the "Choose a file" label
   $(this).next('.custom-file-label').html(files + ' image' );
})

   setTimeout(function () {
       $('#success-alert').hide();
   }, 1000);
   setTimeout(function () {
      $('#failed-alert').hide();
  }, 100);
  $('body').on('keydown', 'input, select', function(e) {
    if (e.which === 13) {
      $(this).next('input').focus();
    }
  });
});