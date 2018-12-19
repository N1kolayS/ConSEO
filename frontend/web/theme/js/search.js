/* ////////////////////////  SearchBox ((Placed in navbar)) //////////////////////////////////// */

'use strict';
$(function() {

    // initialise autocomplete
    $('input#search').autocomplete({
        data: {
            "Dashboard": null,
            "Button": null,
            "Floating Action Button": null,
            "Breadcrumbs": null,
            "Collections": null,
            "Collapsibles": null,
            "Dropdown": null,
            "Tabs": null,
            "Pagination": null,
            "Preloader": null,
            "Toasts": null,
            "Tooltip": null,
            "Waves": null,
            "Typography": null,
            "Icons": null,
            "Animations": null,
            "Shadow": null,
            "Media": null,
            "CSS Transitions": null,
            "Pulse": null,
            "Feature Discovery": null,
            "Media Js": null,
            "Cards": null,
            "Carousel": null,
            "Modals": null,
            "Range Slider": null,
            "SweetAlert": null,
            "Highlight": null,
            "Chartjs Charts": null,
            "Autocomplete": null,
            "Checkboxes": null,
            "Chips": null,
            "Pickers": null,
            "Radio Buttons": null,
            "Range": null,
            "Select": null,
            "Switches": null,
            "Text Inputs": null,
            "Form Layouts": null,
            "Text Editor": null,
            "Basic Table": null,
            "Data Table": null,
            "Login": null,
            "Signup": null,
            "Reset": null,
            "Lock": null,
            "Change Password": null,
            "Contactus": null,
            "Blank": null,
            "404": null,
            "500": null,
            "Grid": null,
            "Color": null,
            "Helpers": null

        },
        limit: 6, // total number of search row appear in result dropdown
        // Callback function when value is autcompleted.
        minLength: 0,
        onAutocomplete: function(value) {

            // Grabbing input after autocomplete is done
            value = value.toLowerCase().split(" ").join("-") + ".html";
            if (window.location.href.indexOf(value) == -1) {
                $('input#search+.autocomplete-content').hide();
                window.location.href = value;
            }

        },
    });
});