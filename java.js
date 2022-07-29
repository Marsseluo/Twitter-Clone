$(Document).ready(function(){


    //publicar tweets
    $('#btn_publicar').click(function(){
        if ($('#texto_tweet').val().length>0){
            $.ajax({
                url: 'inclui_tweet.php',
                method:'POST',
                data:{texto_tweet: $('#texto_tweet').val()}, //{chave1:valor1 , chave2:valor2}
                success: function(data){
                    $('#texto_tweet').val('');
                    atualiza_pagina();
                }
                
            })
                                           
        }

        else{
            alert('favor incluir um texto para publicação');
        }
    });

    //atualiza a página depois da publicação
    function atualiza_pagina(){
        $.ajax({
            url:'get_tweet.php',
            success: function(data){
                $('#tweets').html(data);
                
            }
        })
    }

    atualiza_pagina();
    //---------------------------------------------------------------//

    //procurar pessoas
    $('#btn_procurar').click(function(){
        if ($('#nome_pessoa').val().length>0){
            $.ajax({
                url: 'get_pessoas.php',
                method:'POST',
                data:$('#form_procurar_pessoas').serialize(), //função serialize cria um array automático para pesquisa
                success: function(data){
                    //verifica se retornou algum resultado da pesquisa em get_pessoas.php
                    if(data == ''){
                        $('#amigos').html('Nenhum usuário encontrado');
                    }

                    else{
                    $('#amigos').html(data);
                    }

                    //atribuir ação ao botão seguir
                    $('.btn_seguir').click(function(){
                                      
                        let id_usuario = $(this).data('id_usuario');

                        $('#seguir_'+id_usuario).hide();
                        $('#deixar_seguir_'+id_usuario).show();
                      
                        $.ajax({
                            url: 'seguir.php',
                            method:'post',
                            data: {seguir_id_usuario: id_usuario},
                            success:function(data){                        
                            }
                        })
                    });

                    //atribuir ação ao botão deixar seguir
                    $('.btn_deixar_seguir').click(function(){
                                               
                        var id_usuario = $(this).data('id_usuario');

                        $('#seguir_'+id_usuario).show();
                        $('#deixar_seguir_'+id_usuario).hide();
     
                       $.ajax({
                            url: 'deixar_seguir.php',
                            method:'post',
                            data: {deixar_seguir_id_usuario: id_usuario},
                            success:function(data){
                                                     
                            }
                        })
                    });
                }
                
            })
                                           
        }

        else{
            alert('Digite um nome para pesquisar');
        }
    });

})