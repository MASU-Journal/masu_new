$(document).ready(function(){
$("#myRegister").submit(function(e){
	var firstname = $("#firstname").val();
	var lastname = $("#lastname").val();
	var email = $("#email").val();
	var password_reg = $("#password_reg").val();
	var con_password = $("#con_password").val();
	$("#firstname").attr('placeholder','Name');
	$("#firstname").attr('style','border:1px solid #fff;');
	$("#lastname").attr('placeholder','Last Name');
	$("#lastname").attr('style','border:1px solid #fff;');
	$("#email").attr('placeholder','Email');
	$("#email").attr('style','border:1px solid #fff;');
	$("#password_reg").attr('placeholder','Password');
	$("#password_reg").attr('style','border:1px solid #fff;');
	$("#con_password").attr('placeholder','Confirm Password');
	$("#con_password").attr('style','border:1px solid #fff;');
	var count = 0;
	if(firstname == '' || firstname == undefined){
		$("#firstname").attr('placeholder','Please Enter Name');
		$("#firstname").attr('style','border:1px solid red;');
		count++;
	}
	if(lastname == '' || lastname == undefined){
		$("#lastname").attr('placeholder','Please Enter Last Name');
		$("#lastname").attr('style','border:1px solid red;');
		count++;
	}
	if(email == '' || email == undefined){
		$("#email").attr('placeholder','Please Enter Email');
		$("#email").attr('style','border:1px solid red;');
		count++;
	}
	if (email.indexOf("@", 0) < 0)                
    {
        $("#email").attr('placeholder','Please Enter Valid Email');
		$("#email").attr('style','border:1px solid red;');
		count++;
    }
  
    if (email.indexOf(".", 0) < 0)                
    {
        $("#email").attr('placeholder','Please Enter Valid Email');
		$("#email").attr('style','border:1px solid red;');
		count++;
    }
	 
	if(password_reg == '' || password_reg == undefined){
		$("#password_reg").attr('placeholder','Please Enter Password');
		$("#password_reg").attr('style','border:1px solid red;');
		count++;
	}
	if(con_password == '' || con_password == undefined){
		$("#con_password").attr('placeholder','Please Enter Confirm Password');
		$("#con_password").attr('style','border:1px solid red;');
		count++;
	}
	if (password_reg!="" && password_reg.length < 8) {
         alert("Password should atleast 8 character in length...!!!!!!");
         count++;
        //return false;
     } 
	if(password_reg!="" && con_password!="" && password_reg!=con_password){
		alert("Password Does't Match");
		count++;
		//return false;	
     }
	 
	if(count==0){
		$.ajax({
         				  type:'post',
         				  url:'do_login.php',
         				  data:{
         				   do_register:"do_register",
         				   email:email,
         				   password:password_reg,
         				   name:firstname,
						   lastname:lastname,
         				   
         				  },
         				  dataType: "json",
         				  success:function(response) {
         				  if(response.result=="success")
         				  {
         					alert("You Have Registered Successfully !Please Login to Continue");
         					$("#myLogin").show();
							$("#myRegister").hide();
         				  }
         				  else
         				  {
         					alert(response.result);
         					return false;
         				  }
         				  }
         			  });
	}
	e.preventDefault();
});
});