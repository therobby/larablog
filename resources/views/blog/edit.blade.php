@extends('pagestruct.body')
@section('content')
            <div class="text-gray-600 dark:text-gray-400 " style="border: 1px; border-style: groove; border-radius: 5px; padding: 5px; display: flex; flex-direction: column; flex: auto; align-self: self-start;">
                @if (isset($id))
                <form action="/post/{{$id}}/edit" method="post" style="display: contents;">
                @else
                <form action="/post/create" method="post" style="display: contents;">
                @endif
                {{csrf_field()}}
                <label for="title">Tytuł: </label>
                <input value="{{$title}}" id="title" name="title">
                <br>
                {{-- <small>Utworzono: {{$post->created_at}} Aktualizacja: {{$post->updated_at}}</small> --}}
                <label for="body">Treść: </label>
                <textarea id="body" name="body" rows="10" style="resize: vertical">{{$body}}</textarea>
                <br>
                <input type="submit" value="Zapisz">
                </form>
            </div>
@endsection