$(function() {                             
        $('#btn-buscar').click(function(){
            if( $('input[name="sinonimo"]').val() != '' )
                $('#form-sinonimo').get(0).setAttribute('action', '/sinonimo/'+$('input[name="sinonimo"]').val()+'.html');
        });
        $('#btn-definicion').click(function(){
            if( $('input[name="definicion"]').val() != '' )
                $('#form-definicion').get(0).setAttribute('action', '/definicion/'+$('input[name="definicion"]').val()+'.html');
        });
        $('#btn-antonimos').click(function(){
            if( $('input[name="antonimos"]').val() != '' )
                $('#form-antonimos').get(0).setAttribute('action', '/antonimos/'+$('input[name="antonimos"]').val()+'.html');
        });
        
        /*$('.link_bottom').click(function(){
            $('#container-list-anpha').css("display", "block");
            $('.link_bottom a').css("display", "none");
            return false;
        });*/

        $('.suggest').click(function(){
            var action = $(this).attr('href') ;
            $('.btn_suggest_fail').css('display','none');
            $.get(action, function(html) {
                $('.form_suggest').html(html);
            });
            $('.form_suggest').css('display','block');
            return false;
        });

    });
