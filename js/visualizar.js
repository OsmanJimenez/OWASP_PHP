function mostrar(){
  
 
 const pass1=document.getElementById("password");
 
 const aparecer=document.getElementById("ver");


  if(aparecer.className=="fas fa-eye"){
      pass1.type = "text";
     
      aparecer.className=" fas fa-eye-slash";
  } else {
  	  pass1.type = "password";
    
      aparecer.className="fas fa-eye";
  }


}
function mostrar2(){
  
 
 
 const pass2=document.getElementById("password2");
 const aparecer=document.getElementById("ver2");


  if(aparecer.className=="fas fa-eye"){
     
      pass2.type = "text";
      aparecer.className="fas fa-eye-slash";
  } else {
  	      pass2.type = "password";
      aparecer.className="fas fa-eye";
  }


}