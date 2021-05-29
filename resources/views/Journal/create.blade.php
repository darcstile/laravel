@extends('layout')
@section('content')

    <div class="container" >
        <form method="post" action="{{route('journals.store')}}" enctype="multipart/form-data">
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
            <div class="box" style="padding: 18px; background: #fff; border-radius: 0.37rem; border: 1px solid #e4e4e4;">
                <div class="" style="">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Книга:</label>
                        <select class="custom-select" name="book_id">
                            <option selected value=""></option>
                            @foreach ($books as $book)
                                @if ((empty($book->journal)) or ($book->journal['status'] != "У читателя"))
                                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Читатель:</label>
                        <select class="custom-select" name="reader_id">
                            <option selected value=""></option>
                            @foreach ($readers as $reader)
                                @if($reader['id'] != 0)
                                <option value="{{ $reader->id }}">{{ $reader->FIO }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Дата взятия:</label>
                        <input type="date" name="date_take"class="form-control" id="formGroupExampleInput2" value="{{null}}">
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Дата возврата:</label>
                        <input type="date" name="date_return" class="form-control" id="formGroupExampleInput2" value="{{null}}">
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-save btn-primary" value="Сохранить" style="margin-top: 10px;">
        </form>

@endsection
