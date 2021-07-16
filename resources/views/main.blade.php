@extends('pagestruct.body')
@section('content')
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <!-- blogs -->
                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                        @foreach($posts as $post)
                        <div style="border: 1px; border-style: groove; border-radius: 5px; padding: 5px">
                                <h1>{{$post->title}}</h1>
                                <small>Utworzono: {{$post->created_at}} Aktualizacja: {{$post->updated_at}}</small>
                                <p>{{$post->body}}</p>
                        </div>
                        <br />
                        @endforeach
                </div>
        </div>
@endsection