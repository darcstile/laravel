@extends('layout')

@section('content')
    @if(count($shelves)!=0)
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
            <a href="{{route('shelves.create') }}" class="btn btn-primary"  style="margin-bottom: 10px; float: right">Новая полка</a>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php /** @var \App\Models\Book $item */  @endphp
                    @foreach($shelves as $shelf)
                        <tr>
                            <th scope="row">{{$shelf->id}}</th>
                            <td><a href="{{route('shelves.edit', $shelf->id) }}">{{$shelf->name }}</a></td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>

            </div><!-- ./table-responsive-->
        </div>
    @endif


@endsection
