<?php

namespace App\Http\Controllers;

use App\Models\Localidades;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocalidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Localidades::all());
    }

    /**
     * Atualiza a base de dados de acordo com a API de localidades do IBGE
     */
    public function ibgeUpdate()
    {
        try {
            // A url esta chumbada aqui por praticidade, correto mesmo seria estar no .env ou ser puxada de alguma base de dados
            // Assim podendo manter atualizações de versão sem precisar mexer no código.
            $ibgeData = Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/33/municipios?view=nivelado")->json();
            $addedCount = 0;
    
            foreach ($ibgeData as $location) {
                if (!Localidades::where('ibge_id', $location['municipio-id'])->exists()) {

                    $localidade = new Localidades();
                    $localidade->ibge_id = $location['municipio-id'];
                    $localidade->ibge_name = $location['municipio-nome'];
                    $localidade->save();
                    $addedCount++;
                }
            }
    
            DB::commit();
    
            return response()->json([
                'message' => "Adicionado: $addedCount novos registros ao banco"
            ]);
        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'error' => 'Erro ao atualizar os registros do IBGE.'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(Localidades::findOrFail($id));
    }

}
