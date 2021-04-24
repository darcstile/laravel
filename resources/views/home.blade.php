@extends('layout')

@section('content')
@if(count($books)!=0)
    <div class="container">
<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Фото</th>
								<th scope="col">Имя</th>
								<th scope="col">Автор</th>
								<th scope="col">Категория</th>
								<th scope="col">Метка или тег</th>
								<th scope="col">Полка</th>
								<th scope="col">Читатель</th>
								<th scope="col">Дата взятия книги</th>
							</tr>
						</thead>
						<tbody>
                        @php /** @var \App\Models\Book $item */  @endphp
                        @foreach($books as $book)
							<tr>
								<th scope="row">{{$book->id}}</th>
								<td><img src="../public{{$url = Storage::url($book->picture)}}" style="width: 50px;"></td>
								<td><a href="{{route('books.edit', $book->id) }}">{{$book->name }}</a></td>
								<td>{{$book->author}}</a></td>
                                <td> @foreach ($book->categories as $category)
                                        {{ $category->name }}
                                    @endforeach</td>
								<td>@foreach ($book->tags as $tag)
                                    {{ $tag->name }}
                                    @endforeach</td>
								<td>{{$book->shelf['name']}}</td>
								<td>{{$book->reader['FIO']}}</td>
								<td>{{$book->date_take}}</td>
							</tr>
                        @endforeach


						</tbody>
					</table>

				</div><!-- ./table-responsive-->
    </div>
    @endif
@endsection


