@extends('admin-lte::layouts.auth')

@section('content')
@if (session('status'))
<div class="callout callout-info">
  {{ session('status') }}
</div>
@endif

<div class="login-box-body">
  <p class="login-box-msg">Redefinição de senha</p>

  <form action="{{ route('password.email') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      @if ($errors->has('email'))
      <span class="help-block">{{ $errors->first('email') }}</span>
      @endif
    </div>
    <div class="row">
      <div class="col-md-12">
        <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar o link de redefinição de senha</button>
        <a href="{{ route('login') }}"><span class="glyphicon glyphicon-arrow-left" title="Voltar"></span></a>
      </div>
      <!-- /.col -->
    </div>
  </form>

</div>
<!-- /.login-box-body -->
@endsection
