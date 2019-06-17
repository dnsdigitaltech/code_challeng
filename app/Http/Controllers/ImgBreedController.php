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
     * @subpackage ImgBreed
     * @param String $breed
     * @return void
     */
    public function __construct(ImgBreed $imgbreed, Breed $breed)
    {
        $this->imgbreed = $imgbreed;
        $this->breed = $breed;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //Pega o id do breed na base
        $breeds = $this->breed->get(); 
            //verifica se o sistema esta BD/API Habilitado
            $status = DB::table('status')->where('on_off', '1')->first();
            if (isset($status) == true):
                return redirect()->route('home')->with('error', "OOOPPPSSS! Não é possível baixar as fotos os breeds, pois o servidor está off-line, possivelmente você desativou o mesmo!");
            else:
                foreach($breeds as $breed):       
                    //verifica se a imagem já existe no bd
                    $date['img']= $this->imgbreed->where('breed', $breed['id_breed'])->first();    
                    //caso a imagem não estaja no bd será inserida 
                    if($date['img'] == false ){  
                        $url = "https://api.thecatapi.com/v1/images/search?breed_ids={$breed['id_breed']}";                
                    $curl = curl_init();
                    $url = ("$url");
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
                        //Efetuando download da imagem e salvando no local
                        $url = $imgbreed[0]->url;
                        $contents = file_get_contents($url);
                        $name = $breed['id_breed'].'-'.substr($url, strrpos($url, '/') + 1);
                        Storage::put($name, $contents);
                        //////salvando no banco a url da imagem/////
                        $data['url'] = $name;
                        $data['breed'] = $breed['id_breed'];
                        $data['breed_id'] = $breed['id'];
                        //salvando no banco a url da imagem
                        $insert = $this->imgbreed->create($data); 
                    endif;
                }
                endforeach; 
                return redirect()->route('home')->with('success', "Imagens das raças/breeds cadastradas com sucesso!");
            endif;

        
    }
    
}
