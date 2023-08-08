@extends('template')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-9 align-self-center">
            <h4 class="page-title">Groups Information</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/user')}}">Mainpage</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Groups Information</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-3">
            <div class="d-flex no-block justify-content-end">
                <a class="btn btn-primary" href="{{url('/group/create')}}"> <i
                        class="fa fa-plus-circle"></i><b>
                        Add a new group </b> </a>
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
                                    <th><b>Name</b></th>
                                    <th><b>Operations</b></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($groups)) {
                            $counter = 0;
                            foreach ($groups as $group) {
                            $counter++;
                            ?>
                            <tr>
                                <td>{{$counter}}</td>
                                <td>{{$group->id}}</td>
                                <td>{{$group->name}}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ti-settings"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{url('/group/'.$group->id.'/edit')}}"><i
                                                    class="fa fa-pencil-alt"></i> Edit</a>
                                            <a class="dropdown-item"
                                               href="{{url('group/'.$group->id.'/users')}}"><i
                                                    class="fa fa-users"></i> Group Users</a>
                                            <div class="dropdown-divider"></div>
                                            <form class="form" action="{{url('/group/'.$group->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        onclick="return confirm('Do you want to delete this group?')"
                                                        class="dropdown-item"><i
                                                        class="fa fa-trash"></i> Delete</button>
                                            </form>
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
                                    <th><b>Name</b></th>
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
