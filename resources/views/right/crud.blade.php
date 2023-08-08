@extends('template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-9 align-self-center">
                <h4 class="page-title">User Rights</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/user')}}">Mainpage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Rights</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form class="form needs-validation" novalidate action="{{url('/right/update')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row align-items-center mb-0">
                                    <label for="module_id" class="col-sm-3 col-md-2 control-label col-form-label">Modules</label>
                                    <div class="col-9 border-left pb-2 pt-2">
                                        <select required name="module_id" id="module_id" class="form-control" >
                                            <option value="">Select</option>
                                            @foreach($modules as $module)
                                                <option value="{{$module->id}}">{{$module->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Required
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center mb-0">
                                    <label for="group_id" class="col-sm-3 col-md-2 control-label col-form-label">Groups</label>
                                    <div class="col-9 border-left pb-2 pt-2">
                                        <select required name="group_id" id="group_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach( $groups as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Required
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center mb-0">
                                    <label for="user_id"
                                           class="col-sm-3 col-md-2 control-label col-form-label">Users</label>
                                    <div class="col-9 border-left pb-2 pt-2">
                                        <select name="user_id[]" id="user_id" class="select2 form-control custom-select" multiple="multiple" style="width: 50%; height:36px;">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row align-items-center mb-0">
                                    <label for="function_id"
                                           class="col-sm-3 col-md-2 control-label col-form-label">Functions</label>
                                    <div class="col-9 border-left pb-2 pt-2">
                                        <select id="function_id" name="function_id[]" class="select2 form-control custom-select" multiple="multiple" style="width: 50%; height:36px;">
                                        </select>
                                    </div>
                                </div>


                                <br>
                            </div>
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a class="btn btn-outline-dark" role="button"
                                   href="{{url('/right')}}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('fetch')
    <script>
        $(document).ready(function(){
            $('#module_id, #group_id').change(function() {

                let module_id = $('#module_id').val();
                let group_id = $('#group_id').val();
                let user_id = $('#user_id').val();
                let function_id = $('#function_id').val();

                if(module_id && group_id)
                {
                    $.ajax({
                        type: "GET",
                        url: "{{url('right/ajax/fetch-rights')}}",
                        data:{
                            module_id: module_id,
                            group_id: group_id,
                            user_id: user_id,
                            function_id: function_id,
                        },
                        success: function(data)
                        {
                            data = JSON.parse(data);
                            functions = data.functions;
                            users = data.users;
                            $('#function_id').children().remove();
                            $('#user_id').children().remove();

                            // $('#function_id').append($('<option>').val("").text("Select"));
                            $.each(functions, function(i, item) {
                                $('#function_id').append($('<option>').val(item.id).text(item.name));
                            });

                            // $('#user_id').append($('<option>').val("").text("Select"));
                            $.each(users, function(i, item) {
                                $('#user_id').append($('<option>').val(item.id).text(item.username));
                            });

                        },
                        error: function(){
                            alert('ERROR found');
                        }
                    });
                }
            });

        });
    </script>
@endsection
