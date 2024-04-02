<?php

namespace App\Http\Controllers;

use App\Models\Localidades;
use Http;
use Illuminate\Http\Request;

class LocalidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return request()->json(Localidades::all());
    }

    /**
     * Atualiza a base de dados de acordo com a API de localidades do IBGE
     */
    public function ibgeUpdate()
    {
        $ibge_localidade = json_decode(Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/33/municipios?view=nivelado")->body());
        foreach ($ibge_localidade as $ibge_localicades) {
            $nova_localidade = new Localidades([
                'ibge_id' => $ibge_localicades['municipio-id'],
                'ibge_nome' => $ibge_localicades['municipio-nome']
            ]);
            dd($nova_localidade);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return request()->json(Localidades::findOrFail($id));
    }

}
