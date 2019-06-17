<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\ImgBreed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;

class BreedController extends Controller
{

    private $breed, $imgbreed;
    /*
     * Construtor da classe
     * @access public
     * @subpackage Breed
     * @subpackage ImgBreed
     * @param String $breed
     * @return void
     */
    public function __construct(Breed $breed, ImgBreed $imgbreed)
    {
        $this->breed = $breed;
        $this->imgbreed = $imgbreed;
    }

    /**
     * pagina dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Exibir o menu BD/API Habilitado
        $status_db_api = DB::table('status')->first();
        return view('home', compact('breeds', 'status_db_api'));
    }

    /**
     * Ler API Breends e salva no DB
     *
     * @return \Illuminate\Http\Response
     */
    public function breeds()
    {
        //verifica se o sistema esta BD/API Habilitado
        $status = DB::table('status')->where('on_off', '1')->first();
        if (isset($status) == true):
            $url = "";
        else:
            $url = "https://api.thecatapi.com/v1/breeds";
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
            //Se $status true a url API não existe o sistema consultará off no db
            $breeds = $this->breed->get();
        else:
            $breeds = json_decode($response);
            //Preparando a raça/breed para salvar no db
            foreach ($breeds as $breed):
                //Verificando se a raça/breed ja está salva no db
                $date['img'] = $this->breed->where('id_breed', $breed->id)->first();  
                //Verifica se a raça/breed nã esiste na base, caso (false) encapsula os dados e salva              
                if ($date['img'] == false) {
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
                    //Salvando a raça/breed no db
                    $insert = $this->breed->create($data);
                }
            endforeach;
        endif;
        //Exibir o menu BD/API Habilitado
        $status_db_api = DB::table('status')->first();
        return view('breeds', compact('breeds','status_db_api'));
    }

    /**
     * Buscar a imagem da raça/breed para mostrar o detalhe
     *
     * @param  int  $id_breed
     * 
     * @return \Illuminate\Http\Response
     */
    public function search($id_breed)
    {
        //verifica se o sistema esta BD/API Habilitado
        $status = DB::table('status')->where('on_off', '1')->first();
        
        if (isset($status) == true):
            $url = "";
        else:
            $url = "https://api.thecatapi.com/v1/images/search?breed_ids={$id_breed}";
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
            $img = $this->imgbreed->where('breed', $id_breed)->first();
            //verifica se a imagem não existe no db
            if (isset($img) == false):
                $url = ("https://api.thecatapi.com/v1/images/search?breed_ids={$id_breed}");
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
                    return redirect()->route('home')->with('error', "OOOPPPSSS! Não é possível baixar as fotos dos breeds, pois o servidor está off-line, possivelmente você desativou o mesmo!");
                else:
                    $imgbreed = json_decode($response);
                    //Efetuando download da imagem e salvando no local
                    $url = $imgbreed[0]->url;
                    $contents = file_get_contents($url);
                    $name = $id_breed . '-' . substr($url, strrpos($url, '/') + 1);
                    Storage::put($name, $contents);
                    //Seleciona o breed específico e buscar o id breed para salvar na FK migration img_breed
                    $breed = $this->breed->where('id_breed', $id_breed)->first();
                    //salvando no banco a url da imagem
                    $data['url'] = $name;
                    $data['breed'] = $id_breed;
                    $data['breed_id'] = $breed->id;
                    $insert = $this->imgbreed->create($data);
                    //Exibir os breeds no select acima da imagem
                    $breeds = $this->breed->pluck('name', 'id_breed');
                    //pega a url img depois que salvou na base
                    $img = $this->imgbreed->where('breed', $id_breed)->first();
                    //Exibir o menu BD/API Habilitado
                    $status_db_api = DB::table('status')->first();
                    return view('search', compact('breed', 'img', 'breeds', 'status_db_api'));
                endif;
            else:
                //Seleciona os breeds para pupular o select acima da imagem
                $breeds = $this->breed->pluck('name', 'id_breed');
                //Seleciona o breed específico
                $breed = $this->breed->where('id_breed', $id_breed)->first();
                //Exibir o menu BD/API Habilitado
                $status_db_api = DB::table('status')->first();
                return view('search', compact('breed', 'img', 'breeds', 'status_db_api'));
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
            //Traz os breeds para pulupar o select acima da imagem 
            $breeds = json_decode($response_on);
            //Traz o breed específico
            $breed = json_decode($response);
            //Exibir o menu BD/API Habilitado
            $status_db_api = DB::table('status')->first();
            return view('search', compact('breed', 'breeds','status_db_api'));
        endif;

    }

    /**
     * Buscar a imagem da raça/breed para mostrar o detalhe
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function searchTwo(Request $request)
    {
        //Pegar o id_breed via Request
        $id_breed = $request->id_breed;
        //Verifica se o sistema esta BD/API Habilitado
        $status = DB::table('status')->where('on_off', '1')->first();        
        if (isset($status) == true):
            $url = "";
        else:
            $url = "https://api.thecatapi.com/v1/images/search?breed_ids={$id_breed}";
        endif;
        $curl = curl_init();
        $url = "$url";
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
            //Verificar de imagem existe na base e pegar a mesma
            $img = $this->imgbreed->where('breed', $id_breed)->first();

            //Verifica se a imagem esta salva no db
            if (isset($img) == false):
                $url = ("https://api.thecatapi.com/v1/images/search?breed_ids={$id_breed}");
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

                    //Efetuando download da imagem e salvando no local
                    $url = $imgbreed[0]->url;
                    $contents = file_get_contents($url);
                    $name = $id_breed . '-' . substr($url, strrpos($url, '/') + 1);
                    Storage::put($name, $contents);
                    //Seleciona o breed específico e buscar o id breed para salvar na FK migration img_breed
                    $breed = $this->breed->where('id_breed', $id_breed)->first();
                    //Salvando no banco a url da imagem
                    $data['url'] = $name;
                    $data['breed'] = $id_breed;
                    $data['breed_id'] = $breed->id;
                    $insert = $this->imgbreed->create($data);
                    //Exibir os breeds no select acima da imagem
                    $breeds = $this->breed->pluck('name', 'id_breed');
                    //pega a url img depois que salvou na base
                    $img = $this->imgbreed->where('breed', $id_breed)->first();
                    //Exibir o menu BD/API Habilitado
                    $status_db_api = DB::table('status')->first();
                    return view('search', compact('breed', 'img', 'breeds', 'status_db_api'));
                endif;
            else:
                //Seleciona os breeds para pupular o select acima da imagem
                $breeds = $this->breed->pluck('name', 'id_breed');
                //Seleciona o breed específico
                $breed = $this->breed->where('id_breed', $id_breed)->first();
                //Exibir o menu BD/API Habilitado
                $status_db_api = DB::table('status')->first();
                return view('search', compact('breed', 'img', 'breeds', 'status_db_api'));
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
            //Traz os breeds para pulupar o select acima da imagem 
            $breeds = json_decode($response_on);
            //Traz o breed específico
            $breed = json_decode($response);
            //Exibir o menu BD/API Habilitado
            $status_db_api = DB::table('status')->first();
            return view('search', compact('breed', 'breeds', 'status_db_api'));
        endif;

    }

    /**
     * pagina buscar sem parâmentros
     * 
     * @return \Illuminate\Http\Response
     */

    public function searchHome()
    {
        //Verifica se o sistema esta BD/API Habilitado
        $status = DB::table('status')->where('on_off', '1')->first();  
        if (isset($status) == true):
            $url = "";
        else:
            $url = "https://api.thecatapi.com/v1/breeds";
        endif;
        $curl = curl_init();
        $url = "$url";
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
            //Exibir os breeds no select acima da imagem
            $breeds = $this->breed->pluck('name', 'id_breed');
            //Exibir o menu BD/API Habilitado
            $status_db_api = DB::table('status')->first();
            return view('home_search', compact('img', 'breeds', 'status_db_api'));
        else:
            //Traz o breed específico
            $breeds = json_decode($response);
            //Exibir o menu BD/API Habilitado
            $status_db_api = DB::table('status')->first();
            return view('home_search', compact('breeds','status_db_api'));
        endif;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //verifica se o sistema esta BD/API Habilitado
        $status = DB::table('status')->where('on_off', '1')->first();
        if (isset($status) == true):
            $url = "";
        else:
            $url = "https://api.thecatapi.com/v1/breeds";
        endif;
        $curl = curl_init();
        $url = "$url";
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
            //preparando para salvar os breeds no bd
            foreach ($breeds as $breed):
                //verificando se o breed já está salvo bd
                $date['breed'] = $this->breed->where('id_breed', $breed->id)->first();
                //caso o bred não está no banco ele salva
                if ($date['breed'] == false) {
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
                    //salvando os breeds no bd
                    $insert = $this->breed->create($data);
                }

            endforeach;
            return redirect()->route('home')->with('success', "Os Breeds foram cadastrados com sucesso, agora você acessará off-line!");
        endif;
    }

    /**
     * BD/API Habilita/Desabilita.
     *
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
         //Habilitar o sistema para BD/API
         $status = DB::table('status')->where('on_off', '0')->first();
         if ($status == true):
            //Insere 1 para o campo on_off da tabela status (BD)
             DB::table('status')->update(['on_off' => 1]);
             return redirect()->back()->with('success', "Banco de Dados foi habilitado");
         else:
             //Insere 0 para o campo on_off da tabela status (API)
             DB::table('status')->update(['on_off' => 0]);
             return redirect()->back()->with('success', "API foi habilitada");
         endif;
    }
}
