@extends('layouts.app')

@section('content-title', 'Home')
@section('content-subtitle', 'Raças/Breeds')

@section('content')
@if (session('success'))
<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  {{ session('success') }}
</div>
@endif  
@if($status_db_api->on_off == 1)
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Buscar por Raça/Breed</h3>
      </div>
      <div class="box-body">
           
        <table align="center" width="418">      
        <tr>
          <td>
          {!!Form::open(['route' => 'searchTwo', 'class' => 'form form-search form-ds', 'onsubmit' => 'ShowLoading()'])!!}  
          {{Form::select('id_breed', $breeds, '' , ['class' =>'form-control'])}}
            <button type="submit" class="btn btn-block btn-info btn-lg"><i class="fa fa-search" aria-hidden="true"></i> Buscar Raça/Breed</button>
          {!!Form::close()!!}
          <hr>
          </td>
        </tr> 
        <tr>
          <td>Escolha Raça/Breed e faça sua busca!</td>  
        </tr>           
      </table>
      </div>
    </div>
  </div>
</div>
@else
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Buscar por Raça/Breed</h3>
      </div>
      <div class="box-body">
        <table align="center" width="418">  
        <tr>
          <td>
          {!!Form::open(['route' => 'searchTwo', 'class' => 'form form-search form-ds', 'onsubmit' => 'ShowLoading()'])!!}  
          
            <select class="form-control" name="id_breed">
              @foreach($breeds as $breed_on)
              <option value="{{$breed_on->id}}">{{$breed_on->name}}</option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-block btn-info btn-lg"><i class="fa fa-search" aria-hidden="true"></i> Buscar Raça/Breed</button>
          {!!Form::close()!!}
          <hr>
          </td>
        </tr>     
        <tr>
          <td><center><h4>Escolha Raça/Breed e faça sua busca!</h4></center></td>  
        </tr>
        <tr>
          <td></td> 
        </tr>        
      </table>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
