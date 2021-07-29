@extends('pagestruct.body')
@section('content')
    <div class="text-gray-600 dark:text-gray-400 " style="border: 1px; border-style: groove; border-radius: 5px; padding: 5px; display: flex; flex-direction: column;">
        <form action="/register" method="post" style="display: contents;">
        {{csrf_field()}}
        <label>Imie i nazwisko</label>
        <input value="{{old('name')}}" name="name">
        <br />
        <label>Email</label>
        <input type="email" value="{{old('email')}}" name="email">
        <br />
        <label>Hasło</label>
        <input type="password" value="" name="password">
        <br />
        <input type="submit" value="Zarejestruj">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        </form>
    </div>
@endsection