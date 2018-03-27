
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

    function sfgInterfaceControls( pdf, button, group ) {
        var activePdfs = document.getElementsByClassName('sfg-inner-pdf-active');
        for (var i = 0; i < activePdfs.length; i++) {
            if ($(activePdfs[i]).hasClass(group)) {
                $(activePdfs[i]).removeClass('sfg-inner-pdf-active');
            }
        }
        var newPdf = document.getElementById(pdf);
        $(newPdf).addClass('sfg-inner-pdf-active');


        var currentButton = document.getElementsByClassName('sfg-interface-active');
        $(currentButton).removeClass('sfg-interface-active');
        var newButton = document.getElementById(button);
        $(newButton).addClass('sfg-interface-active');

    }

    $(document).ready(function(){
        $('#sfg-dropdown-open').click(function() {
            sfgOpenTab('sfg-dropdown-open', 2);
        });

        // tabs

        if (window.location.hash) {
            var hash = window.location.hash.substring(1);
            sfgOpenTab(hash);
        }

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

        // food bev pdfs

        $('#food_pdf_button').click(function() {
            sfgInterfaceControls('food_pdf', 'food_pdf_button', 'food_group');
        });

        $('#beverage_pdf_button').click(function() {
            sfgInterfaceControls('beverage_pdf', 'beverage_pdf_button', 'food_group');
        });

        // maps pdfs

        $('#maps_suite_layout_button').click(function() {
            sfgInterfaceControls('suite_layout_pdf', 'maps_suite_layout_button', 'map_group');
        });

        $('#maps_suite_level1_button').click(function() {
            sfgInterfaceControls('suite_level1_pdf', 'maps_suite_level1_button', 'map_group');
        });

        $('#maps_suite_level2_button').click(function() {
            sfgInterfaceControls('suite_level2_pdf', 'maps_suite_level2_button', 'map_group');
        });

        $('#maps_ballpark_button').click(function() {
            sfgInterfaceControls('ballpark_pdf', 'maps_ballpark_button', 'map_group');
        });

    });

    $(window).ready(function(){

    });


})( jQuery );

