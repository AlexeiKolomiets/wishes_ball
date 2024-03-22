@extends ('layout')

@section ('content')

    <div class="ball">
        <div class="whitesurface">
            <p id="welcome">Шар предсказаний</p>
        </div>
    </div>
    <div class="inputfield">

        <form method="POST" action="{{ route('auth.perform') }}">
            @csrf
            <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Имя">
            @if ($errors->has('username'))
                <span class="errors">{{ $errors->first('username') }}</span>
            @endif
            <input type="text" name="password" id="password" placeholder="Пароль">
            @if ($errors->has('password'))
                <span class="errors">{{ $errors->first('password') }}</span>
            @endif
            <button type="submit">Войти</button>
        </form>
    </div>
    
@endsection