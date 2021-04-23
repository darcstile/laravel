@extends('layout')

@section('content')
@if(count($books))
<div class="table-responsive">
					<table class="table table-hover table-striped">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Фото</th>
								<th scope="col">Имя</th>
								<th scope="col">Категория</th>
								<th scope="col">Метка или тег</th>
								<th scope="col">Полка</th>
								<th scope="col">Читатель</th>
								<th scope="col">Дата взятия книги</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($books as $book)
							<tr>
								<th scope="row">{{$book->id}}</th>
								<td><img src="../public/img/{{$book->picture}}." style="width: 50px;"></td>
								<td>{{$book->name }}</td>
                                <td> @foreach ($book->categories as $category)
                                        {{ $category->name }}
                                    @endforeach</td>
								<td>($book->tags as $tag)
                                    {{ $tag->name }}</td>
								<td>{{$book->shelf['name']}}</td>
								<td>{{$book->reader['FIO']}}</td>
								<td>{{$book->date_take}}</td>
							</tr>
                        @endforeach


						</tbody>
					</table>

				</div><!-- ./table-responsive-->
    @endif
@endsection


