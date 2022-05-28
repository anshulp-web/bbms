//Add donor form validation
jQuery.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    }, "Letters only please");
    
    $.validator.addMethod("pattern", function(value, element, regexpr) {
    return regexpr.test(value);
    }, "Please enter a valid number.");
    
     $("#add_product").validate({
      rules:{
        trans_no:{
            required : true
        },
        name:{
        required:true,
        alpha: true,
        minlength:3,
        maxlength:20
        },
        mob_no:{
            required:true,
            number: true,
            minlength:10,
            maxlength:10,
            pattern :/^[^0]\d*$/
        },
        sex:{
            required : true
        },
        blood_grp:{
            required : true
        },
        bag_type:{
            required : true
        },
        city:{
            required:true
        },
        trans_dt:{
            required:true
        },
        age:{
            required:true
        },
        address:{
            required:true
        },
        int_tube_no:{
            required:true
        }
      },
      messages:{
        trans_no:{
            required : "Please enter no"
        },
        name:{
            required:"Please enter name",
            alpha:"Please enter only alphabates",
    
        },
        mob_no:{
            required :"Please enter number",
            number:"Enter only numbers"
        },
        sex:{
            required:"Please select gender"
        },
        blood_grp:{
            required:"Please select blood group"
        },
        bag_type:{
            required:"Please select bag type"
        },
        city:{
            required:"Please enter city"
        },
        trans_dt:{
            required:"Please enter date"
        },
        age:{
            required:"Please enter age"
        },
        address:{
            required:"Please enter address"
        },
        int_tube_no:{
            required:"Please enter tube no."
        }
      }
    });
    
    $( '#add_product' ).each(function(){
    this.reset();
    });



    //add_user form validations
    jQuery.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
        }, "Letters only please");
        
        $.validator.addMethod("pattern", function(value, element, regexpr) {
        return regexpr.test(value);
        }, "Please enter a valid number.");
        
         $("#add_user").validate({
          rules:{
            id:{
                required : true
            },
            name:{
            required:true,
            alpha: true,
            minlength:3,
            maxlength:20
            },
            email_id:{
                required:true,
                email:true
            },
            password:{
                required:true
            },
            old_password:{
                required:true
            }
          },
          messages:{
            id:{
                required : "Please enter user id"
            },
            name:{
                required:"Please enter name",
                alpha:"Please enter only alphabates",
        
            },
            email_id:{
                required:"Please enter email address",
                email:"Please enter vailid email"
            },
            password:{
                required:"Please enter passowrd"
            },
            old_password:{
                required:"Please enter old password"
            }
          }
        });
        
        $( '#add_user' ).each(function(){
        this.reset();
        });


//Add issue form validation
jQuery.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    }, "Letters only please");
    
    $.validator.addMethod("pattern", function(value, element, regexpr) {
    return regexpr.test(value);
    }, "Please enter a valid number.");
    
     $("#add_issue").validate({
      rules:{
        trans_no:{
            required : true
        },
        name:{
        required:true,
        alpha: true,
        minlength:3,
        maxlength:20
        },
        mob_no:{
            required:true,
            number: true,
            minlength:10,
            maxlength:10,
            pattern :/^[^0]\d*$/
        },
        sex:{
            required : true
        },
        blood_grp:{
            required : true
        },
        prod_id:{
            required : true
        },
        city:{
            required:true
        },
        trans_dt:{
            required:true
        },
        age:{
            required:true
        },
        address:{
            required:true
        },
        hospital_nm:{
            required:true
        },
        father_nm:{
            required:true
        },
        prod_brcd:{
            required:true
        }
      },
      messages:{
        trans_no:{
            required : "Please enter no"
        },
        name:{
            required:"Please enter name",
            alpha:"Please enter only alphabates",
    
        },
        mob_no:{
            required :"Please enter number",
            number:"Enter only numbers"
        },
        sex:{
            required:"Please select gender"
        },
        blood_grp:{
            required:"Please select blood group"
        },
        prod_id:{
            required:"Please select product"
        },
        city:{
            required:"Please enter city"
        },
        trans_dt:{
            required:"Please enter date"
        },
        age:{
            required:"Please enter age"
        },
        address:{
            required:"Please enter address"
        },
        hospital_nm:{
            required:"Please enter hospital name"
        },
        father_nm:{
            required:"Please enter father/husband name"
        },
        prod_brcd:{
            required:"Please enter barcode no."
        }
      }
    });
    
    $( '#add_issue' ).each(function(){
    this.reload();
    });

    