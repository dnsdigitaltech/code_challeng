@extends('admin-lte::layouts.auth')

@section('content')
<div class="login-box-body">
  <p class="login-box-msg">Cadastrar novo usuário</p>

  <form action="{{ route('register') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome Completo" required autofocus>
      <span class="glyphicon glyphicon-user form-control-feedback"></span>
      @if ($errors->has('name'))
      <span class="help-block">{{ $errors->first('name') }}</span>
      @endif
    </div>
    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      @if ($errors->has('email'))
      <span class="help-block">{{ $errors->first('email') }}</span>
      @endif
    </div>
    <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
      <input id="password" type="password" class="form-control" name="password" placeholder="Senha" required>
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      @if ($errors->has('password'))
      <span class="help-block">{{ $errors->first('password') }}</span>
      @endif
    </div>
    <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repetir Senha" required>
      <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
    </div>
    <div class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Cadastrar <span class="glyphicon glyphicon-ok-sign"></span></button>
      </div>
      <!-- /.col -->
    </div>
  </form>
  <a href="{{ route('login') }}" class="text-center">Já possuo cadastro</a>
</div>
<!-- /.form-box -->
@endsection
