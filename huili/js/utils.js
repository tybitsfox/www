/* Basic JavaScript Utility functions. Should be domain agnostic */

// Fix checkboxes so they can be compatabile
function makeCheckBoxesNinjaCompatible(debug) {
    var checkBoxes = document.querySelectorAll('[data-ninja-checkbox]');

    // work around for nodeList missing forEach
    checkBoxes.forEach = Array.prototype.forEach;

    checkBoxes.forEach(function(checkBox){
        if(debug){
            console.log("Attaching to checkBox", checkBox);
        }

        checkBox.addEventListener("click", function() {
            this.value = this.checked + "";
            console.log("checkBox value", this.value);
        });
    });
}

document.addEventListener("DOMContentLoaded", function() {
    makeCheckBoxesNinjaCompatible();
});

$(document).ready(function () {

    // Parse out URL paramaters
    $.urlParam = function (name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return (results && results[1]) || 0;
    };

    $.redirect = function (url) {
        window.location = url;
    };


    // Set `tab` query param when a bootstrap tab is selected
    $(document.body).on("click", "a[data-toggle][data-history-enabled]", function (event) {
        var pageUrl = '?tab=' + this.getAttribute("aria-controls");
        window.history.pushState('', '', pageUrl);
    });

    // Handle history functionality for bootstrap tabs
    $(window).on("popstate", function () {
        var anchor = $.urlParam('tab') || $("a[data-toggle='tab']").first().attr("aria-controls");
        $("a[href='#" + anchor + "']").tab("show");
    });
    

//    var forms = document.getElementsByTagName('form');
//    for (var i = 0; i < forms.length; i++) {
//        //   forms[i].noValidate = true;
//        console.log("Attaching to forms");
//        
//        forms[i].addEventListener('submit', function (event) {
//            //Prevent submission if checkValidity on the form returns false.
//            if (!event.target.checkValidity()) {
//                event.preventDefault();
//                console.error("form is invalid. Submission has been prevented.");
//                //Implement you own means of displaying error messages to the user here.
//            }
//        }, false);
//    }
    

});
