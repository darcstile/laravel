@extends('layout')

@section('content')
    @if(count($journals)!=0)
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
            <a href="{{route('journals.create') }}" class="btn btn-primary"  style="margin-bottom: 10px; float: right">Новая запись</a>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Имя Книги</th>
                        <th scope="col">Читатель</th>
                        <th scope="col">Дата взятия</th>
                        <th scope="col">Дата возврата</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Удалить запись</th>
                        <th scope="col">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php /** @var \App\Models\Book $item */  @endphp
                    @foreach($journals as $journal)
                        <tr>
                            <td><a href="{{route('books.edit', $journal->book['id']) }}">{{$journal->book['name']}}</a></td>
                            <td>{{$journal->reader['FIO']}}</td>
                            <td>{{$journal->date_take}}</td>
                            <td>{{$journal->date_return}}</td>
                            <td>{{$journal->status}}</td>
                            <td>
                                <form method="post" action="{{ route('journals.destroy', $journal->id) }}">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class="btn btn-danger" value="Удаление записи">
                                </form>
                            </td>

                            @if($journal->status == 'У читателя')
                                <td>
                                <form method="post" action="{{route('journals.update',$journal->id)}}" enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                        <input type="submit" class="btn btn-success" value="Вернуть книгу">
                                </form>
                                </td>
                            @else
                                <td></td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- ./table-responsive-->
        </div>
    @endif
@endsection


