


$(document).ready(
	function()
	{
		$("#formulario").submit(function(e){
		     if($(this).closest('form')[0].checkValidity()){
			    e.preventDefault();
			    $.ajax({
	                url: 'php/mensaje.php',
	                type: 'POST',
	                data:{
						'nombre': $("#nombre").val(),
						'correo': $("#correo").val(),
						'asunto': $("#asunto").val(),
						'mensaje': $("#mensaje").val()
					},
	                success: function(data) {
	                	if(data==0)
	                	{
	                    	$("#pmensaje").text("El mensaje se envió correctamente. Gracias.");	
	                	}
	                	else
	                	{
	                    	$("#pmensaje").text("Ocurrió un problema, vuelve a intentarlo.");	
	                	}
	                }
	            });
			 }
			 else
			 {
			 	alert("Verifica los datos.");
			 }
		});

			$("#btnmas").click(function(e){
				e.preventDefault();
				$('html, body').animate({
	              scrollTop:$($.attr(this, 'href')).offset().top - 40
	            }, 1000, function(){
	              return false;
	            })
		   });

          $('.nav-link').on('click', function(e){
            e.preventDefault();
            $('html, body').animate({
              scrollTop:$($.attr(this, 'href')).offset().top - 40
            }, 1000, function(){
              return false;
            })
          })

		if ($(document).scrollTop() > 1) {
		    //$('nav').addClass('fixed-top');
		    $('header').addClass('sm-header');
		    $('#navbar-menu').addClass('navbar-scroll');
		    $('#navbar-menu.navbar.navbar-inverse.bg-inverse').addClass('bg-color-scroll');
		  } else {
		    //$('nav').removeClass('fixed-top');
		    $('header').removeClass('sm-header');
		    $('#navbar-menu').removeClass('navbar-scroll');
		    $('#navbar-menu.navbar.navbar-inverse.bg-inverse').removeClass('bg-color-scroll');
		  }

		  $('.navbar-nav>li>a').on('click', function(){
			    $('.navbar-collapse').collapse('hide');
		   });

		  $(document).on('click',function(){
			$('.collapse').collapse('hide');
		   })

		$(window).scroll(function() {
		  if ($(document).scrollTop() > 1) {
		    //$('nav').addClass('fixed-top');
		    $('header').addClass('sm-header');
		    $('#navbar-menu').addClass('navbar-scroll');
		    $('#navbar-menu.navbar.navbar-inverse.bg-inverse').addClass('bg-color-scroll');
		  } else {
		    //$('nav').removeClass('fixed-top');
		    $('header').removeClass('sm-header');
		    $('#navbar-menu').removeClass('navbar-scroll');
		    $('#navbar-menu.navbar.navbar-inverse.bg-inverse').removeClass('bg-color-scroll');
		  }
		});

		$(window).on('scroll', function() {
			var wScroll = $(this).scrollTop();
			wScroll > 1 ? $('#nav').addClass('fixed-nav') : $('#nav').removeClass('fixed-nav');
			wScroll > 700 ? $('#back-to-top').fadeIn() : $('#back-to-top').fadeOut();
		});

		$('#back-to-top').on('click', function(){
			$('body,html').animate({
				scrollTop: 0
			}, 600);
		});

	});

