jQuery(document).ready(function($) {
	console.log('Readyteddy');
	jQuery(window).on('load', function() {
		if( jQuery('.popup-chnnyc').length ){

        	jQuery('.popup-chnnyc').modal('show');

		}
    });
});