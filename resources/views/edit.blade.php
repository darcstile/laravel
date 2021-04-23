@extends('layout')
@section('content')
    @php /** @var \App\Models\Book $item */  @endphp
    <div class="container" >
        <div method="post" action="{{route('books.update',$item->id)}}">
            @method('PATCH')
            @csrf
            <div class="col-md-8" style="float: left">
            <div class="form-group">
                <label for="formGroupExampleInput">Имя книги:</label>
                <input type="text" class="form-control" id="formGroupExampleInput" value="{{$item->name}}">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Автор:</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" value="{{$item->author}}">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Категория:</label>
                <select class="custom-select">
                    <option selected> @foreach ($item->categories as $category)
                                        {{ $category->name }}
                        @endforeach </option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Полка:</label>
                <select class="custom-select">
                    <option selected>{{$item->shelf['name']}}</option>
                    @foreach ($shelves as $shelf)
                        <option value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Полка:</label>
                <select class="custom-select">
                    <option selected> @foreach ($item->tags as $tag)
                            {{ $tag->name }}
                        @endforeach </option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Читатель:</label>
                <select class="custom-select">
                    <option selected>{{$item->reader['FIO']}}</option>
                    @foreach ($readers as $reader)
                        <option value="{{ $reader->id }}">{{ $reader->FIO }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Дата взятия:</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" value="{{$item->date_take}}">
            </div>
        </div>
            <div class="col-md-4" style="float: right;">
            <div class="form-group">
                    <div class="form">
                        <div style="background: #F1F1F1; border: 1px solid #CCCCCC; padding: 10px;">
                            <h3>Изображение книги</h3>
                            <img src="../../../public/img/{{$item->picture}}" class="picture" ">
                            <input type="file" name="file">
                            <input type="text" name="picture" value="" hidden>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-save btn-primary" name="add_item" value="Сохранить">
        </form>
    </div>
@endsection
