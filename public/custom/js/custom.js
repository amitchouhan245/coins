       /*
* Name: custom js
* Create Date: 7 Dec 2017
* Created By: Harishankar Dwivedi
*/


//delete functionality



function remove_record(url, rowid)
{
    swal({
              
		title: 'Are you sure?',
		text: "you want to delete this record",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Delete!'

		}).then(function () {
		$('#row-' + rowid).addClass('relative-pos spinning');
		url = SITEURL + url;
		$.ajax
	    ({
	        url: url,
	        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	        success: function (res)
	        {
	            var obj = JSON.parse(res);
	            console.log(obj);
	            if (obj.success == 1) {

	                 swal({
	                    title:'Success!',
	                    text:obj.msg,
	                    timer:2000,
	                    type:'success'
	                  });
	                 if(obj.ref == 'ref'){
	                	setTimeout(function(){
						  //location.reload();
						}, 1500);
	                }
	                 datatable.draw();
	                $('#row-' + rowid).css({'background-color': 'red'});
	                $('#row-' + rowid).fadeOut('slow');    
	            } else {
	                swal({
	                    title:'Oops!',
	                    text:obj.msg,
	                    type:'error',
	                    timer:4000
	                  });
	                $('#row-' + rowid).css({'background-color': 'white'});
	                /*$('#error_msg_section').html('<div class="alert alert-danger" id="success-alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong>Fail!</strong>' + obj.msg + '</div>');
	                window.setTimeout(function () {
	                    $("#success-alert").fadeTo(3000, 0).slideUp(100, function () {});
	                }, 3000);*/
	            }
	        }
	    });
    });
    return false;
}

//status activity message
$(document).ready(function () {

    $(document).on('click','.change_status', function (e) {
    	
        urlval = $(e.target).attr("href");
        make = $(e.target).data("make");
        e.preventDefault();
        swal({
            title: 'Confirmation',
            text: "Are you sure you want to "+make+" this record?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true,
            //showLoaderOnConfirm :true
        }).then(() => window.location.href = urlval)//window.location.href = urlval);
    });

});    

$(document).ready(function () {

    $(document).on('click','.cancel_ride', function (e) {
    	
        urlval = $(e.target).attr("href");
        e.preventDefault();
        swal({
            title: 'Confirmation',
            text: "Are you sure you want to cancel this ride?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No",
            //showLoaderOnConfirm :true
        }).then(() => window.location.href = urlval);
    });

});  
  
$(document).ready(function () {

    $(document).on('click','.delivered_order', function (e) {
    	
        urlval = $(e.target).attr("href");
        e.preventDefault();
        swal({
            title: 'Confirmation',
            text: "Are you sure you want to delivered this order?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true,
            //showLoaderOnConfirm :true
        }).then(() => window.location.href = urlval);
    });

});  

	
function select_country(){
	
	var countryId = $("#country").val();
	$.ajax({
		url  : SITEURL + 'admin/get-state',
		data : { "country_id" : countryId },
		dataType : "JSON",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success : function (res){
			
			$("#state").html(res.html);
		}

	})
}

function select_state(){

	var stateid = $("#state").val();
	
	$.ajax({
		url  : SITEURL + 'admin/get-city',
		data : { "state_id" : stateid },
		dataType : "JSON",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success : function (res){
			
			$("#city").html(res.html);
		}

	})
}
/**********************for get-profile update in web******/
/*function selectCountry(){ 
	
	var countryId = $("#country").val();alert("countryId");
	$.ajax({
		url  : SITEURL + 'web/get-state',
		data : { "country_id" : countryId },
		dataType : "JSON",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success : function (res){
			
			$("#state").html(res.html);
		}

	})
}

function selectState(){

	var stateid = $("#state").val();
	
	$.ajax({
		url  : SITEURL + 'web/get-city',
		data : { "state_id" : stateid },
		dataType : "JSON",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success : function (res){
			
			$("#city").html(res.html);
		}

	})
}  */

/*
* Name: remove_from_array
* Create Date: 29 Jan 2018
* Created By: Pankaj Gawande
* Purpose: This function is used to remove element from array 
*/

function remove_from_array(array, element) {
  
  const arrayIndex = array.indexOf(element);
  
  array.splice(arrayIndex, 1);

}	

/*
* Name: make_disable_enable
* Create Date: 23 Jan 2018
* Created By: Pankaj Gawande
* Purpose: This function is used to enable/disabled buttons. 
*/

function make_disable_enable(type, id, text){

  if (type == 'add') {

    if (id != "") {

      $("#"+id).addClass('disabled');
    
    }
    
    if (text != "") {

      $("#"+id).html(text + '<i class="fa fa-spinner fa-spin"></i>');
    
    }

  }else{

    if (id != "") {

      $("#"+id).removeClass('disabled');
    
    }

    if (text != "") {

      $("#"+id).html(text);
    
    }

  }
}

/*
*
*/

function restore_element(url, rowid){

    swal({
              
		title: 'Are you sure?',
		text: "you want to restore this record",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, Restore!'

		}).then(function () {
		
		$('#row-' + rowid).addClass('relative-pos spinning');
		
		url = SITEURL + url;
		
		$.ajax({
	        
	        url: url,
	        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	        dataType: 'JSON',
	        success: function (res){
	            	            
	            if (res.success == 1) {

	                swal({
	                    title:'Success!',
	                    text:res.msg,
	                    timer:2000,
	                    type:'success'
	                });
	                
                	setTimeout(function(){
					  
					  //location.reload();
					
					}, 1500);
	                
	                datatable.draw();
	                
	                $('#row-' + rowid).css({'background-color': 'red'});
	                $('#row-' + rowid).fadeOut('slow');    
	            
	            }else{
	            
	                swal({
	                    title:'Oops!',
	                    text:res.msg,
	                    type:'error',
	                    timer:4000
	                });
	                
	                $('#row-' + rowid).css({'background-color': 'white'});
	            }
	        }
	    });
    });
		
    return false;
}

$(document).ready(function(){
		setTimeout(function(){
		  $(".manage_drop_d").parent().each(function(){
			var tbl_hght = $(this).parents(".dataTables_wrapper").height();
			var tbl_topos = $(this).parents(".dataTables_wrapper").offset().top;
	
			var drp_postop = $(this).offset().top;
			var drp_hght = $(this).find(".dropdown-menu").height();
	
			$(this).find(".dropdown-toggle").click(function(){
		
			  var yoyo = tbl_hght - drp_postop+drp_hght;
			  //alert(tbl_topos-drp_postop +" , "+ drp_hght);
		
			  if(tbl_hght < drp_hght+drp_postop){
				$(".dropdown").addClass("dropup");
			  }else{
				$(".dropdown").removeClass("dropup");
			  }
			 
			});
		  });
		},500);
	});

function SetSession(userInfo, user_redirect_url){
    
  var url = SITEURL+'web/set-session';

  $.ajax({
        url: url,
        method:'GET',
        dataType: 'JSON',
        data:{ 'user_info': userInfo },
        headers  : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(res){
          
          if(res.success == 1){
            
            if(res.mobile_status == "Verified"){
              
              var redirect_url = "";
              
              if (USER_REDIRECT_URL != "") {

                var redirect_url = USER_REDIRECT_URL;

              }else if(user_redirect_url != undefined && user_redirect_url != ""){
                
                var redirect_url = user_redirect_url;                
              }
              
              if (redirect_url != "") {

                window.location.href = redirect_url;

              }else{

                window.location.href = SITEURL+'ride-now';
              }

            }else{

              var userId = userInfo.id;

               window.location.href = SITEURL+'web/mobile-verification/'+userId;
            }
          }else{
 
              //make_disable_enable('add', 'sign_in', 'Redirecting...');
              swal({
                    title:'Oops!',
                    text:"Please login again",
                    type:'error',
                    timer:2000
                  });
          }
          
          
        }  
  });

}

function driver_info_update(value, type, id){
	
	if(value == 2){
		
		var showStatus = "approve";
	
	}else if(value == 3){

		var showStatus = "reject";
	}

	if(type == 'Vehicle'){
		var showtype = 'vehicle';
	
	}else if(type == 'Insurance'){
		var showtype = 'insurance';
	
	}else if(type == 'BillingInfo'){
		var showtype = 'billing info';
	
	}else if(type == 'License'){
		var showtype = 'license';
	}

	swal({
              
		title: 'Are you sure?',
		text: " You want to "+showStatus+" this "+showtype+"",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes!'

		}).then(function () {

		$.ajax({
		
		    url  : SITEURL + 'admin/driver-info-update',
		    method: 'POST',
		    data : { "status" : value, "type": type, "id": id },
		    dataType : "JSON",
		    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		    success: function(res) {            

		      if (res.success == true) {

		       $('#table').DataTable().ajax.reload();
		            
		       swal({

		       	title: 'Great!',
		        text: res.message,        
		        type: "success",
		        timer: 2000,

		       });

		      }else{

		      	swal({
			        
			        title: "Oops!",
			        text: res.message,        
			        type: "warning",
			        timer: 2000,
			    });

		      }
		      
		                  
		    }

		});
	});	
}

/*
* Name: make_disable_enable
* Create Date: 13 July 2018
* Created By: Pankaj Gawande
* Purpose: This function is used to enable/disabled buttons. 
*/

function med(type, id, text=""){
  
  if (type == 'add') {

    if (id != "") {

      $("#"+id).attr('disabled', true);
    
    }
    
    if (text === "") {

      text = "Please Wait..";    
    }
    
    $("#"+id).html(text + '<i class="la la-spinner spinner"></i>');

  }else{

    if (id != "") {

      $("#"+id).attr('disabled', false);
          
    }

    if (text != "") {

      $("#"+id).html(text);
    
    }

  }
}

function ajax_error(error,btnId, btnText){

  swal("Opps!",error.responseJSON.message, "error");

   med('remove', btnId, btnText);


}

function ajax_success(res, url=false, btnId, btnText=""){
	console.log(res.code);
  if (res.code === 259) {

    url = APP_URL + 'login';

  }else if(res.code === 401){

    url     = false;
    btnText = "Submit";
    
    for(var key in res.errors){                            
      
      $('input[name="'+ key +'"]').after('<span class="error">'+res.errors[key]+'</span>');
      
    }

  }else if (res.code === 200) {

    swal("Great!",res.msg, "success");  
  
  }else if(res.code === 400){
  	console.log('fgf');
    swal("Oops!",res.msg, "warning");  
  }
  
  if (url) {

    med('add', btnId, 'Redirecting..');    

    setTimeout(function(){ 
     
      window.location.href = url;

    }, 2000);
  
  }else{

    med('remove', btnId, btnText);
  
  }  
  
}