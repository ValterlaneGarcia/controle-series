<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $seriesList = Serie::query()->orderBy('nome', 'asc')->get();
        $mensagemSucesso = session('mensagem.sucesso');        

        return view('series.index', compact('seriesList'))
            ->with('mensagemSucesso',$mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $serie = Serie::create($request->all());
        return redirect(route('series.index'))
            ->with("mensagem.sucesso","Série '{$serie->nome}' Adicionada com sucesso");
         
    }

    public function destroy(Serie $series)
    {
        $series->deleteOrFail();
        return redirect(route('series.index'))
            ->with("mensagem.sucesso", "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Serie $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Serie $serie, Request $request)
    {
        $serie->fill($request->all());
        $serie->save();

            return redirect(route('series.index'))->with('mensagem.sucesso', "Série :{$serie->nome} Atualizada com sucesso ");
    }
}
