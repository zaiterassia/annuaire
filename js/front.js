$(document).ready(function () {

    // ------------------------------------------------------- //
    // Custom Scrollbar
    // ------------------------------------------------------ //

    if ($(window).outerWidth() > 992) {
        $("nav.side-navbar").mCustomScrollbar({
            scrollInertia: 200
        });
    }

    // Main Template Color
    var brandPrimary = '#33b35a';

    // ------------------------------------------------------- //
    // Side Navbar Functionality
    // ------------------------------------------------------ //
    $('#toggle-btn').on('click', function (e) {

        e.preventDefault();

        if ($(window).outerWidth() > 1194) {
            $('nav.side-navbar').toggleClass('shrink');
            $('.page').toggleClass('active');
        } else {
            $('nav.side-navbar').toggleClass('show-sm');
            $('.page').toggleClass('active-sm');
        }
    });

    $("#myButton").on('click', function(e){
        e.preventDefault();
        var desc = $('#description').html();
        var mot = $('#motcle').html();

        $.ajax({
          url: 'scriptBD_modifSite.php',
          type: 'post',
          dataType: 'html',
          data: { description:desc, motcle:mot },
          success:function(response){
            if(response == 1){
              console.log('Save successfully'); 
            }else{
              console.log("Not saved.");
            }
          }
        });
        
      });


    // ------------------------------------------------------- //
    // Tooltips init
    // ------------------------------------------------------ //    

    $('[data-toggle="tooltip"]').tooltip()

    // ------------------------------------------------------- //
    // Universal Form Validation
    // ------------------------------------------------------ //

    $('.form-validate').each(function() {  
        $(this).validate({
            errorElement: "div",
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            ignore: ':hidden:not(.summernote),.note-editable.card-block',
            errorPlacement: function (error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                //console.log(element);
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.siblings("label"));
                } 
                else {
                    error.insertAfter(element);
                }
            }
        });
    });
    // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function () {
        return $(this).val() !== "";
    }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        $(this).siblings('.label-material').addClass('active');
    });

    // remove/keep label on blur
    materialInputs.on('blur', function () {
        $(this).siblings('.label-material').removeClass('active');

        if ($(this).val() !== '') {
            $(this).siblings('.label-material').addClass('active');
        } else {
            $(this).siblings('.label-material').removeClass('active');
        }
    });

    // ------------------------------------------------------- //
    // Jquery Progress Circle
    // ------------------------------------------------------ //

    

    // ------------------------------------------------------- //
    // External links to new window
    // ------------------------------------------------------ //

    $('.external').on('click', function (e) {

        e.preventDefault();
        window.open($(this).attr("href"));
    });

    // ------------------------------------------------------ //
    // Alert customise
    // ------------------------------------------------------ //

    window.setTimeout(function(){
        $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
            $(this).slideUp(500);
        });
    }, 2000);

});