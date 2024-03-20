@extends ('layout')

@section ('content')

        <h1>Хотите задать вопрос Шару желаний?</h1>
        <form method="POST" action="login">
        <label for="name">Введите свое имя</label>
        <input type="text" name="name" id="name">
        <label for="password" name="password" id="password">Пароль</label>
        <input type="text" name="password" id="password">
        <button type="submit">Войти</button>
    </form>
    
@endsection