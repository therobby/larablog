<nav class="bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-400" style="border-bottom-style: solid; border-bottom-width: 1px; display: flex; align-items: center; justify-content: space-between;">
    <h1 style="margin: 0;"><a href="/">Blogi</a></h1>
    @if(isset($auth) && $auth)
        <a href="/logout">Wyloguj</a>
        <a href="/post/create">Nowy</a>
    @else
        <a href="/login">Zaloguj</a>
        <a href="/register">Zarejestruj</a>
    @endif
</nav>

