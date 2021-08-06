@extends('pagestruct.body')
@section('content')
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
            <div style="border: 1px; border-style: groove; border-radius: 5px; padding: 5px">
                <h1>{{$post->title}}</h1>
                <div style="display: flex;">
                        Utworzono: 
                        <div name="date_created" style="padding: 0 10px 0 5px;">{{date(DATE_ATOM,strtotime($post->created_at))}}</div> 
                        Aktualizacja:
                        <div name="date_updated" style="padding: 0 0 0 5px;">{{date(DATE_ATOM,strtotime($post->updated_at))}}</div>
                </div>
                <p>{{$post->body}}</p>
                @if ($author || $is_admin)
                <hr style="border-width: 1px;">
                <a href="/post/{{$post->id}}/edit">Edytuj</a>
                <a href="/post/{{$post->id}}/delete" onclick="del(event);">Usuń</a>
                @endif
                <hr style="border-width: 1px;">
                @if(isset($auth) && $auth)
                    Napisz komentarz:
                        <br>
                    <form action="/post/{{$post->id}}/comment" method="POST">
                        {{csrf_field()}}
                            <input type="text" name="comment">
                            <input type="submit" value="Wyślij">
                    </form>
                @else
                    Aby zamieścić komentarz, musisz się zalogować.
                @endif
                <br>
                @foreach ($comments as $comment)
                <div style="border: 1px; border-style: groove; border-radius: 5px; padding: 5px">
                        <small>Author: {{$comment->user->name}} &emsp; Date: {{$comment->created_at}}</small>
                        <p>{{$comment->body}}</p>
                        @if ($comment->user->id == $user_id || $is_admin)
                            <form action="/comment/{{$comment->id}}/delete" method="post">
                                {{csrf_field()}}
                                <input type="submit" value="Usuń">
                            </form> 
                        @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
            window.onload = ()=>{
                    let dcreated = document.getElementsByName("date_created"),
                            dupdated = document.getElementsByName("date_updated");

                    dcreated.forEach(element=>{
                            element.innerHTML = (new Date(element.innerHTML)).toLocaleString();
                    });
                    dupdated.forEach(element=>{
                            element.innerHTML = (new Date(element.innerHTML)).toLocaleString();
                    });
            }

            function del(event) {
                $conf = confirm("Czy na pewno chcesz usunąć?");
                if(!$conf) {
                        event.preventDefault();
                }
            }
    </script>
@endsection