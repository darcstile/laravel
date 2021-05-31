@extends('layout')

@section('content')
    @if(count($readers)!=0)
        <div class="container">
            @if($errors->any())
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&#10006</span>
                            </button>
                            {{$errors->first() }}
                        </div>
                    </div>
                </div>
            @endif
            @if(session('success'))
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&#10006</span>
                            </button>
                            {{session()->get('success') }}
                        </div>
                    </div>
                </div>
            @endif
            <a href="{{route('readers.create') }}" class="btn btn-primary"  style="margin-bottom: 10px; float: right">Новая книга</a>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ФИО</th>
                        <th scope="col">Дата рождения</th>
                        <th scope="col">Дата регистрации</th>
                        <th scope="col">Возраст (лет)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php /** @var \App\Models\Book $item */  @endphp
                    @foreach($readers as $reader)
                        <tr>
                            <th scope="row">{{$reader->id}}</th>
                            <td><a href="{{route('readers.edit', $reader->id) }}">{{$reader->FIO }}</a></td>
                            <td>{{$reader->date_birth}}</td>
                            <td>{{$reader->date_reg}}</td>
                            <td>{{floor((time() - strtotime($reader->date_birth)) / 31556926)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- ./table-responsive-->
        </div>
    @endif
@endsection


