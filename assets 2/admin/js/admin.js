(function ($) {
    "use strict";

    // Tabs
    $( '.zeus-tabs li a' ).on('click', function(e) {
        e.preventDefault();

        $( '.zeus-tabs li a' ).removeClass('active');
        $( this ).addClass( 'active' );

        var tab = $(this).attr( 'href' );

        $( '.zeus-elements' ).removeClass( 'active' );
        $( '.zeus-settings-tabs' ).find( tab ).addClass( 'active' );
    } );

    // Save button reacting on any changes
    var saveBtn = $( '.zeus-btn-js' );

    $( '.zeus-checkbox input:enabled' ).on( 'click', function(e) {
        saveBtn.addClass( 'save-now' ).removeAttr( 'disabled' ).css( 'cursor', 'pointer' );
    });

    // Save data with Ajax
    saveBtn.on( 'click', function(e) {
        e.preventDefault();

        var $this = $( this );

        if ( $this.hasClass( 'save-now') ) {
            $.ajax( {
                url: localize.ajaxurl,
                type: 'post',
                data: {
                    action: 'zeus_save_settings',
                    security: localize.nonce,
                    fields: $( 'form#zeus-settings' ).serialize(),
                },
                beforeSend: function () {
                    $this.html( '<svg id="zeus-spinner" version="1.1" id="L7" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><path fill="#fff" d="M31.6,3.5C5.9,13.6-6.6,42.7,3.5,68.4c10.1,25.7,39.2,38.3,64.9,28.1l-3.1-7.9c-21.3,8.4-45.4-2-53.8-23.3 c-8.4-21.3,2-45.4,23.3-53.8L31.6,3.5z"><animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s" from="0 50 50" to="360 50 50" repeatCount="indefinite"></animateTransform></path><path fill="#fff" d="M42.3,39.6c5.7-4.3,13.9-3.1,18.1,2.7c4.3,5.7,3.1,13.9-2.7,18.1l4.1,5.5c8.8-6.5,10.6-19,4.1-27.7 c-6.5-8.8-19-10.6-27.7-4.1L42.3,39.6z"><animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="-360 50 50" repeatCount="indefinite"></animateTransform></path><path fill="#fff" d="M82,35.7C74.1,18,53.4,10.1,35.7,18S10.1,46.6,18,64.3l7.6-3.4c-6-13.5,0-29.3,13.5-35.3s29.3,0,35.3,13.5 L82,35.7z"></path></svg><span>' + localize.lang.saving + '</span>' );
                },
                success: function( response ) {
                    setTimeout( function() {
                        $this.html( '<span class="dashicons dashicons-yes icon-saved"></span><span>' + localize.lang.saved + '</span>' );
                        saveBtn.removeClass( 'save-now' );
                    }, 500);
                },
                error: function() {
                    $this.html( localize.lang.error );
                },
            });
        } else {
            $this.attr( 'disabled', 'true' ).css( 'cursor', 'not-allowed' );
        }
    });

    // Enable/Disable all widgets
    $( document ).on( 'click', '.zeus-btn-enable', function(e) {
        e.preventDefault();

        $( '.zeus-container .zeus-checkbox input:enabled' ).each( function(i) {
            $( this ).prop( 'checked', true ).change();
        } );

        saveBtn.addClass( 'save-now' ).removeAttr( 'disabled' ).css( 'cursor', 'pointer' );
    } );

    $( document ).on( 'click', '.zeus-btn-disable', function(e) {
        e.preventDefault();

        $( '.zeus-container .zeus-checkbox input:enabled' ).each( function(i) {
            $( this ).prop( 'checked', false ).change();
        } );

        saveBtn.addClass( 'save-now' ).removeAttr( 'disabled' ).css( 'cursor', 'pointer' );
    } );

    // Input change
    $( '.zeus-elements input' ).on( 'input', function(){
        saveBtn.addClass( 'save-now' ).removeAttr( 'disabled' ).css( 'cursor', 'pointer' );
    });

    // Select change
    $( '.zeus-elements select' ).on( 'change', function(){
        saveBtn.addClass( 'save-now' ).removeAttr( 'disabled' ).css( 'cursor', 'pointer' );
    });

    // Tooltip
    var tooltip = document.querySelectorAll( '.zeus-widget-link' );
    tooltip.forEach( ( tooltip ) => {
        tippy( tooltip, {
            duration: [300, 200],
            content: (reference) => reference.getAttribute( 'data-text' ),
        } );
    } );

})(jQuery);