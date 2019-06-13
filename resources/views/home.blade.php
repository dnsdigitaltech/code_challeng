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
        @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{session('error')}}
        </div>
        @endif
        You are logged in!
      </div>
    </div>
  </div>
</div>
@endsection
