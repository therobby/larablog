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
            </div>
            <br />
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
    </script>
@endsection