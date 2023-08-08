@extends('template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div style="float: left;" class="col-5 align-self-center">
                <h4 class="page-title">Users</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/user')}}">Mainpage</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{url('/user')}}">Users</a></li>
                            <?php
                            if ($operation == 'create')
                                $title = 'Add a new user';
                            elseif ($operation == 'edit')
                                $title = 'Edit user';
                            ?>
                            <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
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
                        <?php
                        if ($operation == 'create')
                            $action = url('/user');
                        elseif ($operation == 'edit')
                            $action = url('/user/' . $user->id);
                        ?>
                        <form class="form needs-validation" novalidate="" action="{{url($action)}}" method="POST">
                            @if($operation == 'edit')
                                <input type="hidden" name="_method" value="PUT">
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="collapse show" id="collapseExample_2">

                                    <div class="form-group row align-items-center mb-0">
                                        <label for="fullname"
                                               class="col-2 control-label col-form-label">Fullname</label>
                                        <div class="col-9 border-left pb-2 pt-2">
                                            <input id="fullname" class="form-control" type="text" name="fullname" required autofocus placeholder="Fullname"
                                                   @if($operation=="edit") value="{{$user->fullname}}"
                                                   @elseif($operation=="create") value="" @else value="{{$user->fullname}}"
                                                   disabled @endif >
                                            <div class="invalid-feedback">
                                                Required
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row align-items-center mb-0">
                                        <label for="username"
                                               class="col-2 control-label col-form-label">Username</label>
                                        <div class="col-9 border-left pb-2 pt-2">
                                            <input id="username" class="form-control" type="text" name="username" required placeholder="Username"
                                                   @if($operation=="edit") value="{{$user->username}}"
                                                   @elseif($operation=="create") value=""
                                                   @else value="{{$user->email}}" disabled @endif >
                                            <div class="invalid-feedback">
                                                Required
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <button id="form_submit" type="submit" class="btn btn-success"><i
                                        class="fa fa-check"></i> Save
                                </button>
                                <a class="btn btn-outline-dark" role="button"
                                   href="{{url('/user')}}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
