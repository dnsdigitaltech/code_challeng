@extends('admin-lte::layouts.auth')

@section('content')
<div class="login-box-body">
  <p class="login-box-msg">Entre para iniciar sua sessão</p>

  <form action="{{ route('login') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
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
    <div class="row form-group has-feedback">
      <div class="col-xs-8">
        <div class="icheck">
          <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} value="1"> Lembrar
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
        <button type="submit" class="btn btn-primary btn-block btn-flat"> Entrar <span class="glyphicon glyphicon-log-in"></span></button>
      </div>
      <!-- /.col -->
    </div>
  </form>
  <div class="row">
    <div class="col-xs-8">
          <a href="{{ route('password.request') }}">Esqueci minha senha <span class="glyphicon glyphicon-menu-right"></span></a> 
    </div>
    <!-- /.col -->
    <div class="col-xs-4">
      <a href="{{ route('register') }}" class="text-center">Cadastrar <span class="glyphicon glyphicon-plus-sign"></span></a>
    </div>
  </div>
</div>
@endsection
