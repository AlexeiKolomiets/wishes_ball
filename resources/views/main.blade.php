@extends ('layout')

@section ('content')

    @if (\Session::has('message'))
        <div class="welcome-message">
            <p>{!! \Session::get('message') !!}</p>
        </div>
    @else
        <div class="welcome-message">
            <p>{!! \Auth::user()->username !!}</p>
        </div>
    @endif

    <div class="ball">
        <div class="whitesurface">
            <p id="response">Задай свой вопрос</p>
        </div>
    </div>
    <div class="inputfield">
        <form action="" method="post">
            @csrf
            <input type="text" name="question" id="question" placeholder="...?">
            <button type="submit" id="btn-question">Получить ответ</button>
        </form>
    </div>
    <div class="counts">
    </div>

@endsection