@extends('layouts.app')

@section('content-title', 'Home')
@section('content-subtitle', 'Raças/Breeds')

@section('content')
@if(isset($breed->off)==1)
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Raça/Breed - {{$breed->name}}</h3>
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
          <td><img src="{{asset('/storage/'.$img->url)}}" width="418" height="453"></td>  
        </tr>
        <tr>
          <td></td> 
        </tr>
        <tr>
          <td>
            <h4>{{$breed->name}}</h4>
            <p class="bg-info panel">
              <img src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/flags/1x1/{{Str::slug($breed->country_code)}}.svg" class="img-circle" width="30"> 
              <b>{{$breed->origin}}</b> 
              <i><span class="label label-success">{{ $breed->natural == 1 ? 'Natural' : '' }}</span></i> 
              <i><span class="label label-default">{{ $breed->rare == 1 ? 'Rare' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed->rex == 1 ? 'Rex' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed->experimental == 1 ? 'Experimental' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed->hairless == 1 ? 'Hairless' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed->hypoallergenic == 1 ? 'Hypoallergenic' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed->suppressed_tail == 1 ? 'Suppressed Tail' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed->short_legs == 1 ? 'Short Legs' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed->hairless == 1 ? 'Hairless' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed->hairless == 1 ? 'Hairless' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed->hairless == 1 ? 'Hairless' : '' }}</span></i>
            </p>
            <p>{{$breed->description}}</p>
            ---
            <p><i>{{$breed->temperament}}</i></p>
            <table>
              <tr>
                <td><p>Affection Level</p></td>
                <td> 
                  @for( $i= 1 ; $i <= $breed->affection_level ; $i++ )
                  <i class="fa fa-star"></i>
                  @endfor
                </td>
              </tr>
              <tr>
                  <td><p>Adaptability</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed->adaptability ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                  <td><p>Child Friendly</p></td>
                  <td> 
                      @for( $i= 1 ; $i <= $breed->child_friendly ; $i++ )
                      <i class="fa fa-star"></i>
                      @endfor
                    </td>
              </tr>
              <tr>
                <td><p>Dog Friendly</p></td>
                <td> 
                    @for( $i= 1 ; $i <= $breed->dog_friendly ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                </td>
              </tr>
              <tr>
                <td><p>Energy Level</p></td> 
                <td> 
                    @for( $i= 1 ; $i <= $breed->energy_level ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                </td>
              </tr>
              <tr>
                <td><p>Grooming</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed->grooming ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                <td><p>Health Issues</p></td>
                <td> 
                  @for( $i= 1 ; $i <= $breed->health_issues ; $i++ )
                  <i class="fa fa-star"></i>
                  @endfor
                </td>
              </tr>
              <tr>
                <td><p>Intelligence</p></td>
                <td> 
                  @for( $i= 1 ; $i <= $breed->intelligence ; $i++ )
                  <i class="fa fa-star"></i>
                  @endfor
                </td>
              </tr>
              <tr>
                <td><p>Shedding Level</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed->shedding_level ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                <td><p>Social Needs</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed->social_needs ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                <td><p>Stranger Friendly</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed->stranger_friendly ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                <td><p>Vocalisatio</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed->vocalisation ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
            </table>

            @if(isset($breed->cfa_url))
            <p><a href="{{$breed->cfa_url}}" class="btn btn-info" target="_blank">CFA</a></p>
            @endif
            @if(isset($breed->vetstreet_url))
            <p><a href="{{$breed->vetstreet_url}}" class="btn btn-info" target="_blank">VETSTREET</a></p>
            @endif
            @if(isset($breed->vcahospitals_url))
            <p><a href="{{$breed->vcahospitals_url}}" class="btn btn-info" target="_blank">VCAHOSPITALS</a></p>
            @endif
            @if(isset($breed->wikipedia_url))
            <p><a href="{{$breed->wikipedia_url}}" class="btn btn-info" target="_blank">WIKIPEDIA</a></p>
            @endif
          </td>
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
        <h3 class="box-title">Raça/Breed - {{$breed[0]->breeds[0]->name}}</h3>
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
          <td><img src="{{$breed[0]->url}}" width="418" height="453"></td>  
        </tr>
        <tr>
          <td></td> 
        </tr>
        <tr>
          <td>
            <h4>{{$breed[0]->breeds[0]->name}}</h4>
            <p class="bg-info panel">
              <img src="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/flags/1x1/{{Str::slug($breed[0]->breeds[0]->country_code)}}.svg" class="img-circle" width="30"> 
              <b>{{$breed[0]->breeds[0]->origin}}</b> 
              <i><span class="label label-success">{{ $breed[0]->breeds[0]->natural == 1 ? 'Natural' : '' }}</span></i> 
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->rare == 1 ? 'Rare' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->rex == 1 ? 'Rex' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->experimental == 1 ? 'Experimental' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->hairless == 1 ? 'Hairless' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->hypoallergenic == 1 ? 'Hypoallergenic' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->suppressed_tail == 1 ? 'Suppressed Tail' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->short_legs == 1 ? 'Short Legs' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->hairless == 1 ? 'Hairless' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->hairless == 1 ? 'Hairless' : '' }}</span></i>
              <i><span class="label label-default">{{ $breed[0]->breeds[0]->hairless == 1 ? 'Hairless' : '' }}</span></i>
            </p>
            <p>{{$breed[0]->breeds[0]->description}}</p>
            ---
            <p><i>{{$breed[0]->breeds[0]->temperament}}</i></p>
            <table>
              <tr>
                <td><p>Affection Level</p></td>
                <td> 
                  @for( $i= 1 ; $i <= $breed[0]->breeds[0]->affection_level ; $i++ )
                  <i class="fa fa-star"></i>
                  @endfor
                </td>
              </tr>
              <tr>
                  <td><p>Adaptability</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed[0]->breeds[0]->adaptability ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                  <td><p>Child Friendly</p></td>
                  <td> 
                      @for( $i= 1 ; $i <= $breed[0]->breeds[0]->child_friendly ; $i++ )
                      <i class="fa fa-star"></i>
                      @endfor
                    </td>
              </tr>
              <tr>
                <td><p>Dog Friendly</p></td>
                <td> 
                    @for( $i= 1 ; $i <= $breed[0]->breeds[0]->dog_friendly ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                </td>
              </tr>
              <tr>
                <td><p>Energy Level</p></td> 
                <td> 
                    @for( $i= 1 ; $i <= $breed[0]->breeds[0]->energy_level ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                </td>
              </tr>
              <tr>
                <td><p>Grooming</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed[0]->breeds[0]->grooming ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                <td><p>Health Issues</p></td>
                <td> 
                  @for( $i= 1 ; $i <= $breed[0]->breeds[0]->health_issues ; $i++ )
                  <i class="fa fa-star"></i>
                  @endfor
                </td>
              </tr>
              <tr>
                <td><p>Intelligence</p></td>
                <td> 
                  @for( $i= 1 ; $i <= $breed[0]->breeds[0]->intelligence ; $i++ )
                  <i class="fa fa-star"></i>
                  @endfor
                </td>
              </tr>
              <tr>
                <td><p>Shedding Level</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed[0]->breeds[0]->shedding_level ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                <td><p>Social Needs</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed[0]->breeds[0]->social_needs ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                <td><p>Stranger Friendly</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed[0]->breeds[0]->stranger_friendly ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
              <tr>
                <td><p>Vocalisatio</p></td>
                  <td> 
                    @for( $i= 1 ; $i <= $breed[0]->breeds[0]->vocalisation ; $i++ )
                    <i class="fa fa-star"></i>
                    @endfor
                  </td>
              </tr>
            </table>

            @if(isset($breed[0]->breeds[0]->cfa_url))
            <p><a href="{{$breed[0]->breeds[0]->cfa_url}}" class="btn btn-info" target="_blank">CFA</a></p>
            @endif
            @if(isset($breed[0]->breeds[0]->vetstreet_url))
            <p><a href="{{$breed[0]->breeds[0]->vetstreet_url}}" class="btn btn-info" target="_blank">VETSTREET</a></p>
            @endif
            @if(isset($breed[0]->breeds[0]->vcahospitals_url))
            <p><a href="{{$breed[0]->breeds[0]->vcahospitals_url}}" class="btn btn-info" target="_blank">VCAHOSPITALS</a></p>
            @endif
            @if(isset($breed[0]->breeds[0]->wikipedia_url))
            <p><a href="{{$breed[0]->breeds[0]->wikipedia_url}}" class="btn btn-info" target="_blank">WIKIPEDIA</a></p>
            @endif
          </td>
        </tr>
           
      </table>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
