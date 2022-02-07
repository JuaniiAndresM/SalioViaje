function passwd(tipo){

    switch(tipo){
          // Login
          case 1:
          if($('#passeye').hasClass('show')){
             $('#password').attr('type', 'password');
             $('#passeye').html('<i class="fas fa-eye-slash"></i>');
             $('#passeye').attr('class','hidden');
          }else{
             $('#password').attr('type', 'text');
             $('#passeye').html('<i class="fas fa-eye"></i>');
             $('#passeye').attr('class','show');
          }
          break;
  
          // PIN 1
          case 2:
          if($('#passeye2').hasClass('show')){
             $('#password2').attr('type', 'password');
             $('#passeye2').html('<i class="fas fa-eye-slash"></i>');
             $('#passeye2').attr('class','hidden');
          }else{
             $('#password2').attr('type', 'text');
             $('#passeye2').html('<i class="fas fa-eye"></i>');
             $('#passeye2').attr('class','show');
          }
          break;
  
          // PIN 2
          case 3:
          if($('#passeye3').hasClass('show')){
             $('#re-password').attr('type', 'password');
             $('#passeye3').html('<i class="fas fa-eye-slash"></i>');
             $('#passeye3').attr('class','hidden');
          }else{
             $('#re-password').attr('type', 'text');
             $('#passeye3').html('<i class="fas fa-eye"></i>');
             $('#passeye3').attr('class','show');
          }
          break;
  
       }
  
  
  
  }