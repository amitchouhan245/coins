var email_expr = /^[A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4}(?:(?:[,;][A-Z0-9\._%-]+@[A-Z0-9\.-]+))?$/i;
var numeric_expr = /^[0-9]+$/;
var float_expr = /^[0-9\.]+$/;
var numericWithDash = /^[0-9\-]+$/;
var numericWithComma =/^[0-9\.\,]+$/;
var alphaExp = /^[0-9a-zA-Z- ]+$/;
var numericWithPlus = /^[0-9\+]+$/;
var paswd =  /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/;
var alphabatic = /^[ a-zA-Z ]+$/;
var arabic_numbers = /^[\u0660-\u0669]+$/;
var arabic_phone = /^5[\d]*$/;


var latlong_expr = /^[0-9\-.]+$/;
var webExpr =/(http(s)?:\\)?([\w-]+\.)+[\w-]+[.com|.in|.org]+(\[\?%&=]*)?/;
var date_expr = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);

var valid = {
	
required : function(f, m){
var v = $('#'+f).val();

if (v == null) {

	v = '';
}

//v = v.trim()
$('#'+f).val(v)

if(v == '')
{
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' field is required.</label>');
$("#"+f).parents('.form-group').addClass('has-error');
return false;
}else{
$('#er_'+f).html('');
$("#"+f).parents('.form-group').removeClass('has-error');
return true;
}
},


imageRequired : function(f, m){
var v = $('#'+f).val();
if(v == '')
{
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' field is required.</label>');
$("#"+f).parents('.form-group').addClass('has-error');
return false;
}else{
$('#er_'+f).html('');
$("#"+f).parents('.form-group').removeClass('has-error');
return true;
}
},

dateRequired : function(f, m){
var v = $('#'+f).val();
if(v == '')
{
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' field is required.</label>');
$("#"+f).parents('.form-group').addClass('has-error');
return false;
}else{
$('#er_'+f).html('');
$("#"+f).parents('.form-group').removeClass('has-error');
return true;
}
},

check_box_required : function(f, m){

 var checkboxes = document.getElementById(f);

if(!checkboxes.checked) 
{
	$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' field is required.</label>');
	return false;
	}
	else
	{
	$('#er_'+f).html('');
	return true;	
}	




},

email : function(f,m){
var v = $('#'+f).val();
v = v.trim()
$('#'+f).val(v)
if(email_expr.test(v) == false){
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+ m +' field must contain a valid email address.</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
},
strongPassword : function(f,m){
var v = $('#'+f).val();
v = v.trim()
$('#'+f).val(v)
if(paswd.test(v) == false){
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+ m +' field must contains atleast one number and one character.</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
},
numeric : function(f,m){
	var v = $('#'+f).val();
	$('#er_'+f).html('');
	v = v.trim()
	$('#'+f).val(v)
	if(v != ''){
			if(numeric_expr.test(v) == false){
				
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' must contain only numeric value.</label>');
				$("#"+f).parents('.form-group').addClass('has-error');
				return false;
			}else{
				$('#er_'+f).html('');
				$("#"+f).parents('.form-group').removeClass('has-error');
				return true;
			}
		}
	},
	
numericWithComma : function(f,m){
	var v = $('#'+f).val();
	$('#er_'+f).html('');
	$('#'+f).val(v)
	
	if(v != ''){
			
			if(numericWithComma.test(v) == false){
				
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' must contain only numeric value.</label>');
				$("#"+f).parents('.form-group').addClass('has-error');
				return false;
			}else{
				$('#er_'+f).html('');
				$("#"+f).parents('.form-group').removeClass('has-error');
				return true;
			}
		}
	},	
	
	
latlong : function(f,m){
	var v = $('#'+f).val();
	$('#er_'+f).html('');
	if(v != ''){
			if(latlong_expr.test(v) == false){
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' must contain only numeric value.</label>');
				return false;
			}else{
				$('#er_'+f).html('');
				return true;
			}
		}
	},
floats : function(f,m){
	var v = $('#'+f).val();
	$('#er_'+f).html('');
	if(v != ''){
			if(float_expr.test(v) == false){
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' must contain only numeric value.</label>');
				$("#"+f).parents('.form-group').addClass('has-error');
				return false;
			}else{
				$('#er_'+f).html('');
				$("#"+f).parents('.form-group').removeClass('has-error');
				return true;
			}
		}
	},
numericWithDash : function(f,m){
	var v = $('#'+f).val();
	$('#er_'+f).html('');
	if(v != ''){
			if(numericWithDash.test(v) == false){
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' must contain only numeric value.</label>');
				return false;
			}else{
				$('#er_'+f).html('');
				return true;
			}
		}
	},
	
	numericWithPlus : function(f,m){
	var v = $('#'+f).val();
	v = v.trim()
	$('#'+f).val(v)
	$('#er_'+f).html('');
	if(v != ''){
			if(numericWithPlus.test(v) == false){
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' must contain numeric with plus value.</label>');
				return false;
			}else{
				$('#er_'+f).html('');
				return true;
			}
		}
	},
	
alphaNumeric : function(f,m){
	var v = $('#'+f).val();
	v = v.trim()
	$('#'+f).val(v)
	$('#er_'+f).html('');
	if(v != ''){
			if(alphaExp.test(v) == false){
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' must contain only valid characters.</label>');
				return false;
			}else{
				$('#er_'+f).html('');
				return true;
			}
		}
	},
	
	
	alphabatic : function(f,m){
	var v = $('#'+f).val();
	v = v.trim()
	$('#'+f).val(v)
	$('#er_'+f).html('');
	if(v != ''){
			if(alphabatic.test(v) == false){
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' must contain only alphabatic characters.</label>');
				return false;
			}else{
				$('#er_'+f).html('');
				return true;
			}
		}
	},
	
	
	
	filetype : function(f,m){
		var v = $('#'+f).val();
		
		$('#er_'+f).html('');
	
		if(!v.match(/(?:jpg|png|jpeg|JPG|PNG|JPEG)$/)){
			
		$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i>Invalid file format</label>');
		return false;
			
		}else{
			
			$('#er_'+f).html('');
			return true;
		}
	},
	
	
  filesize : function(f,m){
	  	var v = $('#'+f)[0].files[0].size;
	 //var file_size = $('#profile_image')[0].files[0].size;
	$('#er_'+f).html('');
	if(v > 2097152){
		$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> File size is greater than 2MB.</label>');
		return false;
		}else{
			$('#er_'+f).html('');
			return true;
		}
	},
	

	
length : function(f,m,l){
var v = $('#'+f).val();
if(v.length != l) {
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' field must be '+l+' characters.</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
},

match : function(f,f2,m1,m2){
var v = $('#'+f).val();
var v2 = $('#'+f2).val();
if(v != v2){
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m1+' field does not match with '+m2+' field.</label>');
return false;
}else{
$('#er_'+f).html();
return true;
}
},
codematch : function(f,f2,m1,m2){
var v = $('#'+f).val();
var v2 = $('#'+f2).val();
if(v != v2){
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The verification code is invalid.</label>');
return false;
}else{
$('#er_'+f).html();
return true;
}
},
minlength : function(f,m,l){
var v = $('#'+f).val();
if(v.length < l) {
$('#er_'+f).addClass('form-error1');
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' length should be greater or equal to '+ l+'</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
},

phoneminlength : function(f,m,l,h){
var v = $('#'+f).val();
if(v.length < l) {
$('#er_'+f).addClass('form-error1');
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' length must be '+l+' numbers.</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
},

minlength : function(f,m,l,h){
var v = $('#'+f).val();
    if(v.length < l || v.length > h) {
        $('#er_'+f).addClass('form-error1');
        $('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' length must be '+l+'-'+h+' characters</label>');
        return false;
    }else{
        $('#er_'+f).html('');
        return true;
    }
},

passwordminlength : function(f,m,l){
var v = $('#'+f).val();
if(v.length < l) {
$('#er_'+f).addClass('form-error1');
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The password length must be 8-20 characters</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
},

    maxlength : function(f,m,l){
var v = $('#'+f).val();
if(v.length > l) {
	$('#er_'+f).addClass('form-error1');
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i>The '+m+' length should be less or equal to '+ l+'</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
},

maxnumlength : function(f,m,l){
var v = $('#'+f).val();
console.log(v+' > '+l);
if(v > l) {
	$('#er_'+f).addClass('form-error1');
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i>The '+m+' value should be less or equal to '+ l+'</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
},

web : function(f,m){
var v = $('#'+f).val();
if(v != ''){
if(webExpr.test(v) == false){
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The web url is not valid.</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
}
},


spaces : function(f,m){
var v = $('#'+f).val();
if(v != ''){
if(/\s/.test(v)){
$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> Do not enter space between password.</label>');
return false;
}else{
$('#er_'+f).html('');
return true;
}
}
},


date : function(f,m){
	var v = $('#'+f).val();
	if(v != ''){
		if(date_expr.test(v) == false){
			$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' date is not valid.</label>');
			$("#"+f).parents('.form-group').addClass('has-error');
			return false;
		}else{
			$('#er_'+f).html('');
			$("#"+f).parents('.form-group').removeClass('has-error');
			return true;
		}
	}
},

arabic : function(f,m){
	var v = $('#'+f).val().trim();
	if(v){
			if(arabic_numbers.test(v))
			{
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' must contain only english numbers.</label>');
				return false;
			}
			else
			{
				$('#er_'+f).html('');
				return true;
			}
		}
	},

arabicPhone : function (f,m)
{
	var v = $('#'+f).val().trim();
	if(v){
			if(!arabic_phone.test(v))
			{
				$('#er_'+f).html('<label class="error-label" for="inputError"><i class="fa fa-times-circle-o"></i> The '+m+' should be started with 5.</label>');
				return false;
			}
			else
			{
				$('#er_'+f).html('');
				return true;
			}
		}
}

};   
