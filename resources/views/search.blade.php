@extends('layouts.app')

@section('content-title', 'Home')
@section('content-subtitle', 'Raças/Breeds')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Raça/Breed - {{$breed[0]->breeds[0]->name}}</h3>
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
        <table align="center" width="418">       
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
@endsection
