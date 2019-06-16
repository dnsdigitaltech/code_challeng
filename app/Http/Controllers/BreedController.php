<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breed;
use Illuminate\Support\Facades\Storage;
use DB;

class BreedController extends Controller
{

    private $breed;
    /*
    * Construtor da classe
    * @access public
    * @subpackage Breed 
    * @param String $breed
    * @return void
    */
    public function __construct(Breed $breed)
    {
        $this->breed = $breed;
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

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($id_breed)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thecatapi.com/v1/images/search?breed_ids={$id_breed}",
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
            echo "cURL Error #:" . $err;
        else:
            $breed = json_decode($response);
        endif;
        //dd($breed);
        //dd($breed->breeds->temperament);
        return view('search', compact('breed'));

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

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.thecatapi.com/v1/breeds",
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
            echo "cURL Error #:" . $err;
        else:
            $breeds = json_decode($response);
        endif;
        ////////////PREPARANDO A RAÇA DO GRATO PARA SALVAR NO DB//////////////
        foreach($breeds as $breed):
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

        endforeach; 
       /* if ($insert)
            return redirect()->route('home.')->with('success', "Dados Solvos com sucesso!");
    
        /*foreach($breeds as $breed):
            $id_breed = $breed->id;                                    
            $name = $breed->name;
            $weight_imperial = $breed->weight->imperial;
            $weight_metric = $breed->weight->metric;
            $cfa_url = isset($breed->cfa_url) ? $breed->cfa_url : '';
            $vetstreet_url = isset($breed->vetstreet_url) ? $breed->vetstreet_url : '';
            $vcahospitals_url = isset($breed->vcahospitals_url) ? $breed->vcahospitals_url : '';
            $temperament = $breed->temperament;
            $origin = $breed->origin;
            $country_codes = $breed->country_codes;
            $country_code = $breed->country_code;
            $description = $breed->description;
            $life_span = $breed->life_span;
            $indoor = $breed->indoor;
            $lap = isset($breed->lap) ? $breed->lap : '0';
            $alt_names = isset($breed->alt_names) ? $breed->alt_names : '0';
            $adaptability = $breed->adaptability;
            $affection_level = $breed->affection_level;
            $child_friendly = $breed->child_friendly;
            $dog_friendly = $breed->dog_friendly;
            $energy_level = $breed->energy_level;
            $grooming = $breed->grooming;
            $health_issues = $breed->health_issues;
            $intelligence = $breed->intelligence;
            $shedding_level = $breed->shedding_level;
            $social_needs = $breed->social_needs;
            $stranger_friendly = $breed->stranger_friendly;
            $vocalisation = $breed->vocalisation;
            $experimental = $breed->experimental;
            $hairless = $breed->hairless;
            $naturalr = $breed->natural;
            $rare = $breed->rare;
            $rex = $breed->rex;
            $suppressed_tail = $breed->suppressed_tail;
            $short_legs = $breed->short_legs;
            $wikipedia_url = isset($breed->wikipedia_url) ? $breed->wikipedia_url : '';
            $insert = DB::table('breeds')->insert([
                [
                'id_breed' => $id_breed, 
                'name' => $name,
                'weight_imperial' => $weight_imperial,
                'weight_metric' => $weight_metric,
                'cfa_url' => $cfa_url,
                'vetstreet_url' => $vetstreet_url,
                'vcahospitals_url' => $vcahospitals_url,
                'temperament' => $temperament,
                'origin' => $origin,
                'country_codes' => $country_codes,
                'country_code' => $country_code,
                'description' => $description,
                'life_span' => $life_span,
                'indoor' => $indoor,
                'lap' => $lap,
                'alt_names' =>$alt_names, 
                'adaptability' => $adaptability,
                'affection_level' => $affection_level,
                'child_friendly' => $child_friendly,
                'dog_friendly' => $dog_friendly,
                'energy_level' => $energy_level,
                'grooming' => $grooming,
                'health_issues' => $health_issues,
                'intelligence' => $intelligence,
                'shedding_level' => $shedding_level,
                'social_needs' => $social_needs,
                'stranger_friendly' => $stranger_friendly,
                'vocalisation' => $vocalisation,
                'experimental' => $experimental,
                'hairless' => $hairless,
                'naturalr' => $naturalr,
                'rare' => $rare,
                'rex' => $rex,
                'suppressed_tail' => $suppressed_tail,
                'short_legs' => $short_legs,
                'wikipedia_url' => $wikipedia_url,
                ]
            ]);
        endforeach; 
        */
        return redirect()->route('home')->with('success', "Os Breeds foram cadastrados com sussesso, agora você acessará off-line!");
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
