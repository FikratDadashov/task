@extends('template')
@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-9 align-self-center">
                <h4 class="page-title">Xəbərlər</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Ana səhifə</a></li>
                            <li class="breadcrumb-item active"
                                aria-current="page">Xəbərlər
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex no-block justify-content-end">
                    <a class="btn btn-primary" href="{{url('news/create')}}"> <i
                            class="fa fa-plus-circle"></i><b>
                            Yeni xəbər əlavə et </b> </a>
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
                            <table id="zero_config" class="table table-striped table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th><b>#</b></th>
                                    <th><b>İdentifikasiya<br>nömrəsi</b></th>
                                    <th><b>Başlıq</b></th>
                                    <th><b>Status</b></th>
                                    <th><b>Əməliyyatlar</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($newss)) {
                                $counter = 0;
                                foreach ($newss as $news) {
                                $news_text = $news->text->where('language_id', 1);
                                $counter++;
                                ?>
                                <tr>
                                    <td>{{$counter}}</td>
                                    <td>{{$news->id}}</td>
                                    <td>{{(count($news_text)>0 ? $news_text->first()->title : '')}}</td>
                                    <td>{{$news->status->name}}</td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                   href="{{url('/news/'.$news->id.'/edit')}}"><i
                                                        class="fa fa-pencil-alt"></i> Düzəliş et</a>
                                                <div class="dropdown-divider"></div>
                                                @foreach ($languages as $language)
                                                    <a class="dropdown-item"
                                                       href="{{url('/news/'.$news->id.'/edit/'.$language->id)}}"><i
                                                            class="fa fa-flag"></i> {{$language->name}} </a>
                                                @endforeach
                                                <div class="dropdown-divider"></div>
                                                <form class="form" action="{{url('news/'.$news->id)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit"
                                                            onclick="return confirm('Xəbəri silməyə əminsiniz?')"
                                                            class="dropdown-item"><i
                                                            class="fa fa-trash"></i>Sil
                                                    </button>
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
                                        <th><b>#</b></th>
                                        <th><b>İdentifikasiya<br>nömrəsi</b></th>
                                        <th><b>Başlıq</b></th>
                                        <th><b>Status</b></th>
                                        <th><b>Əməliyyatlar</b></th>
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
