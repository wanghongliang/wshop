function checkPassword(pwd){ 
 	var objLow=document.getElementById("pwdLow"); 
	var objMed=document.getElementById("pwdMed"); 
	var objHi=document.getElementById("pwdHi"); 


	objLow.className="pwd-strength-box"; 
	objMed.className="pwd-strength-box"; 
	objHi.className="pwd-strength-box"; 
	if(pwd.length<6){ 
		objLow.className="pwd-strength-box-low"; 
	}else{ 
		var p1= (pwd.search(/[a-zA-Z]/)!=-1) ? 1 : 0; 
		var p2= (pwd.search(/[0-9]/)!=-1) ? 1 : 0; 
		var p3= (pwd.search(/[^A-Za-z0-9_]/)!=-1) ? 1 : 0; 
		var pa=p1+p2+p3; 
		if(pa==1){ 
			objLow.className="pwd-strength-box-low"; 
		}else if(pa==2){ 
			objMed.className="pwd-strength-box-med"; 
		}else if(pa==3){ 
			objHi.className="pwd-strength-box-hi"; 
		}


	} 	
	
 } 