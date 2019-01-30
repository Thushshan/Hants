// JavaScript Document

function loginmethod(selectObj){
	var idx = selectObj.selectedIndex; 
    var which = selectObj.options[idx].value;
	
	if(which === "email" || which === "Email"){
		document.getElementById("emailgroup").className = "form-group";
		document.getElementById("employeeidgroup").className = "form-group login-method-none";
		document.getElementById("usernamegroup").className = "form-group login-method-none";
		document.getElementById("passwordgroup").className = "form-group";
		document.getElementById("login").className = "form-group ";
		document.getElementById("forgotpassword").className = "form-group";
		}
	else if(which === "employeeid" || which === "Employeeid"){
		document.getElementById("emailgroup").className = "form-group login-method-none";
		document.getElementById("employeeidgroup").className = "form-group";
		document.getElementById("usernamegroup").className = "form-group login-method-none";
		document.getElementById("passwordgroup").className = "form-group";
		document.getElementById("login").className = "form-group ";
		document.getElementById("forgotpassword").className = "form-group";
		}
	else if(which === "username" || which === "Username"){
		document.getElementById("emailgroup").className = "form-group login-method-none";
		document.getElementById("employeeidgroup").className = "form-group login-method-none";
		document.getElementById("usernamegroup").className = "form-group";
		document.getElementById("passwordgroup").className = "form-group";
		document.getElementById("login").className = "form-group ";
		document.getElementById("forgotpassword").className = "form-group";
		}
	else{
		document.getElementById("emailgroup").className = "form-group login-method-none";
		document.getElementById("employeeidgroup").className = "form-group login-method-none";
		document.getElementById("usernamegroup").className = "form-group login-method-none";
		document.getElementById("passwordgroup").className = "form-group login-method-none";
		document.getElementById("login").className = "form-group login-method-none";
		document.getElementById("forgotpassword").className = "form-group login-method-none";
		}
	}


function view_password(){
	
	var pass = document.getElementById("password");
	
	if(document.getElementById("viewpassword").checked)
	{
		pass.setAttribute('type','text');
	}
	else{
		pass.setAttribute('type','password');
	}
	}
