@extends('layouts.app')

@section('content-title', 'Home')
@section('content-subtitle', 'Raças/Breeds<')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Raças/Breeds</h3>
      </div>
      <div class="box-body">
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif
        @if(isset($errors) && $errors->any())
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        You are logged in!
      </div>
    </div>
  </div>
</div>
@endsection
