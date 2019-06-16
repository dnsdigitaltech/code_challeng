@extends('layouts.app')

@section('content-title', 'Home')
@section('content-subtitle', 'Raças/Breeds')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Olá <b>{{auth()->user()->name}}</b> bem-vindo ao sistema de Raças/Breeds de Gatos</h3>
      <p>

        @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{session('error')}}
        </div>
        @endif

        <h3>Alguns requisitos básicos para o perfeito funcionamento do sistema off-line:</h3>
        <ol>
          <li>Clique em Baixar Breeds para baixar todas as raças/breeds;</li>
          <li>Para ver melhor o detalhamento off-line de cada raça/breed clique em baixar imagens;</li>
          <li>Após fazer os precedimentos 1 e 2 seu sistema estará totalmente off-line</li>
          <li>Caso você não executar os procedimentos 1 e 2 seu sistema funcionará perfeitamente através da API</li>
        </ol>
        <div class="col-md-12">
          <div class="col-md-3">
            {!!Form::open(['route' => 'create.breed', 'class' => 'form form-search form-ds', 'onsubmit' => 'ShowLoading()', 'method' => 'PUT'])!!}     
              <button type="submit" id="hidenButton" class="btn btn-block btn-warning btn-lg"><i class="fa fa-download" aria-hidden="true"></i> Baixar Breeds</button>
            {!!Form::close()!!} 
          </div>
          <div class="col-md-3">
            {!!Form::open(['route' => 'photos.breed', 'class' => 'form form-search form-ds', 'onsubmit' => 'ShowLoading()', 'method' => 'PUT'])!!}     
              <button type="submit" id="hidenButton" class="btn btn-block btn-danger btn-lg"><i class="fa fa-download" aria-hidden="true"></i> Baixar fotos</button>
            {!!Form::close()!!} 
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-block btn-info btn-lg"><i class="fa fa-list-alt" aria-hidden="true"></i> Acessar Breeds</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-block btn-primary btn-lg"><i class="fa fa-search" aria-hidden="true"></i> Buscar Breeds</button>
          </div>
        </div>
      <p>
      </div>
    </div>
  </div>
</div>
@endsection
