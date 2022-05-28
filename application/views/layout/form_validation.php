
<script>
    $(document).ready(function() {
     $('#login_form').validate({
      rules :{
          id:{
              required:true
          },
          password:{
              required:true
          }
      },
      messages:{
          id : {
              required :'Please enter user id'
          },
          password:{
              required :'Please enter your password'
          }
      }
     });
    });
</script>
<script>
    $(document).ready(function(){
        $("#login_form")[0].reset();
    });
</script>

<script>
    $('#forgot_password').validate({
        rules:
        {
            email:{
                required:true,
                email:true
            }
        },
        messages:
            {
                email:{
                    required:"Please enter registered email id",
                    email :"Please enter vailid email id"
                }
            }
    });
</script>
<script>
    $(document).ready(function(){
        $("#forgot_password")[0].reset();
    });
</script>
