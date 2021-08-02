@extends('pagestruct.body')
@section('content')
            <div class="text-gray-600 dark:text-gray-400 " style="border: 1px; border-style: groove; border-radius: 5px; padding: 5px; display: flex; flex-direction: column; flex: auto; align-self: self-start;">
                <form action="/post/create" method="post" style="display: contents;">
                {{csrf_field()}}
                Title: <input value="{{$title}}" name="title">
                <br>
                {{-- <small>Utworzono: {{$post->created_at}} Aktualizacja: {{$post->updated_at}}</small> --}}
                <textarea name="body" rows="10" style="resize: vertical">{{$body}}</textarea>
                <br>
                <input type="submit" value="Zapisz">
                </form>
            </div>
@endsection