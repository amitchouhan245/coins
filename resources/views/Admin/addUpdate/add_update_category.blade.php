@extends('Admin.layout.master') @section('css') {!! Html::style('public/custom/plugnis/fancybox/source/jquery.fancybox.css') !!} @endsection @section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"><i class="la la-folder-open"></i>{{ $title }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ $app_url.'dashboard' }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ $app_url.'categories' }}">Categories</a>
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
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" id="addCategoryForm">
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-folder-open"></i>Service Info</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="type">Title<i class="error"><strong>*</strong></i></label>
                                                        <input type="text" id="title" class="form-control" placeholder="Title" name="title" value="{{ @$category->title }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="type">Charge<i class="error"><strong>*</strong></i></label>
                                                        <input type="text" id="charge" class="form-control" placeholder="Charge" name="charge" value="{{ @$category->charge }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="value">Description<i class="error"><strong>*</strong></i></label>
                                                        <textarea name="description" id="description" placeholder="Enter Description here" cols="3" rows="2" class="form-control form-group">{{ @$category->description }}</textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        @if(!empty($category))
                                        <input type="hidden" name="id" id="id" value="{{ @$category->id }}"> @endif

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="custom-file">
                                                    <label for="profile_image">Category Image <i class="error"><strong>( JPEG ,JPG or PNG formate )</strong></i></label>
                                                    <br>
                                                    <input type="file" id="image"  name="image" >
                                                </div>
                                            </div>

                                            @if(@$category['image'] !="" && file_exists(Config::get('constants.CATEGORY_THUMBNAIL').@$category->image))

                                            <a class="fancybox" href="{{url(Config::get('constants.CATEGORY_THUMBNAIL').$category->image )}}">
                                {!! Html::image(Config::get('constants.CATEGORY_THUMBNAIL').$category->image,'',['alt' => 'Images','class' => '',"style" => 'width:70px;height:70px;'])!!} </a>
                                            <br/>
                                            <br/> @else @if(!empty(@$category->id)) {!! Html::image('public/uploads/no-image.png', '', ['class' => '',"style" => 'width:70px;height:70px;']) !!} @endif @endif
                                        </div>

                                        <br>
                                        <br>

                                        <h4 class="form-section"><i class="la la-hand-o-right"></i>Instructions</h4>

                                        <div class="row">

                                            <div class="col-md-12" style="text-align: right;">

                                                <button type="button" data-repeater-create class="btn btn-info btn-sm repeater-btn" id="add_block" onclick="add_period_element('class_period_element')" title="Add Category"><i class="ft-plus"></i> Add</button>
                                            </div>
                                            <div class="col-md-10">
                                                <label for="title" style="text-align: left; padding-left: 15px;">Title <i class="error"><strong>*</strong></i></label>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="to_time"></label>
                                            </div>
                                            <div class="class_period_element col-md-12">

                                                @php $instruction_no = 0; @endphp @if(isset($instruction_data) && count($instruction_data) > 0) @foreach($instruction_data as $value)

                                                <div class="instruction_json animated faster clearfix" id="class_period_{{ $instruction_no }}">
                                                    <div class="input-group">
                                                        <div class="col-md-10 col-sm-12">
                                                            <div class="form-group">

                                                                <input class="form-control" name="instruction_json[{{ $instruction_no }}][title]" id="title_{{ $instruction_no }}" value="{{ ucFirst($value['title'])}}">

                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="instruction_json[{{ $instruction_no }}][instruction_id]" value="{{ $value['id'] }}">
                                                        <div class="col-md-2">
                                                            <span class="input-group-append" id="button-addon2">
                                                <button class="btn btn-danger"  type="button" onclick='delete_instruction("{{ $value['id'] }}")'><i class="ft-x"></i></button>
                                                </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                @php $instruction_no = $instruction_no + 1; @endphp @endforeach @endif

                                            </div>
                                        </div>

                                        <h4 class="form-section"><i class="la la-hand-o-right"></i>Docoments</h4>

                                        <div class="row">

                                            <div class="col-md-12" style="text-align: right;">
                                                <button type="button" data-repeater-create class="btn btn-info btn-sm repeater-btn" id="add_block2" onclick="add_document_element('category_document_element')" title="Add Document"><i class="ft-plus"></i> Add </button>
                                            </div>
                                            <div class="col-md-10">
                                                <label for="title" style="text-align: left; padding-left: 15px;">Title <i class="error"><strong>*</strong></i></label>
                                            </div>

                                            <div class="col-md-2">
                                                <label for="to_time"></label>
                                            </div>
                                            <div class="category_document_element col-md-12">

                                                @php $document_no = 0; @endphp @if(isset($document_data) && count($document_data) > 0) @foreach($document_data as $value)

                                                <div class="document_json animated faster clearfix" id="category_docu_{{ $document_no }}">
                                                    <div class="input-group">
                                                        <div class="col-md-10 col-sm-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="document_json[{{ $document_no }}][document_name]" id="document_name_{{ $document_no }}" value="{{ ucFirst($value['document_name'])}}">

                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="document_json[{{ $document_no }}][document_id]" value="{{ $value['id'] }}">
                                                        <div class="col-md-2">
                                                            <span class="input-group-append" id="button-addon2">
                                                <button class="btn btn-danger" type="button" onclick='delete_document("{{ $value['id'] }}")'><i class="ft-x"></i></button>
                                                </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                @php $document_no = $document_no + 1; @endphp @endforeach @endif

                                            </div>
                                        </div>

                                        <div class="form-actions" align="right">
                                            <a href="{{ $app_url.'categories' }}" class="btn btn-danger mr-1">
                                                <i class="ft-x"></i> Cancel</a>
                                            <button type="submit" id="submit" class="btn btn-info">
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

@endsection @section('script') {!! Html::script('public/custom/plugnis/fancybox/source/jquery.fancybox.js') !!}

<script type="text/javascript">

    $(document).ready(function() {
        $('#addCategoryForm').validate({

            rules: {

                title: {

                    required: true
                },

                description: {

                    required: true

                },
                charge: {

                    required: true,
                    number: true

                },
            },
            messages: {

                title: {

                    required: "Please enter title.",
                },
                description: {

                    required: "Please enter description.",
                },
                charge: {

                    required: "Please enter charge.",
                },
            },

            submitHandler: function(form) {

                let btnText = '<i class="la la-check-square-o"></i> Add';
                let btnId = 'submit';

                med('add', btnId);

                var params = $(form).serializeArray();

                var files = $("#image")[0].files[0];

                var formData = new FormData();

                formData.append('image', document.getElementById("image").files[0]);

                $.each(params, function(key, input) {

                    formData.append(input.name, input.value);

                });

                $.ajax({

                    url: APP_URL + 'categories',
                    type: 'POST',
                    data: formData,
                    headers: headers,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(res) {

                        ajax_success(res, APP_URL + 'categories', btnId, btnText);
                    },
                    error: function(error) {

                        ajax_error(error, btnId, btnText);

                    }
                });
            }
        });

        var blockCount = "{{$instruction_no}}";
        var documentCount = "{{$document_no}}";

        if (blockCount == 0) {

            add_period_element('class_period_element');
        }

        if (documentCount == 0) {

            add_document_element('category_document_element');
        }

    });

    $(".fancybox").fancybox();

</script>

<script type="text/javascript">

    var instruction_no = parseInt("{{ $instruction_no }}");

    function add_period_element(className) {

        med('add', 'add_block', 'Please Wait..');

        var classPeriodId = "class_period_" + instruction_no;

        var element = '<div class="instruction_json animated faster clearfix" id="' + classPeriodId + '">' +
            '<div class="input-group">' +
            '<div class="col-md-10 col-sm-12">' +
            '<div class="form-group">' +

            '<input class="form-control" Placeholder="Enter Title" name="instruction_json[' + instruction_no + '][title]" id="title_' + instruction_no + '">' +

            '</div>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<span class="input-group-append" id="button-addon2" >' +
            '<button class="btn btn-danger" type="button" onclick="delete_instruction_element(' + instruction_no + ')" ><i class="ft-x"></i></button>' +
            '</span>' +
            '</div>' +
            '</div>' +
            '</div>';

            setTimeout(function() {

                $('.'+className).append(element);

                setTimeout(function() {

                    med('remove', 'add_block', '+ Add');
                    add_validation_new_title(instruction_no);
                    instruction_no = instruction_no + 1;

                }, 500);

            }, 500);
        }

    function delete_instruction_element(id) {

        $("#class_period_" + id).removeClass('animated zoomIn faster');
        $("#class_period_" + id).addClass('animated zoomOut faster');

        setTimeout(function() {

            $("#class_period_" + id).remove();

        }, 500);

    }

    function delete_instruction(id) {

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

                    url: "{{$app_url.'remove-instruction'}}",
                    method: 'POST',
                    data: {
                        "id": id
                    },
                    dataType: "JSON",
                    headers: headers,
                    success: function(res) {

                        swal(res.message, {
                            icon: "success",
                            timer: 2000
                        });

                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {

                        ajax_error(error);

                    }
                });
            }
        });
    }

    function add_validation_new_title(instruction_no) {

        $("#title_" + instruction_no).rules("add", {

            required: true,

            messages: {

                required: "Please Enter The Instruction",
            }
        });
    }
</script>

<script type="text/javascript">

    var instruction_no = parseInt("{{ $document_no }}");

    function add_document_element(className) {

        med('add', 'add_block2', 'Please Wait..');

        var classPeriodId = "category_docu_" + instruction_no;

        var element = '<div class="document_json animated faster clearfix" id="' + classPeriodId + '">' +
            '<div class="input-group">' +
            '<div class="col-md-10 col-sm-12">' +
            '<div class="form-group">' +

            '<input class="form-control" Placeholder="Enter Title" name="document_json[' + instruction_no + '][document_name]" id="document_name_' + instruction_no + '">' +

            '</div>' +
            '</div>' +

            '<div class="col-md-2">' +
            '<span class="input-group-append" id="button-addon2" >' +
            '<button class="btn btn-danger" type="button" onclick="delete_document_element(' + instruction_no + ')" ><i class="ft-x"></i></button>' +
            '</span>' +
            '</div>' +
            '</div>' +
            '</div>';

        setTimeout(function() {

            $('.'+className).append(element);
            
            setTimeout(function() {

                med('remove', 'add_block2', '+ Add');
                add_validation_new(instruction_no);
                instruction_no = instruction_no + 1;

            }, 500);

        }, 500);
    }

    function delete_document_element(id) {

        $("#category_docu_" + id).removeClass('animated zoomIn faster');
        $("#category_docu_" + id).addClass('animated zoomOut faster');

        setTimeout(function() {

            $("#category_docu_" + id).remove();

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

                    url: "{{$app_url.'remove-document'}}",
                    method: 'POST',
                    data: {
                        "id": id
                    },
                    dataType: "JSON",
                    headers: headers,
                    success: function(res) {

                        swal(res.message, {
                            icon: "success",
                            timer: 2000
                        });

                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {

                        ajax_error(error);

                    }

                });

            }

        });

    }

    function add_validation_new(instruction_no) {

        $("#document_name_" + instruction_no).rules("add", {

            required: true,

            messages: {

                required: "Please Enter The Document Name",
            }
        });

    }
</script>

@endsection