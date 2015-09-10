@extends('app')

@section('content')
<div class="container form-container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="panel panel-default panel-more-shadow">
                <div class="panel-body">
                    <div class="panel-desc">Вход в систему</div>
                    <hr>
                    <form role="form" method="POST" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="name" placeholder="Пользователь"
                                   value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" name="password" placeholder="Пароль">
                        </div>
                        <div class="checkbox m-bot15">
                            <label>
                                <input type="checkbox" name="remember"> Запомнить меня.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Вход</button>
                        <div class="form-group m-top15">
                            <a href="{{ url('/auth/register') }}">Создать запись</a>
                        </div>
                    </form>
                </div>
                {{--
                <div class="panel-footer text-center">--}}
                </div>
            </div>
        </div>
    </div>
    @endsection
