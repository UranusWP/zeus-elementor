/**
 * File notice.js.
 */
 jQuery( document ).ready( function() {
	
	jQuery( '.zeus-notice' ).on( 'click', '.zeus-notice-dismiss', function(e) {
		e.preventDefault();
        var $wrapperElm = jQuery( this ).closest( '.zeus-notice' );
		jQuery.post( ajaxurl, {
			action: 'zeus_set_admin_notice_viewed',
			notice_id: $wrapperElm.data( 'notice_id' )
		} );
        $wrapperElm.fadeTo( 100, 0, function() {
			$wrapperElm.slideUp( 100, function() {
				$wrapperElm.remove();
			} );
        } );
	} );
} );
