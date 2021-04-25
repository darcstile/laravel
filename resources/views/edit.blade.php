@extends('layout')
@section('content')

    <div class="container" >
        @php /** @var \App\Models\Book $item */  @endphp
                <form method="post" action="{{route('books.update',$item->id)}}" enctype="multipart/form-data">
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
                <label for="formGroupExampleInput">Имя книги:</label>
                <input type="text" name="name" id="name" class="form-control" id="formGroupExampleInput" value="{{$item->name}}">
                <input type="text" name="book_id" id="book_id" class="form-control" id="formGroupExampleInput" value="{{$item->id}}" hidden>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Автор:</label>
                <input type="text" name="author" id="author" class="form-control" id="formGroupExampleInput2" value="{{$item->author}}">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Категория:</label>
                <select class="custom-select" name="category_id" id="category_id">
                    <option selected value="@foreach ($item->categories as $category)
                    {{ $category->id }}
                    @endforeach"> @foreach ($item->categories as $category)
                                        {{ $category->name }}
                        @endforeach </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Полка:</label>
                <select class="custom-select" name="shelf_id" id="shelf_id">
                    <option selected value="{{ $item->shelf['id'] }}">{{$item->shelf['name']}}</option>
                    @foreach ($shelves as $shelf)
                        <option  value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Метка:</label>
                <select class="custom-select" name="tag_id" id="tag_id">
                    <option selected value="@foreach ($item->tags as $tag)
                    {{ $tag->id }}
                    @endforeach"> @foreach ($item->tags as $tag)
                            {{ $tag->name }}
                        @endforeach </option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Читатель:</label>
                <select class="custom-select" name="reader_id" id="reader_id">
                    <option selected value="{{$item->reader['id']}}">{{$item->reader['FIO']}}</option>
                    @foreach ($readers as $reader)
                        <option value="{{ $reader->id }}">{{ $reader->FIO }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Дата взятия:</label>
                <input type="date" name="date_take" id="date_take" class="form-control" id="formGroupExampleInput2" value="{{$item->date_take}}">
            </div>
        </div>
            <div class="col-md-4" style="float: right;">
            <div class="form-group">
                    <div class="form">
                        <div style="background: #F1F1F1; border: 1px solid #CCCCCC; padding: 10px;">
                            <h3>Изображение книги</h3>
                            <img src="../../../public{{$url = Storage::url($item->picture)}}" class="picture" style="max-width: 300px;">
                            <input type="file" name="image" id="image">
                            <input type="text" name="picture" id="picture " value="{{$item->picture}}" hidden>
                        </div>
                    </div>
                </div>
            </div>
                    </div>
            <input type="submit" class="btn btn-save btn-primary" name="add_item" value="Сохранить" style="margin-top: 10px; float: left">
        </form>
    @if($item->exists)
            <form method="post" action="{{ route('books.destroy', $item->id) }}">
                @method('DELETE')
                @csrf
                <input type="submit" class="btn btn-danger btn-primary" name="delete_item" value="Удалить" style="margin-top: 10px; float: left; margin-left: 10px;">
            </form>
    @endif

@endsection
