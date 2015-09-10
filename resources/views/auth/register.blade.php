@extends('app')
@section('content')

<div class="container form-container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="panel panel-default panel-more-shadow">
                <div class="panel-body">
                    <div class="panel-desc">Создание учетной записи</div>
                    <hr>
                    <form role="form" method="POST" action="{{ url('/auth/register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <input type="text" class="form-control input-lg" name="name" placeholder="Username"
                                   value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-lg" name="email" placeholder="Email"
                                   value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input-lg" name="password_confirmation"
                                   placeholder="Password">
                        </div>
                        <div class="checkbox m-bot15">
                            <label>
                                <input type="checkbox"> Я согласен с<a href="#"> условиями</a>.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary btn-block">Создать</button>
                        <div class="form-group m-top15">
                            <a href="{{ url('/auth/login') }}">Уже есть учетная запись?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection