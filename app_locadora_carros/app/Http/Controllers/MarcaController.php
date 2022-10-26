<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Repositories\MarcaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $marcaRepository = new MarcaRepository($this->marca);

        if($request->has('atributos_modelos')) {
            $atributos_modelos = 'modelo:id,'.$request->atributos_modelos;
            $marcaRepository->selectAtributosRegistrosRelacionamentos($atributos_modelos);
        } else {
            $marcaRepository->selectAtributosRegistrosRelacionamentos('modelo');
        }

        if($request->has('filtro')) {
            $marcaRepository->filtro($request->filtro);
        }

        if($request->has('atributos')) { // atributos:id,nome, imagem
            $marcaRepository->selectAtributos($request->atributos);
        }

        // ------------------------------------------
       /*
        $marcas = array();
        if($request->has('atributos_modelos')) {
            $atributos_modelos = $request->atributos_modelos;
            $marcas = $this->marca->with('modelo:id,'.$atributos_modelos);
        } else {
            $marcas = $this->marca->with('modelo');
        }

        if($request->has('filtro')) {
            $filtros = explode(';', $request->filtro);
            foreach($filtros as $key => $condicao) {
                $c = explode(':', $condicao);
                $marcas = $marcas->where($c[0], $c[1], $c[2]);
            }
        }

        if($request->has('atributos')) { // atributos:id,nome, imagem
            $atributos = $request->atributos;
            $marcas = $marcas->selectRaw($atributos)->get();
        } else {
            $marcas = $marcas->get();
        }
       */

        //$marcas = Marca::all();
        //$marcas = $this->marca->with('modelos')->get();
        //return response()->json($marcas, 200);
        // return response()->json($marcaRepository->getResultado(), 200);
        return response()->json($marcaRepository->getResultadoPaginado(3), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->marca->rules(), $this->marca->feedback());

        $image = $request->file('imagem');
        $image_uri = $image->store('imagens', 'public');
        // dd($image_uri); // "imagens/8UM1FA1QVjkp9BGHqx2Tr87rrqTqYcfkvm6QHGLJ.png"


//        $marca->nome = $request->nome;
//        $marca->imagem = $image_uri;
//        $marca->save();
        $marca = $this->marca->create([
            'nome' => $request->nome,
            'imagem' => $image_uri
        ]);

        //$marca = $this->marca->create($request->all());
        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = $this->marca->with('modelo')->find($id);

        if ($marca === null) {
            return response()->json(['error' => 'Recurso Não Existe'], 404);
        }

        return response()->json($marca, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Marca $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        print_r($request->all()); // dados atualizados
//        echo '<hr>';
//        print_r($marca->getAttributes()); // dados antigos

        // $marca->update($request->all());
        $marca = $this->marca->with('modelo')->find($id);

        if ($marca === null) {

            return response()->json(['error' => 'Recurso Não Existe para ser Atualizado!'], 404);
        }

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($marca->rules() as $input => $regra) {
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $marca->feedback());

        } else {
            $request->validate($marca->rules(), $marca->feedback());
        }

        // REMOVE o arquivo antigo caso um novo arquivo tenha sido
        // enviado no REQUEST
        if ($request->file('imagem')) {
            Storage::disk('public')->delete($marca->imagem);
        }

        $image = $request->file('imagem');
        $image_uri = $image->store('imagens', 'public');

        //preencher o objeto $marca com os dados do request
        $marca->fill($request->all());
        $marca->imagem = $image_uri;

        //dd($marca->getAttributes());
        $marca->save();
        /*
        $marca->update([
            'nome' => $request->nome,
            'imagem' => $image_uri
        ]);*/

        return response()->json($marca, 200);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$marca->delete();
        $marca = $this->marca->find($id);

        if ($marca === null) {
            return response()->json(['error' => 'Recurso Não Existe para ser DELETADO!'], 404);
        }

        // REMOVE o arquivo antigo
        Storage::disk('public')->delete($marca->imagem);

        $marca->delete();
        return response()->json(['msg' => 'Marca removida com sucesso'], 200);
    }
}
