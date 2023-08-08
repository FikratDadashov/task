@extends('template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div style="float: left;" class="col-5 align-self-center">
                <h4 class="page-title">Groups</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/user')}}">Mainpage</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{url('/group')}}">Groups</a></li>
                            <?php
                            if ($operation == 'create')
                                $title = 'Add a new group';
                            elseif ($operation == 'edit')
                                $title = 'Edit group';
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
                            $action = url('/group');
                        elseif ($operation == 'edit')
                            $action = url('/group/' . $group->id);
                        ?>
                        <form class="form needs-validation" novalidate="" action="{{url($action)}}" method="POST">
                            @if($operation == 'edit')
                                <input type="hidden" name="_method" value="PUT">
                            @endif
                            @csrf
                            <div class="card-body">
                                <div class="collapse show" id="collapseExample_2">

                                    <div class="form-group row align-items-center mb-0">
                                        <label for="name"
                                               class="col-2 control-label col-form-label">Name</label>
                                        <div class="col-9 border-left pb-2 pt-2">
                                            <input id="fullname" class="form-control" type="text" name="name" required autofocus placeholder="Name"
                                                   @if($operation=="edit") value="{{$group->name}}"
                                                   @elseif($operation=="create") value="" @else value="{{$group->name}}"
                                                   disabled @endif >
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
                                   href="{{url('/group')}}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
