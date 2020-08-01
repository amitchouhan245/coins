@extends('Admin.layout.master')

@section('content')

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <h3 class="content-header-title"><i class="la la-info"></i>{{ $title }}</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{$app_url.'dashboard'}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item"><a href="{{$app_url.'societies'}}">Society</a>
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
                        <h4 class="card-title" id="basic-layout-form"><i class="ft-plus-square"></i> {{ $title }}</h4>
                             <p>Category Title : <code>{{ $category_data->title }}</code> </p>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                     
                          <form class="form" id="addInstructionForm" method="" >
                            <div class="form-body">
                              <h4 class="form-section"><i class="la la-info"></i>Docoment Info</h4>

                                   <div class="row">

                                    <div class="col-md-12" style="text-align: right;">
                                       <button type="button" data-repeater-create class="btn btn-info btn-sm repeater-btn" onclick="add_document_element('category_document_element')" title="Add Document"><i class="ft-plus"></i> Add </button>
                                    </div>
                                    <div class="col-md-10">
                                       <label for="title" style="text-align: left; padding-left: 15px;">Title <i class="error"><strong>*</strong></i></label>
                                    </div>

                                    <div class="col-md-2">
                                     <label for="to_time"></label>
                                   </div>
                                   <div class="category_document_element col-md-12">
                                    
                                    @php

                                      $document_no = 0;

                                    @endphp

                                     @if(isset($document_data) && count($document_data) > 0)

                                       @foreach($document_data as $value)

                                         <div class="document_json animated faster clearfix" id="category_docu_{{ $document_no }}">
                                           <div class="input-group">
                                              <div class="col-md-10 col-sm-12">
                                               <div class="form-group">
                                                <input class="form-control" name="document_json[{{ $document_no }}][document_name]" id="document_name_{{ $document_no }}" value="{{ ucFirst($value['document_name'])}}" >

                                              </div>
                                            </div>
                                            <input type="hidden" name="document_json[{{ $document_no }}][document_id]" value="{{ $value['id'] }}">
                                              <div class="col-md-2">
                                                <span class="input-group-append" id="button-addon2" >
                                                <button class="btn btn-danger" type="button" onclick='delete_document("{{ $value['id'] }}")'><i class="ft-x"></i></button>
                                                </span>
                                              </div>
                                           </div>
                                          </div>

                                          @php

                                            $document_no = $document_no + 1;

                                          @endphp

                                       @endforeach

                                     @endif

                                   </div>

                                 </div>

                                <input type="hidden" name="category_id" id="category_id" value="{{ $category_data->id }}">

                                <div class="form-actions" style="text-align: right;">
                                  <a href="{{$app_url.'categories'}}" class="btn btn-danger mr-1">
                                    <i class="ft-x"></i> Cancel
                                  </a>
                                  <button type="submit" id="submit2" class="btn btn-info">
                                    <i class="la la-check-square-o"></i> Submit
                                  </button>
                                </div>
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

    $("#addInstructionForm").validate({
    
      submitHandler: function(form) {

      //med('add', 'submit2', 'Please Wait..');

      var params = $("#addInstructionForm").serializeArray();

      var formData = new FormData();

      $.each(params,function (key, input) {

          formData.append(input.name, input.value);
      });

      $.ajax({

        url: "{{ $app_url.'update-instructions' }}",
        type: 'POST',
        data: formData,
        headers  : headers,
        cache: false,
        contentType: false,
        processData: false,
        success: function(res) {

          //ajax_success(res, '{{ $app_url."categories" }}', 'submit2');
        
        },
        error: function(error){

         // ajax_error(error, 'submit', '<i class="la la-check-square-o"></i> Add');

        }

      });
    }
  });

  var documentCount = "{{$document_no}}";  
  
  if(documentCount == 0){

     add_document_element('category_document_element');
  }

});
 
</script>


<script type="text/javascript">

  var instruction_no = parseInt("{{ $document_no }}");

  function add_document_element(className){

    var classPeriodId = "category_docu_" + instruction_no;

    var element = '<div class="document_json animated faster clearfix" id="'+classPeriodId+'">'+
                   '<div class="input-group">'+
                      '<div class="col-md-10 col-sm-12">'+
                       '<div class="form-group">'+

                         '<input class="form-control" Placeholder="Enter Title" name="document_json['+instruction_no+'][document_name]" id="document_name_'+instruction_no+'">'+

                      '</div>'+
                    '</div>'+

                      '<div class="col-md-2">'+
                        '<span class="input-group-append" id="button-addon2" >'+
                        '<button class="btn btn-danger" type="button" onclick="delete_document_element('+instruction_no+')" ><i class="ft-x"></i></button>'+
                        '</span>'+
                      '</div>'+
                   '</div>'+
                  '</div>';

    $('.'+className).append(element);

    setTimeout(function() {

      add_validation_new(instruction_no);

      instruction_no = instruction_no + 1;

    }, 500);
  }

  function delete_document_element(id) {

    $("#category_docu_"+id).removeClass('animated zoomIn faster');
    $("#category_docu_"+id).addClass('animated zoomOut faster');

    setTimeout(function(){

      $("#category_docu_"+id).remove();

    }, 500);
  }

  function delete_document(id) {

  swal({
    
    title: "Are you sure?",
    text: "You want to delete this record",
    icon: "warning",
    buttons: true,
    dangerMode: true,

  })

  .then((willDelete) => {

    if (willDelete) {
      
      $.ajax({

        url  : "{{$app_url.'remove-document'}}",
        method: 'POST',
        data : { "id": id },
        dataType : "JSON",
        headers: headers,
        success: function(res) {            
                
          swal(res.message, { icon: "success", timer: 2000});

          setTimeout(function(){ location.reload(); }, 1000);
        },          
        error: function(error){

          ajax_error(error);              

        } 
      
      });
    
    }

  });
  
  }

  function add_validation_new(instruction_no){

    $("#document_name_"+instruction_no).rules("add",{

        required:true,

        messages: {

          required: "Please Enter The Document Name",
        }
      }
    );

  }


</script>


@endsection

