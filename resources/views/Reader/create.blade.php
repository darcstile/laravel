@extends('layout')
@section('content')

    <div class="container" >
        <form method="post" action="{{route('readers.store')}}" enctype="multipart/form-data">
            @csrf
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
            <div class="" style="padding: 18px; background: #fff; border-radius: 0.37rem; border: 1px solid #e4e4e4; display: flex; width: fit-content">
                <div class="container" style="width: 700px;">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Имя пользователя:</label>
                        <input type="text" name="FIO" id="FIO" class="form-control" id="formGroupExampleInput" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Дата рождения:</label>
                        <input type="date" name="date_birth" id="date_birth" class="form-control" id="formGroupExampleInput2" value="{{null}}">
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-save btn-primary" value="Сохранить" style="margin-top: 10px; float: left">
        </form>

@endsection
