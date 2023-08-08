@extends('template')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-9 align-self-center">
            <h4 class="page-title">Users Information</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/user')}}">Main Page</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users Information</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex no-block justify-content-end">
                <a class="btn btn-primary" href="{{url('/user/create')}}"> <i
                        class="fa fa-plus-circle"></i><b>
                        Add a new user </b> </a>
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
                                    <th><b>ID</b></th>
                                    <th><b>Username</b></th>
                                    <th><b>Fullname</b></th>
                                    <th><b>Group</b></th>
                                    <th><b>Operations</b></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($users)) {
                            $counter = 0;
                            foreach ($users as $user) {
                            $counter++;
                            ?>
                            <tr>
                                <td>{{$counter}}</td>
                                <td>{{$user->id}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->fullname}} </td>
                                <td>@if ($user->groups->isNotEmpty()) {{ $user->groups[0]->name }} @endif </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ti-settings"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{url('/user/'.$user->id.'/edit')}}"><i
                                                    class="fa fa-pencil-alt"></i> Edit</a>
                                            @if($users->count() > 1)
                                            <div class="dropdown-divider"></div>
                                            <form class="form" action="{{url('/user/'.$user->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        onclick="return confirm('Do you want to delete this user?')"
                                                        class="dropdown-item"><i
                                                        class="fa fa-trash"></i> Delete</button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            }
                            ?>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th><b>ID</b></th>
                                    <th><b>Username</b></th>
                                    <th><b>Fullname</b></th>
                                    <th><b>Group</b></th>
                                    <th><b>Operations</b></th>
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
