
(function($) {

    function sfgOpenDropDown(id, node) {
        var elementUnHide = document.getElementById(id).childNodes[node];
        $(elementUnHide).css({'display' : 'block'});
    }

    function sfgOpenTab(id) {
        var activeButton = document.getElementsByClassName('inner-button-active');
        $(activeButton).removeClass('inner-button-active');
        var activePage = document.getElementsByClassName('inner-page-active');

        $(activePage).fadeTo("slow", 0);
        $(activePage).css({'display' : 'none'});
        $(activePage).removeClass('inner-page-active');

        var buttonUnHide = document.getElementById(id);
        $(buttonUnHide).addClass('inner-button-active');

        var addBorder = $('.no-button-border');
        $(addBorder).removeClass('no-button-border');
        var removeBorder = document.getElementsByClassName('inner-button-active')[0].previousSibling;
        $(removeBorder).addClass('no-button-border');


        var newPageId = "page-" + id;
        var pageUnHide = document.getElementById(newPageId);
        $(pageUnHide).fadeTo("slow", 1);
        $(pageUnHide).css({'display' : 'flex'})
        $(pageUnHide).addClass('inner-page-active');
    }

    function sfgInterfaceControls( pdf, button ) {
        var currentPdf = document.getElementsByClassName('sfg-inner-pdf-active')[0];
        $(currentPdf).removeClass('sfg-inner-pdf-active');
        var newPdf = document.getElementById(pdf);
        $(newPdf).addClass('sfg-inner-pdf-active');
        alert(pdf);

    }

    $(document).ready(function(){
        $('#sfg-dropdown-open').click(function() {
            sfgOpenDropDown('sfg-dropdown-open', 2);
        });

        // tabs

        $('#food-beverage').click(function() {
            sfgOpenTab('food-beverage');
        });

        $('#tv-guide').click(function() {
           sfgOpenTab('tv-guide');
        });

        $('#maps').click(function() {
            sfgOpenTab('maps');
        });

        $('#contact-concierge').click(function() {
            sfgOpenTab('contact-concierge');
        });

        $('#request-photog').click(function() {
            sfgOpenTab('request-photog');
        });

        $('#giants-az').click(function() {
            sfgOpenTab('giants-az');
        });

        $('#stats').click(function() {
            sfgOpenTab('stats');
        });

        $('#events').click(function() {
            sfgOpenTab('events');
        });

        $('#feedback').click(function() {
            sfgOpenTab('feedback');
        });

        $('#browse').click(function() {
            sfgOpenTab('browse');
        });
    });

    $(window).ready(function(){
        // food bev pdfs

        $('#food_pdf_button').click(function() {
            sfgInterfaceControls('food_pdf', 'food_pdf_button');
        });

        $('#beverage_pdf_button').click(function() {
            sfgInterfaceControls('beverage_pdf', 'beverage_pdf_button');
        });
    });

})( jQuery );

