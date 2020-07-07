$(document).ready(function(){
    
    /*--------------basic funtions*------------*/
    $(function(){
         
        $("#header").load("./basic/header.html");
        $("#footer").load("./basic/footer.html"); 
        //$("#header").html("<button class='' id='nav-menu'>teste</button>");
       // $("#header").append("<button class='' id='nav-menu'>teste</button>");
        
    });
    
    /*--------------basic funtions*------------*/
    $('#nav-menu').click(function(){ 	
        alert("MENU")
    })
/*
     $('#btn-login').click(function(){ 	
         
                        
        var email=$('#email').val();	
        var pass=$('#pass').val();
        var data = {
            "action" : "authenticate",
            "token" : "teste",
            "appID" : "teste",
            "auth" : {
                "email" : email,													
                "pass"  : pass
            }				
                
        };
        
           $.ajax({	                        
            type:"post",
            url:"modules/user/index.php",
            data: "data="+JSON.stringify(data),	
               success:function (result){
                
                if(result.status != 0){
                   $("#msg-error").show();
                   
                }else{
                    
                    localStorage.setItem("token", result.token);
                    $(location).attr('href', './user');
                }
                
            }
            

        })
        return false;	//Evita que a página seja atualizada
    })
*/

    $('#btn-register').click(function(){ 	
                        
        var name = $('#name').val();	
        var email = $('#email').val();
        var pass = $('#pass').val();	
        var rPass = $('#rPass').val();

        var data = {
            "action" : "insert",
            "token" : "teste",
            "appID" : "teste",
            "auth" : {
                "name" : name,
                "email" : email,													
                "pass"  : pass
            }          
        };
        
        /************ */
        var cont = 0;
        $("#form input").each(function(){
            
            if($(this).val() == "")
                {
                    //$(this).css({"border" : "1px solid #F00", "padding": "2px"});
                    cont++;
                }
           });
           if(pass != rPass){
                cont = cont + 1
           }

            if(cont == 0){
                $.ajax({	                        
                    type:"post",
                    url:"modules/user/index.php",
                    data: "data="+JSON.stringify(data),	
                    success:function (result){
                        
                        if(result.status != 0){
                            //$("#msg-error").show();
                            alert(result.status);
                        
                        }else{
                            $(location).attr('href', './login.html');
                        }
                        
                    }
                    
                })                
            }else{
                alert("Erro ao registrar")        
            }
        
        /************ */

       
       return false;
       
    })
 

})