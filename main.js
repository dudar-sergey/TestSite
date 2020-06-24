$(document).ready(function(){

    $(".deletePost").on("click", function(e){

        let current_id = $(this).attr('data-id');
        e.preventDefault();
        jQuery.ajax({
            type: "POST",
            url: "index.php",
            data: {current_id:current_id},
            success: function(){

                $('#'+current_id).fadeOut('slow');


            }
        });
            return false;
    });


    $('#search').keyup(function () {
         let text = $('#search').val();
        jQuery.ajax({
            type: "POST",
            url: "DataBase.php",
            data: {text:text},
            dataType: "html",
            success: function(data){


                   $('.code').html(data);


            }
        });

    });
});