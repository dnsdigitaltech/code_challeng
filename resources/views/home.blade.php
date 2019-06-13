@extends('layouts.app')

@section('content-title', 'Home')
@section('content-subtitle', 'Raças/Breeds')

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
        <table id="tableRequests" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="tableRequests">
          <thead class="bg-primary">
              <tr>
                  <th>Id</th>
                  <th>Raça</th>
                  <th>Descrição</th>
                  <th>Ver detalhes</th>
              </tr>
          </thead>
          <tbody>
        @forelse ($breeds as $breed)
        <tr>
          <td>{{$id_breed = $breed->id}}</td>  
          <td>{{$breed->name}}</td> 
          <td>{{$breed->description}}</td>   
          
          <td>
            <a href="{{url("/buscar/$id_breed")}}" title="Ver Detalhe da raça - {{$breed->name}}">
                <button class="btn"><i class="fa fa-search" aria-hidden="true"></i></a></button>
            </a>
        </tr>   
        @empty
        <tr>
          <td colspan="90">
              <p>Nenhum Resultado!</p>
          </td>
        </tr>
        @endforelse
        <tbody>
          <tfoot class="bg-primary">
              <tr>
                <tbody>
                  <tfoot class="bg-primary">
                      <tr>
                        <th>Id</th>
                        <th>Raça</th>
                        <th>Descrição</th>
                        <th>Ver detalhes</th>
                      </tr>
                  </tfoot>    
              </table>
              </tr>
          </tfoot>    
      </table>
      </div>
    </div>
  </div>
</div>
@endsection
