<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Breed;
use App\Models\ImgBreed;
use Illuminate\Support\Facades\Storage;
use DB;

class ImgBreedController extends Controller
{

    private $imgbreed, $breed;
    /*
    * Construtor da classe
    * @access public
    * @subpackage Breed 
    * @param String $breed
    * @return void
    */
    public function __construct(ImgBreed $imgbreed, Breed $breed)
    {
        $this->imgbreed = $imgbreed;
        $this->breed = $breed;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

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
        foreach($breeds as $breed):
            $data['id_breed'] = $breed->id;   
            //Pegando o ID do breed local para salvar na FK img_breed////
            $date['breed'] = $this->breed->where('id_breed', $data['id_breed'])->first(); 
            if(isset($date['breed'])==false){
                return redirect()->route('home')->with('error', "OOOPPPSSS! Atualize todas as raças/breeds, antes de baixar as imagens!");
            }        
            //VERIFICANDO SE A IMAGEM DE TAl RAÇA JA FOI BAIXADA/////////
            $date['img']= $this->imgbreed->where('breed', $data['id_breed'])->first();      
            if($date['img'] == true ){
            }else{                              
            ///////////PEGANDO O ID DA RAÇA PARA BUSCAR A IMAGEM///////
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.thecatapi.com/v1/images/search?breed_ids={$data['id_breed']}",
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
                $imgbreed = json_decode($response);
            endif;
            
            /////efetuando download da imagem e salvando no local////

            $url = $imgbreed[0]->url;
            $contents = file_get_contents($url);
            $name = $data['id_breed'].'-'.substr($url, strrpos($url, '/') + 1);
            Storage::put($name, $contents);
            //////salvando no banco a url da imagem/////
            $data['url'] = $name;
            $data['breed'] = $data['id_breed'];
            $data['breed_id'] = $date['breed']->id;
            $insert = $this->imgbreed->create($data); 
        }
        endforeach; 
        return redirect()->route('home')->with('success', "Imagens das raças/breeds atualizadas com sucesso!");
        
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
   /* public function create()
    {

    }*/

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
