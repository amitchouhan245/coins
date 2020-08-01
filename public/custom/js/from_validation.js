$(document).ready(function(){

  jQuery.validator.addMethod("extension", function(value, element) {
  // allow any non-whitespace characters as the host part
  return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
}, 'Please enter a valid email address.');

})


//login form validation
$(function() {
 
  $("form[name='loginForm']").validate({
    
    rules: {

      /*firstname: "required",
      lastname: "required",*/
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      }
    },
    // Specify validation error messages
    messages: {
     /* firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",*/
      password: {
        required: "Please enter password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: {
        required: "Please enter email",
        email: "Please enter a valid email address"
      },
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        form.submit();
    }
  });

$("form[name='ProductunitForm']").validate({
    
    rules: {

      /*firstname: "required",
      lastname: "required",*/
      unit_name: {
        required: true,
       
      },
     
    },
    // Specify validation error messages
    messages: {
     /* firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",*/
      unit_name: {
        required: "Please enter unit name",
       
      },
      
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        form.submit();
    }
  });


/*Base Charges */
$("form[name='charges_info_form']").validate({
    
    rules: {

      base_charges: {
        required: true,
        number: true,
        //digits: true,
      },
      base_charges_for_km: {
        required: true,
        digits: true,

     },

     charges_per_km: {
        required: true,
        number: true,
     },
     charges_per_minute:{
        required: true,
        number:true,

     },
     waiting_charges_per_minute: {
        required: true,
        number: true,
     },
     p_base_charges : {
      required : true,
      number : true,
     },
     p_charges_per_minute : {
      required : true,
      number : true,
     },
     p_charges_per_km : {
      required : true,
      number : true,
     },
     p_waiting_charges_per_minute : {
      required : true,
      number : true,
     },
     
     
 
      
    },
    // Specify validation error messages
    messages: {
     
      base_charges: {
        required: "Please enter Base Charges.",
        number: "Please enter only  number.",
        //digits: "Please enter only digits.",
      },
      base_charges_for_km: {
        required: "Please enter Base Charges for Km",
         digits:"Please enter only Integer number.",
      },
      charges_per_km: {
        required: "Please Enter Charges Per Km",
        number: "Please enter only number.",
      },
      charges_per_minute:{
        required: "Please Enter Charges Per Min",
        number: "Please Enter only number"  
      },
      waiting_charges_per_minute: {
        required: "Please Enter Charges Per Km",
        number: "Please enter only number.",
      },
      p_base_charges: {
        required: "Please enter Base Charges.",
        number: "Please enter only  number.",
        
      },
      p_charges_per_km: {
        required: "Please Enter Peak Charges Per Km",
        number: "Please enter only number.",
      },
      p_charges_per_minute:{
        required: "Please Enter Peak Charges Per Min",
        number: "Please Enter only number"  
      },
      p_waiting_charges_per_minute: {
        required: "Please Enter Peak Waiting Charges Per Km",
        number: "Please enter only number.",
      },
      
      
      
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        form.submit();
    }
  });


// add country form   
$("form[name='CountryForm']").validate({
    
    rules: {
      country_name: {
        required: true,
        maxlength:15,
        lettersonly: true,
        
      }
     
    },
    // Specify validation error messages
    messages: {
      country_name: {
        required: "Please enter country name",
        maxlength:"Country Name should be less then 15 characters.",
        lettersonly:"Please Enter Valid Country Name."
        
        
      }   
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        form.submit();
    }
  });



$("form[name='StateForm']").validate({
    
    rules: {
      country_id: {
        required: true,  
      },
      state_name: {
        required: true,  
      }
     
    },
    // Specify validation error messages
    messages: {
      country_id: {
        required: "Please select country",
       
      }, 
       state_name: {
        required: "Please enter stete name",
       
      }     
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        form.submit();
    }
  });

$("form[name='CityForm']").validate({
    
    rules: {
      country_id: {
        required: true,  
      },
      state_id: {
        required: true,  
      },
      city_name: {
        required: true,  
      } 
    },
    // Specify validation error messages
    messages: {
      country_id: {
        required: "Please select country",
       
      }, 
      state_id: {
        required: "Please select state",
       
      }, 
       city_name: {
        required: "Please enter city name",
       
      }     
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        form.submit();
    }
  });

/*Add cancel Reasons validation Here*/

  $("form[name='CancelForm']").validate({
    
    rules: {
      cancel: {
        required: true,
        maxlength:100,
        //lettersonly: true,
        
      }
     
    },
    // Specify validation error messages
    messages: {
      cancel: {
        required: "Please enter Cancel Reason ",
        maxlength:"Cancel Reason should be less then 100 characters.",
        //lettersonly:"Please Enter Valid Country Name."
        
        
      }   
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
        form.submit();
    }
  });


//add category form validation
  $($("#CategoryForm")).validate({
    
    rules: {

      /*firstname: "required",
      lastname: "required",*/
      category_name: {
        required: true,
        maxlength:30,
      },
      category_image: {
        required: true,
       // extension: "pngjpe?g,bmp",
        
      }
    },
    // Specify validation error messages
    messages: {
     /* firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",*/
      category_name: {
        required: "Please enter category name",
        maxlength: "Please enter category name maximum 30 character",
      },
      category_image: {
        required: "Please enter category image",
       // extension:"Please enter a value with a valid extension.",
        
        
      },
    },
    

    submitHandler: function(form) {
      form.submit();
    }
  });


  //edit category form validation
  $("form[name='EditCategoryForm']").validate({
    
    rules: {

      /*firstname: "required",
      lastname: "required",*/
      edit_category_name: {
        required: true,
        maxlength:30,
      },
      edit_category_image: {
        required:false,
        //extension: 'png|jpe?g|bmp',
        
      }
    },
    // Specify validation error messages
    messages: {
     /* firstname: "Please enter your firstname",
      lastname: "Please enter your lastname",*/
      edit_category_name: {
        required: "Please enter category name",
        maxlength: "Please enter category name maximum 30 character",
      },
      edit_category_image: {
        required:"Please enter category image",
       // extension:"Please enter a value with a valid extension.",
        
        
      },
    },
    

    submitHandler: function(form) {
      form.submit();
    }
  });

//add slider form validation
  $($("#sliderForm")).validate({
    
    rules: {

      /*firstname: "required",
      lastname: "required",*/
      type: {
        required: true,
        maxlength:30,
      },
      link: {
        required: true,
        
      },
      slider_image: {
        required: true,
       // extension: "pngjpe?g,bmp",
        
      }
    },
    // Specify validation error messages
    messages: {
      type: {
        required: "Please enter type name",
        maxlength: "Please enter type name maximum 30 character",
      },
      link: {
        required: "Please enter link",
       
      },
      slider_image: {
        required: "Please enter slider image",
       // extension:"Please enter a value with a valid extension.",
        
        
      },
    },
    

    submitHandler: function(form) {
      form.submit();
    }
  });
  //Edit slider form validation
  $($("#EditSliderForm")).validate({
    
    rules: {

      /*firstname: "required",
      lastname: "required",*/
      edit_type: {
        required: true,
        maxlength:30,
      },
      edit_link: {
        required: true,
       
      }
    },
    // Specify validation error messages
    messages: {
      type: {
        required: "Please enter type name",
        maxlength: "Please enter type name maximum 30 character",
      },
      link: {
        required: "Please enter link",
       
      },
      slider_image: {
        required: "Please enter slider image",
       // extension:"Please enter a value with a valid extension.",
        
        
      },
    },
    

    submitHandler: function(form) {
      form.submit();
    }
  });

  //change password
        $("#changepassword_form").validate({
            rules: {
                password:{
                    required : true,
                    maxlength : 20,
                    minlength : 6
                 },
                newPassword: {
                    required: true,
                    maxlength: 20,
                    minlength: 6
                },
                confirmPassword: {
                    required: true,
                    maxlength: 20,
                    equalTo: "#newPassword"
                }
            },
            messages: {

              password: {
                    required: "Please enter password field.",

                    maxlength: "Password maxlength should be 20 character.",
                    minlength: "Password minlength should be 20 character"
                },

                newPassword: {
                    required: "Please enter new password field.",

                    maxlength: "New Password maxlength should be 20 character.",
                    minlength: "New Password minlength should be 20 character"
                },

                confirmPassword: {
                    required: "Please enter confirm password field.",
                    maxlength: "Confirm Password maxlength should be 20 character.",
                    equalTo: "Confirm password should be equal to new password."
                },

            },
//          
        });

  
$.validator.addMethod('oceanRule', function (value, element, param) {
    //Your Validation Here
    //console.log($('#message').val());

    if ($.trim($('#message').val()) == "") {
      
      return false;
    
    }else {
      
      return true;
    }

   // return isValid; // return bool here if valid or not.
}, 'Please enter message.');

          //edit category form validation
  $("form[name='add_blog_formsss']").validate({
    ignore: ":hidden:not(textarea)",
    rules: {

      title: {
        required: true,
        maxlength:30,
      },
     message: {
          oceanRule: true
      },
      blog_image: {
          required: true
      }
    },
    // Specify validation error messages
    messages: {

      title: {
        required: "Please enter title",
        maxlength: "Please enter title name maximum 30 character",
      },
      message: {
        required: "Please enter message",          
      },
       blog_image: {
        required: "Please select blog image",
      }
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

//add passenger
  $("form[name='AddPassengerForm']").validate({
    
    rules: {

      first_name: {
        required: true,
        maxlength: 50
      },
      last_name: {
        required: true,
        maxlength: 50
      },
      country_code: {
        required: true,
        maxlength: 4,
        number:true
      },
      mobile_number: {
        required: true,
        maxlength: 9,
        minlength:9,
        number:true
      },
      email: {
        email: true
      },
      password: {
        minlength: 6
      },
      gender: {
        required: true,
      }
    },
    messages: {
      
      first_name: {
        required: "Please enter first name",
        maxlength: "Your first name maxlength should be 50 characters long."
      },
      last_name: {
        required: "Please enter last name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      country_code: {
        required: "Please enter country code",
        maxlength: "Your country code maxlength should be 4 numeric value long.",
        numeric: "Please enter valid country code"
      },
      mobile_number: {
        required: "Please enter mobile number",
        maxlength: "Your mobile number maxlength should be 9 numeric value long.",
        minlength: "Your mobile number minlength should be 9 numeric value long.",
        number :"Please enter valid mobile number"
      },
      password: {
        minlength: "Your password must be at least 6 characters long"
      },
      email: {
        email: "Please enter a valid email address"
      },
      gender: {
        required: "Please select gender",
      },
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  //add driver
  $("form[name='AddDriverForm']").validate({
    
    rules: {

      first_name: {
        required: true,
        maxlength: 50
      },
      last_name: {
        required: true,
        maxlength: 50
      },
      country_code: {
        required: true,
        maxlength: 4,
        number:true
      },
      mobile_number: {
        required: true,
        maxlength: 9,
        minlength:9,
        number:true
      },
      profile_image: {
        required: true,
      },
      criminal_record_certificate : {
        required : true,
      },
      email: {
        email: true
      },
      password: {
        required: true,
        minlength: 6
      },
      gender: {
        required: true,
      },
      select_vehicle: {
        required: true,
      },
      country: {
        required: true,
      },
      state: {
        required: true,
      },
      city: {
        required: true,
      },
      address: {
        required: true,
      },
      license_number: {
        required: true,
      },
      vehicle_type: {
        required: true,
      },
      issued_on: {
        required: true,
      },
      expiry_date: {
        required: true,
      },
      license_image: {
        required: true,
      },

    },
    messages: {
      
      first_name: {
        required: "Please enter first name",
        maxlength: "Your first name maxlength should be 50 characters long."
      },
      last_name: {
        required: "Please enter last name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      country_code: {
        required: "Please enter country code",
        maxlength: "Your country code maxlength should be 4 numeric value long.",
        numeric: "Please enter valid country code"
      },
      mobile_number: {
        required: "Please enter mobile number",
        maxlength: "Your mobile number maxlength should be 9 numeric value long.",
        minlength: "Your mobile number minlength should be 9 numeric value long.",
        number :"Please enter valid mobile number"
      },
      password: {
        required: "Please enter password",
        minlength: "Your password must be at least 6 characters long"
      },
      email: {
        email: "Please enter a valid email address"
      },
      profile_image: {
        required: "Please enter profile image",
      },
      criminal_record_certificate : {
        required : "Please enter criminal record certificate image",
      },
      gender: {
        required: "Please select gender",
      },
      select_vehicle: {
        required: "Please select vehicle",
      },
      country: {
        required: "Please select country",
      },
      state: {
        required: "Please select state",
      },
      city: {
        required: "Please select city",
      },
      address: {
        required: "Please enter address",
      },
      license_number: {
        required: "Please enter license number",
      },
      vehicle_type: {
        required: "Please enter vehicle type",
      },
      issued_on: {
        required: "Please select license issued on date",
      },
      expiry_date: {
        required: "Please select license expiry date",
      },
      license_image: {
        required: "Please enter license image",
      },
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  //add staff
  $("form[name='AddStaffForm']").validate({
    
    rules: {

      first_name: {
        required: true,
        maxlength: 50
      },
      last_name: {
        required: true,
        maxlength: 50
      },
      country_code: {
        required: true,
        maxlength: 4,
        number:true
      },
      mobile_number: {
        required: true,
        maxlength: 9,
        minlength:9,
        number:true
      },
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      },
      gender: {
        required: true,
      }
    },
    messages: {
      
      first_name: {
        required: "Please enter first name",
        maxlength: "Your first name maxlength should be 50 characters long."
      },
      last_name: {
        required: "Please enter last name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      country_code: {
        required: "Please enter country code",
        maxlength: "Your country code maxlength should be 4 numeric value long.",
        numeric: "Please enter valid country code"
      },
      mobile_number: {
        required: "Please enter mobile number",
        maxlength: "Your mobile number maxlength should be 9 numeric value long.",
        minlength: "Your mobile number minlength should be 9 numeric value long.",
        number :"Please enter valid mobile number"
      },
      password: {
        required: "Please enter password",
        minlength: "Your password must be at least 6 characters long"
      },
      email: {
        required: "Please enter email",
        email: "Please enter a valid email address"
      },
      gender: {
        required: "Please select gender",
      },
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });
//edit customer
  $("form[name='editCustomerForm']").validate({
    
    rules: {

      first_name: {
        required: true,
        maxlength: 50
      },
      last_name: {
        required: true,
        maxlength: 50
      },
      mobile_verification_status: {
        required: true,
      },
      
    },
    messages: {
      
      first_name: {
        required: "Please enter first name",
        maxlength: "Your first name maxlength should be 50 characters long."
      },
      last_name: {
        required: "Please enter last name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      mobile_verification_status: {
        required: "Please select mobile verification status",
      },
      
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  //edit passenger
  $("form[name='editPassengerForm']").validate({
    
    rules: {

      first_name: {
        required: true,
        maxlength: 50
      },
      last_name: {
        required: true,
        maxlength: 50
      },
      verification_status: {
        required: true,
      },
      gender: {
        required: true,
      },
      country_code:{
        required: true,
        maxlength:2,
        number:true
      },
      mobile_number:{
        required: true,
        maxlength:9,
        number:true
      },
      email:{
        email:true,
      },
      
    },
    messages: {
      
      first_name: {
        required: "Please enter first name",
        maxlength: "Your first name maxlength should be 50 characters long."
      },
      last_name: {
        required: "Please enter last name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      verification_status: {
        required: "Please select verification status",
      },
      gender: {
        required: "Please select gender",
      },
       country_code:{
            required: "Please enter country code",
            maxlength:"Your country code maxlength should be 2 number long.",
            number:"Country code should be numeric value.",
      },
      mobile_number:{
            required: "Please enter mobile number",
            maxlength:"Your mobile number maxlength should be 10 number long.",
            number:"Mobile number should be numeric value.",
      },
      email:{
           
            email:"Please enter valid email",
      },
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  //edit driver
  $("form[name='editDriverForm']").validate({
    
    rules: {

      first_name: {
        required: true,
        maxlength: 50
      },
      last_name: {
        required: true,
        maxlength: 50
      },
      verification_status: {
        required: true,
      },
      gender: {
        required: true,
      },
      select_vehicle: {
        required: true,
      },
      country: {
        required: true,
      },
      state: {
        required: true,
      },
      city: {
        required: true,
      },
      address: {
        required: true,
      },
      
    },
    messages: {
      
      first_name: {
        required: "Please enter first name",
        maxlength: "Your first name maxlength should be 50 characters long."
      },
      last_name: {
        required: "Please enter last name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      verification_status: {
        required: "Please select verification status",
      },
      gender: {
        required: "Please select gender",
      },
      select_vehicle: {
        required: "Please select vehicle",
      },
       country: {
        required: "Please select country",
      },
      state: {
        required: "Please select state",
      },
      city: {
        required: "Please select city",
      },
      address: {
        required: "Please enter address",
      },
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  //edit staff
  $("form[name='editStaffForm']").validate({
    
    rules: {

      first_name: {
        required: true,
        maxlength: 50
      },
      last_name: {
        required: true,
        maxlength: 50
      },
      gender: {
        required: true,
      },
      country_code:{
        required: true,
        maxlength:2,
        number:true
      },
      mobile_number:{
        required: true,
        maxlength:9,
        number:true
      },
      email:{
        required: true,
        email:true,
      },
      
    },
    messages: {
      
      first_name: {
        required: "Please enter first name",
        maxlength: "Your first name maxlength should be 50 characters long."
      },
      last_name: {
        required: "Please enter last name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      gender: {
        required: "Please select gender",
      },
      country_code:{
            required: "Please enter country code",
            maxlength:"Your country code maxlength should be 2 number long.",
            number:"Country code should be numeric value.",
      },
      mobile_number:{
            required: "Please enter mobile number",
            maxlength:"Your mobile number maxlength should be 9 number long.",
            number:"Mobile number should be numeric value.",
      },
      email:{
            required: "Please enter email",
            email:"Please enter valid email",
      },

    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  

    // admin forgot password
    $("form[name='forgotPassForm']").validate({
    
    rules: {

      /*firstname: "required",
      lastname: "required",*/
      email: {
        required: true,
        email: true
      },
    },
    // Specify validation error messages
    messages: {
     
      email: {
        required: "Please enter email",
        email: "Please enter a valid email address"
      },
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });
  //change password
  $("#resetForgotPassForm").validate({
      rules: {
          verification_code:{
              required : true,
           },
          new_password: {
              required: true,
              maxlength: 20,
              minlength: 6
          },
          confirm_new_password: {
              required: true,
              maxlength: 20,
              equalTo: "#new_password"
          }
      },
      messages: {

        verification_code: {
              required: "Please enter password verification code.",

          },

          new_password: {
              required: "Please enter new password field.",

              maxlength: "New Password maxlength should be 20 character.",
              minlength: "New Password minlength should be 20 character"
          },

          confirm_new_password: {
              required: "Please enter confirm password field.",
              maxlength: "Confirm Password maxlength should be 20 character.",
              equalTo: "Confirm password should be equal to new password.",
          },

      },
//          
  });

  //change password
  $("#add_promocode_form").validate({
      rules: {
          promo_code:{
              required : true,
           },
          
          start_date:{
            required : true,
          },          
          end_date:{
            required : true,
          },
          type:{
            required : true,
          },
          value:{
            required : true,
          },
          check_amount:{
            required : true,
          },
          no_of_per_user:{
            required : true,
          },
          promo_code_for:{
            required : true,
          },               
      },
      messages: {

        promo_code: {
          
          required: "Please enter promo code.",

        },
        start_date: {
          
          required: "Please enter select date.",

        },
        end_date: {
          
          required: "Please select end date.",

        },
        type: {
          
          required: "Please select type.",

        },
        value: {
          
          required: "Please select value.",

        },
        check_amount: {
          
          required: "Please enter check amount.",

        },
        no_of_per_user: {
          
          required: "Please enter number of per user.",

        },
        promo_code_for: {
          
          required: "Please select promo code for.",

        }       
      },
//          
  });
  
  
  //add customer
  $("form[name='addPassengerFormRide']").validate({
    
    rules: {

      first_name: {
        required: true,
        maxlength: 50
      },
      last_name: {
        required: true,
        maxlength: 50
      },
      country_code: {
        required: true,
        maxlength: 4,
        number:true
      },
      mobile_number: {
        required: true,
        maxlength: 9,
        minlength:9,
        number:true
      },
    },
    messages: {
      
      first_name: {
        required: "Please enter first name",
        maxlength: "Your first name maxlength should be 50 characters long."
      },
      last_name: {
        required: "Please enter last name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      country_code: {
        required: "Please enter country code",
        maxlength: "Your country code maxlength should be 4 numeric value long.",
        numeric: "Please enter valid country code"
      },
      mobile_number: {
        required: "Please enter mobile number",
        number :"Please enter valid mobile number",
        maxlength: "Your mobile number maxlength should be 9 numeric value long.",
        minlength: "Your mobile number minlength should be 9 numeric value long.",
        
      },
      
    },
    
    submitHandler: function(form) {

      var customerUrl = "add-passanger";
      
      make_disable_enable('add','submit_add_pass','Please wait...');

      $.ajax({
            url: customerUrl,
            method:'POST',
            dataType: 'JSON',
            data:$("form").serialize(),
            headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(res){
                
              if (res.success == 1) {

                make_disable_enable('remove','submit_add_pass','Submit');

                $("#addPassengerModal").modal('hide');
                $("#addPassengerFormRide").find("input,textarea,select").val('').end();   
                
                $("#select_passenger").append('<option value ="'+res.userId+'" selected="selected">'+res.user_name+' ('+res.number+')</option>');
                swal({
                      title:'Success!',
                      text:res.msg,
                      timer:2000,
                      type:'success'
                    });
                $("#passengetId").val(res.userId);

              }else{

                //show validatiom msg
                  if(res.code == 401){

                    make_disable_enable('remove','submit_add_pass','Submit');

                     $("#addPassengerModal").modal('show');  
                    for(var key in res.result){
                    
                      $("#er_"+key).parent().find('.help-block').html(res.result[key]).show();
                    
                    }

                  }else{

                    swal({
                      title:'Oops!',
                      text:res.msg,
                      type:'error',
                      timer:2000
                    });
                  }
                
              }
            }  
      });
    }
  });

  $("form[name='AddaddressForm']").validate({
    
    rules: {

      full_name: {
        required: true,
        maxlength: 30
      },
      address_1: {
        
        required: true,
        maxlength: 100
      },
      address_2: {
        
        required: true,
        maxlength: 100
        
      },
      country: {        
        required: true,        
      },
      state: {        
        required: true,        
      },
      city: {        
        required: true,        
      },
      pincode: {        
        required: true,
        maxlength: 5        
      },
      contact_number: {        
        required: true,
        maxlength: 10,
        minlength:10        
      },
      timing: {
        
        required: true,
        
      },
     
      
    },
    messages: {
      
      full_name: {
        required: "Please enter full name",
        maxlength: "Your full name maxlength should be 30 characters long."
      },
      address_1: {
        required: "Please enter address 1",
        maxlength: "Your address 1 maxlength should be 30 characters long."
      },
      address_2: {
        required: "Please enter address 2",
        maxlength: "Your address 2 maxlength should be 30 characters long."
      },
      country: {
        
        required: "Please select country",
        
      },
      state: {
        
        required: "Please select state",
        
      },
      city: {
        
        required: "Please select city",
        
      },
      pincode: {
        
        required: "Please enter zipcode",
        maxlength: "Your zipcode maxlength should be 5 characters long."
        
      },
      contact_number: {
        
        required: "Please enter contact number",
        maxlength: "Your contact number maxlength should be 10 characters long.",
         maxlength: "Your contact number minlength should be 10 characters long."
        
      },
      timing: {
        
        required: "Please enter timing",
        
      },     
      
    },
    
    submitHandler: function(form) {

      var addressUrl = "add-customer-address";
      var customerId = $("#customerId").val();
      //alert(customerId);
      if(customerId != ""){

        $("#selectcustomermsg").css('display','none');
        $("#addAddressModal").modal('hide');

        $.ajax({
              url: addressUrl,
              method:'POST',
              dataType: 'JSON',
              data:$("form").serialize(),
              headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success: function(res){
                
                if (res.success == 1) {

                  $("#select_address").append('<option value="'+res.id+'" data-address = "'+res.address_1+' '+res.address_2+' '+res.country_name+' '+res.state_name+' '+res.city_name+','+res.pincode+'" data-name ="'+res.full_name+'" selected="selected">'+res.address_1+' '+res.address_2+' '+res.country_name+' '+res.state_name+' '+res.city_name+','+res.pincode+'</option>');
                   
                    $('#showFullAddress').html('');
                    $('#showFullName').html('');
                    $('#showFullName').html('<strong>Name:</strong> '+res.full_name);
                    $('#showFullAddress').html('<strong>Address:</strong> '+res.address_1+' '+res.address_2+' '+res.country_name+' '+res.state_name+' '+res.city_name+','+res.pincode); 

                   swal({
                      title:'Success!',
                      text:res.msg,
                      timer:2000,
                      type:'success'
                    });

                }else{

                  swal({
                      title:'Oops!',
                      text:res.msg,
                      type:'error',
                      timer:2000
                    });
                }
              }  
        });
      }else{

        //$("#addAddressModal").modal('show');
        $("#selectcustomermsg").css('display','block');
      }   
    }

  });

  // Add new ride by admin
   $("form[name='new_ride']").validate({

    rules: {

      select_passenger: {
        required: true,
        
      },
      select_driver:{
        required:true 
      },
      pickup_location:{
        required:true
      },
      dropoff_location:{
        required:true
      },
      esti_distance:{
        required:true
      },
      esti_time:{
        required:true
      },
      no_of_passenger:{
        required:true,
        number:true,
      },
      
    },
    messages: {
      
      select_passenger: {
        required: "Please select passenger",
        
      },
      select_driver: {
      
        required: "Please select driver",
        
      },
      pickup_location:{
        required: "Please enter pickup location",
      },
      dropoff_location:{
        required: "Please enter dropoff location",
      },
      esti_distance:{
        required: "Please enter estimated distance value",
      },
      esti_time:{

        required: "Please enter estimated distance time",
      },
      no_of_passenger:{

        required: "Please enter number of passenger",
        number:"Please enter numeric value",
      },
      
    },
    
    submitHandler: function(form) {

      //var noOfSeat      = $("#NoOfSeat").val();
      var noOfPassenger = $("#no_of_passenger").val();

        if(noOfPassenger){

          var url = "post-new-ride";
          make_disable_enable('add', 'submit_new_ride', 'Please wait...');
          $.ajax({
                url: url,
                method:'POST',
                dataType: 'JSON',
                data:$("form").serialize(),
                headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res){
                  make_disable_enable('remove', 'submit_new_ride', 'Submit');
                  if (res.success == 1) {

                      //window.location.href = "rides-list";
                      
                     
                     swal({
                        title:'Success!',
                        text:res.msg,
                        timer:2000,
                        type:'success'
                      });

                     if (res.success == 1) {
                        
                        setTimeout(function(){
                        window.location.href = "rides-list";
                        }, 1500);
                      }

                  }else{

                      swal({
                        title:'Oops!',
                        text:res.msg,
                        type:'error',
                        timer:2000
                      });
                  }
                }  
          });
        }else{

          swal({
                  title:'Oops!',
                  text:'Number of passenger should be less than equal to number of seat',
                  type:'error',
                  timer:5000
                });
        } 
        

    }

  });
   // edit Order
   $("form[name='edit_order_form']").validate({

      errorPlacement: function(error, element) {
          if (element.attr("name") == "select_customer") {
            element.parent().append(error);
          }
          else if(element.attr("name") == "select_address"){

            element.parent().append(error);
          } 
      },
    rules: {

      select_customer: {
        required: true,
        
      },
      select_address_type: {
        
        required: true,
      },
      select_address: {
        
        required: true,  
      },
      productArray: {        
        required: true,        
      },
      
    },
    messages: {
      
      select_customer: {
        required: "Please select customer",
        
      },
      select_address_type: {
        required: "Please select address type",
      },
      select_address: {
        required: "Please select address",
      },
      productArray: {
        
        required: "Please select atleast one product",
        
      },
      
    },
    
    submitHandler: function(form) {
      
      var productArray = $("#productArray").val();

      if(productArray == ""){

        swal({
              title:'Oops!',
              text:'Please select atleast one product.',
              timer:2000,
              type:'error'
            });

      }else{

        var orderId = $("#orderId").val();
        var postOrderUrl = "edit-order/"+orderId;
        $.ajax({
              url: postOrderUrl,
              method:'POST',
              dataType: 'JSON',
              data:$("form").serialize(),
              headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              success: function(res){
                
                if (res.success == 1) {

                    window.location.href = "order-list";
                   
                   swal({
                      title:'Success!',
                      text:res.msg,
                      timer:2000,
                      type:'success'
                    });

                }else{

                  swal({
                      title:'Oops!',
                      text:res.msg,
                      type:'error',
                      timer:2000
                    });
                }
              }  
        });
        
      }
      
    }

  });

 $("form[name='addressForm']").validate({
    
    rules: {

      full_name: {
        required: true,
        maxlength: 50
      },
      contact_number: {
        required: true,
        maxlength: 10,
        minlength:10,
        number:true
      },
      address_1: {
        required: true,
        maxlength: 50
      },
      address_2: {
        required: true,
        maxlength: 50,
       
      },
      pincode: {
        required: true,
        maxlength: 5
      },
      
      country: {
        required: true
      },
      state: {
        required: true,
       
      },
      city: {
        required: true,
      }
    },
    messages: {
      
      full_name: {
        required: "Please enter full name",
        maxlength: "Your full name maxlength should be 50 characters long."
      },
      contact_number: {
        required: "Please enter mobile number",
        number :"Please enter valid mobile number",
        maxlength: "Your mobile number maxlength should be 10 numeric value long.",
        minlength: "Your mobile number minlength should be 10 numeric value long.",
        
      },
      address_1: {
        required: "Please enter address 1",
        maxlength: "Your address 1 maxlength should be 50 characters long."
      },
      address_2: {
        required: "Please enter address 2",
        maxlength: "Your address 2 maxlength should be 50 characters long.",
      },
      
      pincode: {
        required: "Please enter pincode",
        minlength: "Your pincode must be at least 6 numeric value"
      },
      country: {
        required: "Please select country",
      },
      state: {
        required: "Please select state",
      },
      city: {
        required: "Please select city",
      },
    }, 
   submitHandler: function(form) {
      form.submit();
    }
  });    

});


//add brand
  $("form[name='AddBrandForm']").validate({
    
    rules: {

      name: {
        required: true,
        maxlength: 100,

      },
      
    },
    messages: {
      
      name: {
        required: "Please enter first name",
        maxlength: "Your title maxlength should be 100 characters long."
      },
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  //add brand
  $("form[name='AddVoucherForm']").validate({
    
    rules: {

      price: {
        required: true,
      },
      wallet_point: {
        required: true,
      },
      description : {
        required : true,
      },
      card_type : {
        required : true,
      }
      
    },
    messages: {
      
      price: {
        required: "Please enter price",
      },
      wallet_point : {
        required : "Please enter wallet point",
      },
      description : {
        required : "Please enter description",
      },
      card_type : {
        required : "Please select card type"
      }
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  //Note Add Form
  $("form[name='AddnoteForm']").validate({
    rules:{
        title:{
          required:true,
        },
        message:{
          required:true,
        },
        'users[]':{
          required:true,
        },
        remind_date:{
          required:true,
        },
        
         
    },
      messages:{
            title:{
              required:"Please enter title",      
            },
            remind_date:{
              required:"Please select Date",
            },
            'users[]': {
              required : 'The Select users field is required',
            },
            message:{
              required:"Please enter message",
            },              
         },

         errorPlacement: function(error, element){
       if(element.attr("name") == "users[]") {error.appendTo( element.next() );
       }
       else {
        error.insertAfter(element);}
      },

      submitHandler:function(form){
        form.submit();
      }
  }); 


//Note Edit Form
  $("form[name='EditnoteForm']").validate({
    rules:{
        title:{
          required:true,
        },
        message:{
          required:true,
        },
        'users[]':{
          required:true,
        },
        remind_date:{
          required:true,
        },
        
         
    },
         messages:{
              title:{
               required:"Please enter title",      
               },
              remind_date:{
                required:"Please select Date",
               },
               'users[]':{
                required:'The Select users field is required ',
               },
               message:{
                required:"Please enter message",
               },              
         },

         errorPlacement: function(error, element){
       if(element.attr("name") == "users[]") {error.appendTo( element.next() );
       }
       else {
        error.insertAfter(element);}
      },

      submitHandler:function(form){
        form.submit();
      }
  });

  //Reminder Add Form
  $("form[name='AddreminderForm']").validate({
    rules:{
        title:{
          required:true,
        },
        message:{
          required:true,
        },
        'users[]':{
          required:true,
        },
        remind_date_time:{
          required:true,
        },
        
         
    },
      messages:{
            title:{
              required:"Please enter title",      
            },
            remind_date_time:{
              required:"Please select reminder date time",
            },
            'users[]': {
              required : 'The Select users field is required',
            },
            message:{
              required:"Please enter message",
            },              
         },

         errorPlacement: function(error, element){
       if(element.attr("name") == "users[]") {error.appendTo( element.next() );
       }
       else {
        error.insertAfter(element);}
      },

      submitHandler:function(form){
        form.submit();
      }
  }); 


//Reminder Edit Form
  $("form[name='EditreminderForm']").validate({
    rules:{
        title:{
          required:true,
        },
        message:{
          required:true,
        },
        'users[]':{
          required:true,
        },
        remind_date_time:{
          required:true,
        },
        
         
    },
         messages:{
              title:{
               required:"Please enter title",      
               },
              remind_date_time:{
                required:"Please select reminder date time",
               },
               'users[]':{
                required:'The Select users field is required ',
               },
               message:{
                required:"Please enter message",
               },              
         },

         errorPlacement: function(error, element){
       if(element.attr("name") == "users[]") {error.appendTo( element.next() );
       }
       else {
        error.insertAfter(element);}
      },

      submitHandler:function(form){
        form.submit();
      }
  });

  //add vehicle brand
  $("form[name='AddModelForm']").validate({
    
    rules: {

      brand_name: {
        required: true,
      },
      name: {
        required: true,
        maxlength: 100,

      },
      
    },
    messages: {
      
      brand_name: {
        required: "Please select brand",
      },
      name: {
        required: "Please enter first name",
        maxlength: "Your title maxlength should be 100 characters long."
      },
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

      //add Promocode 
  
  $("form[name='AddpromocodeForm']").validate({
    rules:{
        promocode:{
          required:true,
          
        },
         start_date:{
          required:true,
        },
        end_date:{
          required:true,
        },
        type:{
          required:true,
        },
        value:{
          required:true,
          
        },
        no_of_users:{
          required:true,
          digits:true,
        },
    },
         messages:{
              promocode:{
               required:"Please select promocode",
            
               },
               start_date:{
                required:"Please select start Date",
               },
               end_date:{
                required:"Please select end Date",
               },
               type:{
                required:"Please select type ",
               },
               value:{
                required:"Please select value",
                
               },
               no_of_users:{
                required:"Please select no. of users",
                digits:"Only number value allow",
               },
        },

      submitHandler:function(form){
        form.submit();
      }
  });

  /*edit promocode*/
  $("form[name='editpromocodeForm']").validate({
    rules:{
        promocode:{
          required:true,
           maxlength: 10,
        },
        start_date:{
          required:true,
        },
        end_date:{
          required:true,
        },
        type:{
          required:true,
        },
        value:{
          required:true,
          digits: true,
          
        },
         
    },
         messages:{
              promocode:{
               required:"Please select promocode",
               maxlength:"maximum length 10 characters Only.",
               },
              start_date:{
                required:"Please select start Date",
               },
               end_date:{
                required:"Please select end Date",
               },
               type:{
                required:"Please select type ",
               },
               value:{
                required:"Please select value",
                number:"Only number value allow",
              },
               
         },


      


      submitHandler:function(form){
        form.submit();
      }
  });

/*birthdayreminderForm*/
  $("form[name='birthdayreminderForm']").validate({
    rules:{
        title:{
          required:true,
        },
        message:{
          required:true,
        },
        time:{
          required:true,
        },
        
         
    },
         messages:{
              title:{
               required:"Please enter title",      
               },
              time:{
                required:"Please select Time",
               },
               message:{
                required:"Please enter message",
               },
               
                        
         },

      submitHandler:function(form){
        form.submit();
      }
  });

/*App info*/
$("form[name='appinfo_form']").validate({
    rules:{
        contact_number:{
          required:true,
           maxlength: 10,
           minlength:10,
           number:true,
           
          
        },
         email:{
           required: true,
           email: true
        },
        address:{
          required:true,
        },
        web_url:{
          required:true,
          url: true,
        }
        
    },
         messages:{
              contact_number:{
               required:"Please Enter Contact Numer.",
                maxlength:"Please Enter valid Numer.",
                number:"This is not valid contact number.",
                minlength:"Please Enter valid Numer."            
               },

               email:{
                required:"Plese Enter Email Id",
                email:"Enter Valid Email Id.",
               },
               address:{
                required:"Please Enter Address.",
               },
               web_url:{
                required:"Please Enter Web Url.",
                url:"Enter Valid Web Url.",
               },
               
        },

      submitHandler:function(form){
        form.submit();
      }
  });
/*App Version Form*/
/*$("form[name='app_version_form']").validate({
  rules:{
    android_version:{
      required:true,
    },
    android_url:{
      required:true,
      url:true,

    }

  },
  messages:{
    android_version:{
        required:"Please Enter Android Version.",
    },
    android_url:{
      required:"Please Enter Android Url."
      url:"Please Enter V"
    }
},
  submitHandler:function(form){
    form.submit();
  }
});
*/
  //add vehicle
  $("form[name='AddVehicleForm']").validate({
    
    rules: {

      name: {
        required: true,
        maxlength: 50
      },
      service_type: {
        required: true,

      },
      select_brand: {
        required: true,
      },
      select_model: {
        required: true,
      },
      manufacturer: {
        required: true,
        maxlength: 100,
      },
      vehicle_number: {
        required: true,
       
      },
      insurance_no: {
        required: true,
      },
      insurance_expiry_date: {
        required: true,
      },
      luggage_capacity: {
        required: true,
      },
      max_passenger:{
        required: true,

      },     
    },
    messages: {

      name: {
        required: "Please enter name",
        maxlength: "Your name maxlength should be 50 characters long"
      },
      service_type: {
        required: "Please select service type",
        
      },
      select_brand: {
        required: "Please select brand",
        
      },
      select_model: {
        required: "Please select model",
       
      },
      manufacturer: {
        required: "Please enter manufacturer",
        maxlength: "Your manufacturer maxlength should be 100 characters long"
      },
      vehicle_number: {
        required: "Please enter vehicle number",
        
      },
      insurance_no: {
        required: "Please enter insurance number",
      },
      insurance_expiry_date: {
        required: "Please enter inssurance expiry date",
      },
      luggage_capacity: {
        required: "Please enter luggage capacity",
      },
      max_passenger:{
        required:"Plese enter maximum passenger",
      },
      
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });


 //add configuration
  $("form[name='AddConfigurationForm']").validate({
    
    rules: {

      title: {
        required: true,
        maxlength: 100
      },
      value: {
        required: true,
        maxlength: 250

      },
      
     
    },
    messages: {
      
      title: {
        required: "Please enter title",
        maxlength: "Your title maxlength should be 100 characters long"
      },
      value: {
        required: "Please enter value",
        maxlength: "Your value maxlength should be 250 characters long"
      },
         
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  $("form[name='rental_packages_form']").validate({
    
    rules: {

      time:{
        required:true,
        digits: true,
      },
      distance:{
        required:true,
        number: true,
      },
      charges:{
        required:true,
        number: true,
      },            

           
    },
    messages: {
      time:{
        required:"Plese enter time in minutes",
        digits:"Plese enter only digits.",
      },
      distance:{
        required:"Plese enter distance in Km",
        number:"Please enter a valid number",

      },
      charges:{
        required:"Plese enter charges",
        number:"Please enter a valid number",
      },      
        

    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

  $("form[name='editInsuranceForm']").validate({
    
    rules: {

      /*insurance_no: {
        required: true,
      },*/
      insurance_expiry_date: {
        required: true,
      },
      select_status: {
        required: true
      },
      
     
    },
    messages: {
      
      /*insurance_no: {
        required: "Please enter insurance no",
      },*/
      insurance_expiry_date: {
        required: "Please select insurance expiry date",
      },
      select_status: {
        required: "Please select insurance status"
      },
         
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

   $("form[name='editBillingInfoForm']").validate({
    
    rules: {

      ruc_number: {
        required: true,
      },
      sol_password: {
        required: true,
      },
      clave_sol: {
        required: true,
      },
      bank_name:{
        required:true,
      },
      account:{
        required:true,
      },
      inter_banking_acc_no: {
        required : true,
      },
      select_status: {
        required: true,
      },
         
    },
    messages: {
      
      ruc_number: {
        required: "Please enter ruc number",
      },
      sol_password: {
        required: "Please enter sol password",
      },
      clave_sol: {
        required: "Please enter clave sol"
      },
      bank_name: {
        required: "Please enter bank name"
      },
      account: {
        required: "Please enter account"
      },
      inter_banking_acc_no: {
        required: "Please enter banking acc no"
      },
      select_status: {
        required: "Please select billing info status"
      }
      

         
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });

   $("form[name='editLicenseForm']").validate({
    
    rules: {

      license_number: {
        required: true,
      },
      vehicle_type: {
        required: true,
      },
      issued_on: {
        required: true,
      },
      expiry_date:{
        required:true,
      },
      select_status: {
        required : true,
      }
         
    },
    messages: {
      
      license_number: {
        required: "Please enter license number",
      },
      vehicle_type: {
        required: "Please enter category",
      },
      issued_on: {
        required: "Please select issued_on date"
      },
      expiry_date: {
        required: "Please select expiry_date "
      },
      select_status: {
        required: "Please select license status"
      }
         
    },
    
    submitHandler: function(form) {
      form.submit();
    }

  });

 $("form[name='editVehicleForm']").validate({
    
    rules: {

      name: {
        required: true,
        maxlength: 50
      },
      service_type: {
        required: true,

      },
      select_brand: {
        required: true,
      },
      select_model: {
        required: true,
      },
      manufacturer: {
        required: true,
        maxlength: 100,
      },
      vehicle_number: {
        required: true,
       
      },
      luggage_capacity: {
        required: true,
      },
      max_passenger:{
        required: true,
      },
      select_status: {
        required: true,
      },     
    },
    messages: {

      name: {
        required: "Please enter name",
        maxlength: "Your name maxlength should be 50 characters long"
      },
      service_type: {
        required: "Please select service type",
        
      },
      select_brand: {
        required: "Please select brand",
        
      },
      select_model: {
        required: "Please select model",
       
      },
      manufacturer: {
        required: "Please enter manufacturer",
        maxlength: "Your manufacturer maxlength should be 100 characters long"
      },
      vehicle_number: {
        required: "Please enter vehicle number",
        
      },
      luggage_capacity: {
        required: "Please enter luggage capacity",
      },
      max_passenger:{
        required:"Plese enter maximum passenger",
      },
      select_status: {
        required: "Please select vehicle status",
      },
      
    },
    
    submitHandler: function(form) {
      form.submit();
    }
  });  