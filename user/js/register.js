
(function ($) {
    "use strict";


    /*==================================================================
    [ Focus input ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $("#btn-registrar").click(function() {
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        if(check){
            var nombre   = $('#user_name').val();
            var apellido = $('#user_apellido').val();
            var rut      = $('#user_rut').val();
            var correo   = $('#email').val();
            var password = $('#user_password').val();
            $.ajax({
               url:"./register.php",
               method:"POST",
               //data: $('#form_register').serialize(),
               data:{nombre:nombre, apellido:apellido, rut:rut, correo:correo, password:password},
               //dataType: "JSON",
               success:function(data){
                    //alert(data);
                    //location.href="./registrar.php";
                    bootbox.dialog({
                        title: 'Mensaje',
                        message: data,
                        buttons: {
                            ok: {
                                label: "OK",
                                className: 'btn-info',
                                callback: function(){
                                    location.href="./";
                                }
                            }
                        }
                    });
               },
               error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error procesando los datos');
                    
                }
            });


        }



    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else if ($(input).attr('type') == 'checkbox'){

            if($('#ckb1:checked').val() == undefined){
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    /*==================================================================
    [ Show pass ]*/
    var showPass = 0;
    $('.btn-show-pass').on('click', function(){
        if(showPass == 0) {
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('zmdi-eye');
            $(this).find('i').addClass('zmdi-eye-off');
            showPass = 1;
        }
        else {
            $(this).next('input').attr('type','password');
            $(this).find('i').addClass('zmdi-eye');
            $(this).find('i').removeClass('zmdi-eye-off');
            showPass = 0;
        }
        
    });


})(jQuery);