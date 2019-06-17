<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breed;
use Illuminate\Support\Facades\Storage;
use App\Models\ImgBreed;
use DB;

class BreedController extends Controller
{

    private $breed, $imgbreed;
    /*
    * Construtor da classe
    * @access public
    * @subpackage Breed 
    * @param String $breed
    * @return void
    */
    public function __construct(Breed $breed, ImgBreed $imgbreed)
    {
        $this->breed = $breed;
        $this->imgbreed = $imgbreed;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('home', compact('breeds'));
    }
    public function breeds()
    {
        /////////////////////////LENDO TODAS AS RAÇAS DOS GATOS////////////// 
        $breeds = $this->breed->where('off', '1')->first();    
        //verifica se esta on/off
        if(isset($breeds)==true):
            $url = "";  
        else:
            $url ="https://api.thecatapi.com/v1/breeds";
        endif; 
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "$url",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "x-api-key: d41b51ee-9016-4d12-bea3-20b5d60a9ceb",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err):
            $breeds = $this->breed->get(); 
        else:
            $breeds = json_decode($response);
            ////////////PREPARANDO A RAÇA DO GRATO PARA SALVAR NO DB//////////////
            foreach($breeds as $breed):
                //VERIFICANDO SE o breend  TAl JA FOI baixado/////////
                $date['img']= $this->breed->where('id_breed', $breed->id)->first();    
                //dd($date['img'] == false);  
                if($date['img'] == false ){ 
                    $data['id_breed'] = $breed->id;                                    
                    $data['name'] = $breed->name;
                    $data['weight_imperial'] = $breed->weight->imperial;
                    $data['weight_metric'] = $breed->weight->metric;
                    $data['cfa_url'] = isset($breed->cfa_url) ? $breed->cfa_url : '';
                    $data['vetstreet_url'] = isset($breed->vetstreet_url) ? $breed->vetstreet_url : '';
                    $data['vcahospitals_url'] = isset($breed->vcahospitals_url) ? $breed->vcahospitals_url : '';
                    $data['temperament'] = $breed->temperament;
                    $data['origin'] = $breed->origin;
                    $data['country_codes'] = $breed->country_codes;
                    $data['country_code'] = $breed->country_code;
                    $data['description'] = $breed->description;
                    $data['life_span'] = $breed->life_span;
                    $data['indoor'] = $breed->indoor;
                    $data['lap'] = isset($breed->lap) ? $breed->lap : '0';
                    $data['alt_names'] = isset($breed->alt_names) ? $breed->alt_names : '0';
                    $data['adaptability'] = $breed->adaptability;
                    $data['affection_level'] = $breed->affection_level;
                    $data['child_friendly'] = $breed->child_friendly;
                    $data['dog_friendly'] = $breed->dog_friendly;
                    $data['energy_level'] = $breed->energy_level;
                    $data['grooming'] = $breed->grooming;
                    $data['health_issues'] = $breed->health_issues;
                    $data['intelligence'] = $breed->intelligence;
                    $data['shedding_level'] = $breed->shedding_level;
                    $data['social_needs'] = $breed->social_needs;
                    $data['stranger_friendly'] = $breed->stranger_friendly;
                    $data['vocalisation'] = $breed->vocalisation;
                    $data['experimental'] = $breed->experimental;
                    $data['hairless'] = $breed->hairless;
                    $data['naturalr'] = $breed->natural;
                    $data['rare'] = $breed->rare;
                    $data['rex'] = $breed->rex;
                    $data['suppressed_tail'] = $breed->suppressed_tail;
                    $data['short_legs'] = $breed->short_legs;
                    $data['wikipedia_url'] = isset($breed->wikipedia_url) ? $breed->wikipedia_url : '';
                    ////////////SALVANDO A RAÇA DO GATO NA TABELA//////////////
                    $insert = $this->breed->create($data); 
                }

            endforeach;
        endif;
        return view('breeds', compact('breeds'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($id_breed)
    {
        $breed = $this->breed->where('off', '1')->where('id_breed', $id_breed)->first();  
        
        //verifica se esta on/off
        if(isset($breed)==true):
            $url = "";  
        else:
            $url = "https://api.thecatapi.com/v1/images/search?breed_ids={$breed->id_breed}";
        endif;
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "x-api-key: d41b51ee-9016-4d12-bea3-20b5d60a9ceb",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err):
            //verificar de imagem existe na base e pegar a mesma
            $img = $this->imgbreed->where('breed', $breed->id_breed)->first(); 
            
                //verifica se a imagem esta salva no db   
                if(isset($img) == false):
                    $url = ("https://api.thecatapi.com/v1/images/search?breed_ids={$breed->id_breed}");
                    $curl = curl_init();               
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "$url",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => false,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json",
                            "x-api-key: d41b51ee-9016-4d12-bea3-20b5d60a9ceb",
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err):
                        return redirect()->route('home')->with('error', "OOOPPPSSS! Não é possível baixar as fotos os breeds, pois o servidor está off-line, possivelmente você desativou o mesmo!");
                    else:
                        $imgbreed = json_decode($response);
                    
                        /////efetuando download da imagem e salvando no local////

                        $url = $imgbreed[0]->url;
                        $contents = file_get_contents($url);
                        $name = $breed['id_breed'].'-'.substr($url, strrpos($url, '/') + 1);
                        Storage::put($name, $contents);
                        //////salvando no banco a url da imagem/////
                        $data['url'] = $name;
                        $data['breed'] = $breed->id_breed;
                        $data['breed_id'] = $breed->id;
                        $insert = $this->imgbreed->create($data);
                    endif;
                else:
                    $breeds = $this->breed->pluck('name', 'id_breed'); 
                    //dd($breeds);
                    $breed = $this->breed->where('id_breed', $id_breed)->first();   
                    return view('search', compact('breed', 'img', 'breeds'));  
                endif;        
        else:
            $curl = curl_init();
            $url = "https://api.thecatapi.com/v1/breeds";
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "$url",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "x-api-key: d41b51ee-9016-4d12-bea3-20b5d60a9ceb",
                ),
            ));

            $response_on = curl_exec($curl);
            $err = curl_error($curl); 
            curl_close($curl);

            $breeds = json_decode($response_on);
            //dd($breeds);
            $breed = json_decode($response);      
            return view('search', compact('breed', 'breeds')); 
        endif;

    }

    public function searchTwo(Request $request)
    {
        $id_breed = $request->id_breed;
        $breed = $this->breed->where('off', '1')->where('id_breed', $id_breed)->first(); 
        $curl = curl_init();
        $url = "https://api.thecatapi.com/v1/images/search?breed_ids={$id_breed}";
        curl_setopt_array($curl, array(
            CURLOPT_URL => "",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "x-api-key: d41b51ee-9016-4d12-bea3-20b5d60a9ceb",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err):
            //verificar de imagem existe na base e pegar a mesma
            $img = $this->imgbreed->where('breed', $breed->id_breed)->first(); 
            
                //verifica se a imagem esta salva no db   
                if(isset($img) == false):
                    $url = ("https://api.thecatapi.com/v1/images/search?breed_ids={$breed->id_breed}");
                    $curl = curl_init();               
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "$url",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => false,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json",
                            "x-api-key: d41b51ee-9016-4d12-bea3-20b5d60a9ceb",
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err):
                        return redirect()->route('home')->with('error', "OOOPPPSSS! Não é possível baixar as fotos os breeds, pois o servidor está off-line, possivelmente você desativou o mesmo!");
                    else:
                        $imgbreed = json_decode($response);
                    
                        /////efetuando download da imagem e salvando no local////

                        $url = $imgbreed[0]->url;
                        $contents = file_get_contents($url);
                        $name = $breed['id_breed'].'-'.substr($url, strrpos($url, '/') + 1);
                        Storage::put($name, $contents);
                        //////salvando no banco a url da imagem/////
                        $data['url'] = $name;
                        $data['breed'] = $breed->id_breed;
                        $data['breed_id'] = $breed->id;
                        $insert = $this->imgbreed->create($data);
                    endif;
                else:
                    $breeds = $this->breed->pluck('name', 'id_breed'); 
                    //dd($breeds);
                    $breed = $this->breed->where('id_breed', $id_breed)->first();   
                    return view('search', compact('breed', 'img', 'breeds'));  
                endif; 
        else:
            $curl = curl_init();
            $url = "https://api.thecatapi.com/v1/breeds";
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "$url",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "x-api-key: d41b51ee-9016-4d12-bea3-20b5d60a9ceb",
                ),
            ));

            $response_on = curl_exec($curl);
            $err = curl_error($curl); 
            curl_close($curl);

            $breeds = json_decode($response_on);
            //dd($breeds);
            $breed = json_decode($response);             
            return view('search', compact('breed', 'breeds')); 
        endif;

    }

    public function searchHome()
    {
            $curl = curl_init();
            $url = "https://api.thecatapi.com/v1/breeds";
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$url",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "$url",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "x-api-key: d41b51ee-9016-4d12-bea3-20b5d60a9ceb",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err):
                $breeds = $this->breed->pluck('name', 'id_breed'); 
                //dd($breeds); 
                //dd($breed->name);
                return view('home_search', compact('breed', 'img', 'breeds'));
            else:   
                $breeds = json_decode($response);
                //dd($breeds);      
                return view('home_search', compact('breed', 'breeds')); 
            endif;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /////////////////////////LENDO TODAS AS RAÇAS DOS GATOS//////////////
        $curl = curl_init();

        $url = 'https://api.thecatapi.com/v1/breeds';

        curl_setopt_array($curl, array(
            CURLOPT_URL => "$url",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "x-api-key: d41b51ee-9016-4d12-bea3-20b5d60a9ceb",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err):
            return redirect()->route('home')->with('error', "OOOPPPSSS! Não é possível baixar os breeds, pois o servidor está off-line, possivelmente você desativou o mesmo!");
        else:
            $breeds = json_decode($response);

            ////////////PREPARANDO A RAÇA DO GRATO PARA SALVAR NO DB//////////////
            foreach($breeds as $breed):
                //VERIFICANDO SE o breend  TAl JA FOI baixado/////////
                $date['breed']= $this->breed->where('id_breed', $breed->id)->first();    
                //dd($date['img'] == false);  
                if($date['breed'] == false ){ 
                    $data['id_breed'] = $breed->id;                                    
                    $data['name'] = $breed->name;
                    $data['weight_imperial'] = $breed->weight->imperial;
                    $data['weight_metric'] = $breed->weight->metric;
                    $data['cfa_url'] = isset($breed->cfa_url) ? $breed->cfa_url : '';
                    $data['vetstreet_url'] = isset($breed->vetstreet_url) ? $breed->vetstreet_url : '';
                    $data['vcahospitals_url'] = isset($breed->vcahospitals_url) ? $breed->vcahospitals_url : '';
                    $data['temperament'] = $breed->temperament;
                    $data['origin'] = $breed->origin;
                    $data['country_codes'] = $breed->country_codes;
                    $data['country_code'] = $breed->country_code;
                    $data['description'] = $breed->description;
                    $data['life_span'] = $breed->life_span;
                    $data['indoor'] = $breed->indoor;
                    $data['lap'] = isset($breed->lap) ? $breed->lap : '0';
                    $data['alt_names'] = isset($breed->alt_names) ? $breed->alt_names : '0';
                    $data['adaptability'] = $breed->adaptability;
                    $data['affection_level'] = $breed->affection_level;
                    $data['child_friendly'] = $breed->child_friendly;
                    $data['dog_friendly'] = $breed->dog_friendly;
                    $data['energy_level'] = $breed->energy_level;
                    $data['grooming'] = $breed->grooming;
                    $data['health_issues'] = $breed->health_issues;
                    $data['intelligence'] = $breed->intelligence;
                    $data['shedding_level'] = $breed->shedding_level;
                    $data['social_needs'] = $breed->social_needs;
                    $data['stranger_friendly'] = $breed->stranger_friendly;
                    $data['vocalisation'] = $breed->vocalisation;
                    $data['experimental'] = $breed->experimental;
                    $data['hairless'] = $breed->hairless;
                    $data['naturalr'] = $breed->natural;
                    $data['rare'] = $breed->rare;
                    $data['rex'] = $breed->rex;
                    $data['suppressed_tail'] = $breed->suppressed_tail;
                    $data['short_legs'] = $breed->short_legs;
                    $data['wikipedia_url'] = isset($breed->wikipedia_url) ? $breed->wikipedia_url : '';
                    ////////////SALVANDO A RAÇA DO GATO NA TABELA//////////////
                    $insert = $this->breed->create($data); 
                }

            endforeach; 
            return redirect()->route('home')->with('success', "Os Breeds foram cadastrados com sussesso, agora você acessará off-line!");
        endif;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
