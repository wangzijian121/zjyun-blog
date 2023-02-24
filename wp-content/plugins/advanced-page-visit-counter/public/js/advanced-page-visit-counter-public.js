(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    //

    jQuery.ajax({
        type: 'GET',
        url: apvc_rest.ap_rest_url + 'apvc/v1/update_visit',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('X-WP-Nounce', apvc_rest.wp_rest)
        },
        data: {
            ua: navigator.userAgent,
            url: window.location.href,
            referred: document.referrer,
            cpt: apvc_rest.ap_cpt
        },
        success: function (response) {
        }
    });

})(jQuery);
