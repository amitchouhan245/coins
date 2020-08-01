@extends('Admin.layout.master')

@section('content')

<div class="app-content content">
   <div class="content-wrapper ">
      <div class="content-header row">
         <div class="content-header-left col-md-6 col-12 mb-2">
            <h3 class="content-header-title"><i class="icon-bell"></i> {{ $title }}</h3>
            <div class="row breadcrumbs-top">
             <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{$app_url.'dashboard'}}">Dashboard</a>
                </li>
                 <li class="breadcrumb-item"><a href="{{$app_url.'notifications'}}">Notification</a>
                </li>
                <li class="breadcrumb-item active"><a href="#">{{ $title }}</a>
                </li>
              </ol>
            </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <section id="basic-form-layouts">
            <div class="row match-height">
               <div class="col-md-2"></div>
               <div class="col-md-8">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">{{ $title }}</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>           
                     </div>
                     <div class="card-content collapse show">
                        <div class="card-body">
                           <form class="form" id="sendNotification" method="">
                              <div class="form-body">
                                 <h4 class="form-section"><i class="icon-bell"></i> Notification Info</h4>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for='School'>Title<i class="error"><strong>*</strong></i></label>
                                          <input type="text" placeholder="Title" class="form-control"  name="title" id="title">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for='School'>Message<i class="error"><strong>*</strong></i></label>
                                          <textarea class="form-control" placeholder="Enter Message here" id="message" name="message"></textarea>
                                       </div>
                                    </div>

                                   <div class="col-md-12">
                                    <div class="custom-file">
                                      <label for="profile_image">Image  <i class="error"><strong>( JPEG ,JPG or PNG format )</strong></i></label>
                                      <br>
                                      <input class="form-control" type="file" id="image"  name="image">
                                    </div>
                                  </div>

                                 </div>
                                 <div class="row" style="height: 30px;">
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="row">
                                          <div class="col-md-1">
                                             <div class="form-group">
                                                <input type="radio" class="form-control" name="choose_all" id="all_user" value="all_user">
                                             </div>
                                          </div>
                                          <div class="col-md-11">
                                             <div class="form-group">
                                                <label for='All'>All<i class="error"></i></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="row">
                                          <div class="col-md-1">
                                             <div class="form-group">
                                                <input type="radio" class="form-control" name="choose_all" id="all_drivers" value="all_drivers">
                                             </div>
                                          </div>
                                          <div class="col-md-11">
                                             <div class="form-group">
                                                <label for='All'>All Drivers<i class="error"></i></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="row">
                                          <div class="col-md-1">
                                             <div class="form-group">
                                                <input type="radio" class="form-control" name="choose_all" id="all_passenger" value="all_passenger">
                                             </div>
                                          </div>
                                          <div class="col-md-11">
                                             <div class="form-group">
                                                <label for='All'>All Passengers<i class="error"></i></label>
                                             </div>
                                          </div>
                                        
                                       </div>
                                    </div>
                                      <div class="col-md-12">
                                       <div class="row">
                                          <div class="col-md-1">
                                             <div class="form-group">
                                                <input type="radio" class="form-control" name="choose_all" id="choose_below">
                                             </div>
                                          </div>
                                          <div class="col-md-11">
                                             <div class="form-group">
                                                <label for='All'>Select from below<i class="error"></i></label>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>                                 	
                                 <div  id="select_box" >
                                   <div class="col-md-12">
                                    <div class="form-group">
                                    <label for='School'>Select From Here<i class="error"><strong>*</strong></i></label>
                                     <select id="select_user" class="select2 form-control" multiple="multiple" name="selected_users[]" >
                                 </select>
                                 </div>
                              </div>
                            </div>
                          
                        <div class="form-actions" align="right">
                        <a href="{{$app_url.'notifications'}}" class="btn btn-danger mr-1">
                        <i class="ft-x"></i> Cancel</a>
                        <button type="submit" title="Submit" id="submit" class="btn btn-info">
                        <i class="la la-check-square-o"></i> Submit
                        </button>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div> 
      </section>
   </div>
</div>
</div>
@endsection
@section('script')

<script type="text/javascript">

   $(document).ready(function(){

     $('#sendNotification').validate({ 
   
     rules: {

           title:{
   
             required : true
           
           },

           message:{
             
             required : true
   
           },               
     },
      messages: {
  
           title: {
            
             required: "Please enter title."
   
           },
           message: {
            
             required: "Please enter message."
   
           },
      },
   
      errorPlacement: function(error, element){
   
           if(element.attr("name") == "school_id"){
   
               error.appendTo( element.next() );
   
           }else{
   
               error.insertAfter(element);
          }
     }, 
   
      
     submitHandler: function(form) { 

      var selectedUser = $('#select_user').val();

      if (document.getElementById("choose_below").checked == true) {

        if( selectedUser == "" ){

          swal("Please select user", { 

            icon: "warning", 
            timer: 5000,
            button:true

          });

        }
        else{
  
        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        med('add', btnId); 
        var params = $('#sendNotification').serializeArray();
        var imagevalue = document.getElementById("image").files[0];    

        var values = $("input[name='selected_users[]']")
              .map(function(){return $(this).val();}).get();
              
          params.push({name: 'select_by_user', value: values});
          
          params.push({name: 'image', value: imagevalue});
        
        var files = $("#image")[0].files[0];

        var formData = new FormData();

        formData.append('image', document.getElementById("image").files[0]);

        $.each(params,function (key, input) {

            formData.append(input.name, input.value);

        });

          $.ajax({
   
               url: SITEURL + 'admin/send-notification-to-user', 
               type: 'POST',  
               data: formData,
               headers  : headers,
               cache: false,
               contentType: false,
               processData: false, 

               success: function(res) {
                 
                 ajax_success(res, '{{ $app_url.'notifications' }}', btnId, btnText);

               },
               error: function(error){
                 
                  ajax_error(error, btnId, btnText);
                               
               }       
         	
         	});

         }
        }else{

            
        let btnText = '<i class="la la-check-square-o"></i> Add';
        let btnId   = 'submit';
        med('add', btnId); 
        var params = $('#sendNotification').serializeArray();
        var imagevalue = document.getElementById("image").files[0];    

        var values = $("input[name='selected_users[]']")
              .map(function(){return $(this).val();}).get();
       
        params.push({name: 'select_by_user', value: values});

        params.push({name: 'image', value: imagevalue});
        
        var files = $("#image")[0].files[0];

        var formData = new FormData();

        formData.append('image', document.getElementById("image").files[0]);

        $.each(params,function (key, input) {

            formData.append(input.name, input.value);

        });
             
          $.ajax({
   
               url: SITEURL + 'admin/send-notification-to-user', 
               type: 'POST',  
               data: formData,
               headers  : headers, 
               cache: false,
               contentType: false,
               processData: false,
               
               success: function(res) {
                   
                   ajax_success(res, '{{ $app_url.'notifications' }}', btnId, btnText);
               },
               error: function(error){
                 
                   ajax_error(error, btnId, btnText);
                               
               }       
     
         });

        }

   
       }   
   
     }); 
   
   });
   

function check() {

    document.getElementById("choose_below").checked = true;
}
check();

   function get_all_users(id){   
   
   var SchoolId = $("#school_id").val();
   var UserId   = $("#user_id").val();
   
   $.ajax({
   
        url  : SITEURL + "admin/user-list",
        data : { school_id: SchoolId , user_id: UserId },
        dataType : "JSON",
        headers: headers,   
 
               
        success : function (res){
         
            if (res.code === 200) {

               var options1 = '';
               var options2 = '';
               var optiong  = '';
              
                for (var i = 0; i < res.result.length; i++) {

                  if(res.result[i].user_type == 2){
                    
                    options1 = options1 + '<option value="'+res.result[i].id+'">'
                                          +res.result[i].name+' ( '+res.result[i].email+' )  </option>';
                  } 

                   else if(res.result[i].user_type == 3){
                    
                    options2 = options2 + '<option value="'+res.result[i].id+'">'
                                          +res.result[i].name+' ( '+res.result[i].email+ ' ) </option>';
                  }

                }
               optiong = optiong + '<optgroup label="Passengers">'+options1+'</optgroup>'+
                                  '<optgroup label="Drivers">'+options2+'</optgroup>';          
   
             }
               $("#select_user").html(optiong);
               
         },
           error: function(error) {

               $("#select_user").html('<option value="">Users not found</option>');
   
           }
   
       }) 
   }
   
   get_all_users();

   $('input[name=choose_all]').click(function (){

    if (this.id == "choose_below") {

        $("#select_box").show('fast');

    } else {

        $("#select_box").hide('slow');
    }
});
</script>
@endsection

