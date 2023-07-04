jQuery(document).ready(function($) {
	console.log('Readyteddy');
	jQuery(window).on('load', function() {
		if( jQuery('.popup-chnnyc').length ){

        	jQuery('.popup-chnnyc').modal('show');

		}
    });

	try{

	        var swiper = new Swiper(".mySwiper", {
	            slidesPerView: 2.1,
	            spaceBetween: 20,
	            centeredSlides: true,

	            loop: true,
	            navigation: {
	                nextEl: ".swiper-next",
	                prevEl: ".swiper-prev",
	            },        
	            breakpoints: {

	                320: {
	                    slidesPerView: 1,
	                    spaceBetween: 0
	                },

	                991: {
	                    slidesPerView: 2.1,
	                    spaceBetween: 20
	                }
	            }        
	        });

	    }
	    catch(error) {
	    }
    
});