@extends('layout')
@section('content')
<div class="container">
    <form>
        <div class="form-group">
            <label for="formGroupExampleInput">Имя книги:</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Книга">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Автор:</label>
            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Автор">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Полка:</label>
            <select class="custom-select">
                <option selected></option>
                @foreach ($shelves as $shelf)
                    <option value="{{ $shelf->id }}">{{ $shelf->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" style="border: 1px solid #dce1e6; border-radius: 3px; padding: 10px">
            <label for="formGroupExampleInput2">Изображение обложки:</label>
            <div class="col-md-4">
                <div class="form">
                    <div class="field">
                        <h3>Изображение</h3>
                        <img src="" class="picture">
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
