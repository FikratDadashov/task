@extends('template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-9 align-self-center">
                <h4 class="page-title">Rights Users Information</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/user')}}">Mainpage</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rights Users Information</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex no-block justify-content-end">
                    <a class="btn btn-primary" href="{{url('/right/edit')}}"> <i
                            class="fa fa-pencil-alt"></i><b>
                            Edit Rights </b> </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><b>Username ( Group Name )</b></th>
                                        <th><b>Function name ( Module Name )</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $counter = 0;
                                foreach ($users as $user) {
                                $counter++;
                                ?>
                                <tr>
                                    <td>{{$counter}}</td>
                                    <td>{{($user->groups->isNotEmpty() ? $user->username." ( ".$user->groups[0]->name." ) " : $user->username." ( No group )" )}}</td>
                                    <td>
                                        @foreach($user->functions as $function)
                                            {{$function->name." (".$function->module->name." )"}}. <button  onclick="return confirm('Are you sure?')" title="delete function" id="function_id" value="{{$function->id}}" data-value="{{$user->id}}" type="button" class="btn text-center delete_right">
                                                <i class="fas fa-trash"></i>{{$user->id}}</button></br>
                                        @endforeach
                                    </td>

                                </tr>
                                <?php
                                }
                                ?>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th><b>Username ( Group Name )</b></th>
                                        <th><b>Function name (Module Name )</b></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
