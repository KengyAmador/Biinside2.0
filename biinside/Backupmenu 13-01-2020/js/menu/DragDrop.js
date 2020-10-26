/*function readURL(input) {
    if (input.files && input.files[0]) {
  
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $('.image-upload-wrap').hide();
  
        $('.file-upload-image').attr('src', e.target.result);
        $('.file-upload-content').show();
  
        $('.image-title').html(input.files[0].name);
      };
  
      reader.readAsDataURL(input.files[0]);
  
    } else {
      removeUpload();
    }
  }
  
  function removeUpload() {
    $('.file-upload-input').replaceWith($('.file-upload-input').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
  }
  $('.image-upload-wrap').bind('dragover', function () {
          $('.image-upload-wrap').addClass('image-dropping');
      });
      $('.image-upload-wrap').bind('dragleave', function () {
          $('.image-upload-wrap').removeClass('image-dropping');
  });
*/
  //ACCESO 
  function readURLacceso(input) {
    if (input.files && input.files[0]) {
  
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $('#image-upload-wrap-acceso').hide();
  
        $('#file-upload-image-acceso').attr('src', e.target.result);
        $('#file-upload-content-acceso').show();
  
        $('#image-title-acceso').html(input.files[0].name);
      };
  
      reader.readAsDataURL(input.files[0]);
  
    } else {
      removeUploadAcceso();
    }
  }
  
  function removeUploadAcceso() {
    $('#file-upload-input-acceso').replaceWith($('#file-upload-input-acceso').clone());
    $('#file-upload-content-acceso').hide();
    $('#image-upload-wrap-acceso').show();
  }
  $('#image-upload-wrap-acceso').bind('dragover', function () {
          $('#image-upload-wrap-acceso').addClass('image-dropping');
      });
      $('#image-upload-wrap-acceso').bind('dragleave', function () {
          $('#image-upload-wrap-acceso').removeClass('image-dropping');
  });

  //PRODUCTOS

  function readURLProducto(input) {
    if (input.files && input.files[0]) {
  
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $('#image-upload-wrap-producto').hide();
  
        $('#file-upload-image-producto').attr('src', e.target.result);
        $('#file-upload-content-producto').show();
  
        $('#image-title-producto').html(input.files[0].name);
      };
  
      reader.readAsDataURL(input.files[0]);
  
    } else {
      removeUploadProducto();
    }
  }
  
  function removeUploadProducto() {
    $('#file-upload-input-producto').replaceWith($('#file-upload-input-producto').clone());
    $('#file-upload-content-producto').hide();
    $('#image-upload-wrap-producto').show();
  }
  $('#image-upload-wrap-producto').bind('dragover', function () {
          $('#image-upload-wrap-producto').addClass('image-dropping');
      });
      $('#image-upload-wrap-producto').bind('dragleave', function () {
          $('#image-upload-wrap-producto').removeClass('image-dropping');
  });
  
  