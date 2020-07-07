$(document).ready(function(){

    $(function(){

        $("#header").load("./basic/header.html");
        
        var user_token = localStorage.getItem("token"); 
        
        if(user_token != null && user_token != "null"){
              
            var data = {
                "action" : "get",
                "token" : user_token,
                "appID" : "teste",				            
            };
            request(data)
        
        }
    
    });
    
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
        request(data);
        return false;	
    })

    
    function request(data){
        
       $.ajax({	                        
            type:"post",
            url:"modules/user/index.php",
            data: "data="+JSON.stringify(data),	
            success:function (result){
                if(data.action == "get"){
                    if(result.status == 0){
                        $(location).attr('href', './user');
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
                
            }    
        })
             
        return false;
    }
    
})