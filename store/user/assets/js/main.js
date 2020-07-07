$(document).ready(function(){
    /*--------------basic funtions*------------*/
    var user_token = localStorage.getItem("token"); 
    
    if(user_token == null || user_token == "null"){
        $(location).attr('href', './../login.html');
    }
    else{
        var data = {
            "action" : "get",
            "token" : user_token,
            "appID" : "teste"                
        };
        var url = "../modules/user/index.php";
        request(data,url)

        $("#header").load("./../basic/header.html");
        
        $('#txt-price').mask('#.##0,00', {reverse: true});
        $('#txt-amount').mask('99999');
        
    }   
    
    $('.list-group-item').click(function(event){
        var id = event.target.id;
        $('.list-group-item').removeClass('active');
        $('#'+id).addClass('active');
        $(".aba").hide();
        $("#aba-"+id).show();
        
        switch(id){
            case "tod-pedidos":
               var url = "../modules/pedidos/index.php";
                break;
            case "devol":
                var url = "../modules/pedidos/index.php";
                break;
            case "produtos":
                var url = "../modules/produtos/index.php";
                break;
            case "clientes":
                
                var url = "../modules/user/index.php";
                var data = {
                    "action" : "lista",
                    "token" : user_token,
                    "appID" : "teste"                
                };

                request(data,url);
                
                break;

            case "mensagens":
                var url = "../modules/mensagens/index.php";
                break;
            case "newsletter":
                var url = "../modules/user/index.php";
                break;   
        }
       

    });
    $("#fileOne").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
       $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $("#othFiles").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

    });

    /*--------------basic funtions*------------*/


   
    $('#btn-logout').click(function(){ 	
                  
        var token = localStorage.getItem("token");	
        var url = "./../modules/user/index.php";
        var data = {
            "action" : "logout",
            "token" : token,
            "appID" : "teste"                
        };
        request(data,url)
    
    })


    $('#btn-add-product').click(function(){ 	
        
        var text = $('#prodForm').serialize();
       
        var url = "../modules/product/index.php";
        /*var data = {
            "action" : "insert",
            "token" : user_token,
            "appID" : "teste",
            "auth" : JSON.stringify(text)  
        };*/
        data = JSON.stringify(text)
        teste(data,url)
       /*
        var url = "../modules/product/index.php";
        var data = {
            "action" : "insert",
            "token" : user_token,
            "appID" : "teste",
            "auth" : {
                "name" : name,
                "price" : price,													
                "description"  : description,
                "amount" : amount,
                "categorie" : categorie,
                "photo_a" : photo_a,
                "photos" : photos
            }          
        };
                        
        var cont = 0;
        $("#form input").each(function(){
            
            if($(this).val() == "")
                {
                    $(this).css({"border" : "1px solid #F00", "padding": "2px"});
                    cont++;
                }
        
        });
        
        if(cont == 0){
           request(data,url)                
        }else{
            alert("Erro ao registrar")        
        }
       
       return false;*/

       
    })
    function teste(data,url){
        
        $.ajax({	                        
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            url: url,
            data: data,	
            success:function (result){
                alert(result)
            },
            error:function(erro){
                alert(erro)
            }
            
        });
    }
    function request(data,url){
        
        $.ajax({	                        
            type: "post",
            url: url,
            data: "data="+JSON.stringify(data),	
            success:function (result){
                
                if(data.action == "get"){
                    
                    if(result.status == 0){
                    
                        $(".container").show();
                        if(result.user_status != "root"){
                            $("#user-painel").show();
                        }else{
                            $("#root-painel").show();
                        }
                        $("#usuario-nome").append("Olá "+result.name);    
                    
                    }
                     
                }

                if(data.action == "authenticate"){
                                         
                    if(result.status != 0){
                        $("#msg-error").show();
                         
                    }
                    else{
                        localStorage.setItem("token", result.token);
                        $(location).attr('href', './user');
                    }
                }

                if(data.action == "logout"){
                    localStorage.removeItem("token");
                    $(location).attr('href', './../login.html');
                    
                }

                if(data.action == "insert"){
                    
                    alert(result)
                }
                if(data.action == "lista"){
                    
                    var list = result.list;
                  // $("#tab-clie tr" ).clear();
                    
                   $("#tab-clie").html("<tr><td>#</td><td>teste</td><td>20/06/2020</td><td>5</td></tr>");
               
                    list.forEach(function(element){
                        
                        $("#tab-clie" ).append('<tr>');
                        $("#tab-clie" ).append("<td>#</td>");
                        $("#tab-clie" ).append("<td>"+element.nome+"</td>");
                        $("#tab-clie" ).append("<td>"+element.dat+"</td>");
                        $("#tab-clie" ).append("<td>"+element.compras+"</td>");                
                        $("#tab-clie" ).append("</tr>");

                    });
                    
                } 
            }
        })
              
        return false;
        
    }
    
    

})