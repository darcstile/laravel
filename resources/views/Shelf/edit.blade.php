@extends('layout')
@section('content')

    <div class="container">
        <form method="post" action="{{route('shelves.update',$item->id)}}" enctype="multipart/form-data">
            @method('PATCH')
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
            <div class="box" style="padding: 18px; background: #fff; border-radius: 0.37rem; border: 1px solid #e4e4e4; display: flex">
                <div class="col-md-8" style="float: left;">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Имя полки:</label>
                        <input type="text" name="name" id="name" class="form-control" id="formGroupExampleInput" value="{{$item->name}}">
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-save btn-primary" name="add_item" value="Сохранить" style="margin-top: 10px; float: left">
        </form>
        @if($item->exists)
            <form method="post" action="{{ route('shelves.destroy', $item->id) }}">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-danger btn-primary" name="delete_item" value="Удалить" style="margin-top: 10px; float: left; margin-left: 10px;">
            </form>
    @endif

@endsection
