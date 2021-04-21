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
							</tr>
						</thead>
						<tbody>
                        @foreach($books as $book)
							<tr>
								<th scope="row">{{$book->id}}</th>
								<td>{{$book->picture}}</td>
								<td>{{$book->name }}</td>
                                <td> @foreach ($book->categories as $category)
                                        {{ $category->category }}
                                    @endforeach</td>
								<td>@foreach ($book->tags as $tag)
                                        {{ $tag->tag }}
                                    @endforeach</td>
								<td>{{$book->shelf['shelf']}}</td>
								<td>{{$book->reader['FIO']}}</td>
							</tr>
                        @endforeach


						</tbody>
					</table>

				</div><!-- ./table-responsive-->
    @endif
@endsection


