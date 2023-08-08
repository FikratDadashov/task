@extends('template')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-9 align-self-center">
                <h4 class="page-title">Group Users</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/user')}}">Mainpage </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{url('group')}}">Groups Information </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Group Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="form-actions text-left">
                    <a href="{{url('/group')}}" class="btn btn-success">Cancel</a>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form action="{{url('group/'.$group->id.'/detach_users')}}" method="POST">
                                <div class="card-body">
                                    <h4 class="card-title">Current Users</h4>
                                    @csrf
                                    <select name="current_users[]" multiple=""
                                            class="form-control multi-select-options"
                                            size="15">
                                        @foreach($group->users as $user)
                                            <option
                                                value="{{$user->id}}">{{$user->username." (".$user->fullname.")"}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="col text-center">
                                        <button type="submit"
                                                class="btn btn-primary mt-2">Remove<i
                                                class="fas fa-arrow-alt-circle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <form action="{{url('group/'.$group->id.'/attach_users')}}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <h4 class="card-title">Potential Users</h4>
                                    <select name="potential_users[]" multiple=""
                                            class="form-control multi-select-options"
                                            size="15">
                                        @foreach($potential_users as $user)
                                            <option
                                                value="{{$user->id}}">{{$user->username." (".$user->fullname.")"}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary mt-2"><i
                                                class="fas fa-arrow-alt-circle-left"></i>Add
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

