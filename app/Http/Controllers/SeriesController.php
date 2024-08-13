<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $seriesList = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');        

        return view('series.index', compact('seriesList'))
            ->with('mensagemSucesso',$mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
       

        $serie = Series::create($request->all());
        return redirect(route('series.index'))
            ->with("mensagem.sucesso","Série '{$serie->nome}' Adicionada com sucesso");
         
    }

    public function destroy(Series $series)
    {
        $series->deleteOrFail();
        return redirect(route('series.index'))
            ->with("mensagem.sucesso", "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {

        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $serie, SeriesFormRequest $request)
    {
        $serie->fill($request->all());
        $serie->save();

            return redirect(route('series.index'))->with('mensagem.sucesso', "Série :{$serie->nome} Atualizada com sucesso ");
    }
}
