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
      <span>Dashboad</span>
    </a>
  </li>
  <li class="{{ Request::is('breeds') ? 'active' : '' }}">
    <a href="{{ route('breeds') }}">
      <i class="fa fa-dashboard"></i>
      <span>Acessar Breeds</span>
    </a>
  </li>
  <li class="{{ Request::is('buscar/*') ? 'active' : '' }}">
    <a href="{{ route('search.home') }}">
      <i class="fa fa-dashboard"></i>
      <span>Buscar Breeds</span>
    </a>
  </li>
</ul>
@endsection
