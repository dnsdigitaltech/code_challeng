@extends('admin-lte::layouts.main')

@if (auth()->check())
@section('user-avatar', 'https://www.gravatar.com/avatar/' . md5(auth()->user()->email) . '?d=mm')
@section('user-name', auth()->user()->name)
@endif

@section('breadcrumbs')
@include('admin-lte::layouts.content-wrapper.breadcrumbs', [
  'breadcrumbs' => [
    (object) [ 'title' => 'Home', 'url' => route('home') ]
  ]
])
@endsection

@section('sidebar-menu')
<ul class="sidebar-menu">
  <li class="header">MENU</li>
  <li class="{{ Request::is('home') ? 'active' : '' }}">
    <a href="{{ route('home') }}">
      <i class="fa fa-dashboard"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="{{ Request::is('breeds') ? 'active' : '' }}">
    <a href="{{ route('breeds') }}">
      <i class="fa fa-th-large" aria-hidden="true"></i>
      <span>Acessar Breeds</span>
    </a>
  </li>
  <li class="{{ Request::is('buscar*') ? 'active' : '' }}">
    <a href="{{ route('search.home') }}">
      <i class="fa fa-search" aria-hidden="true"></i>
      <span>Buscar Breeds</span>
    </a>
  </li>
  <li class="header">API/DB</li>
  @if ($status_db_api->on_off == 1)
  <li class="">
    <a href="{{ route('status.db') }}">      
      <span>
        <i class="fa fa-cloud" aria-hidden="true"></i>API
        <img src="{{asset('images/right.png')}}">
        <i class="fa fa-database" aria-hidden="true"></i>DB
      </span>
    </a>
  </li>
  @else
  <li class="">
    <a href="{{ route('status.api') }}" >        
      <span>
        <i class="fa fa-cloud" aria-hidden="true"></i>API
        <img src="{{asset('images/left.png')}}">
        <i class="fa fa-database" aria-hidden="true"></i>DB
      </span>
    </a>
  </li>
  @endif

  
</ul>
@endsection
