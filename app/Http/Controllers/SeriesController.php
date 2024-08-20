<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    private SeriesRepository $repository;

    public function __construct(SeriesRepository $repository)
    {   
        $this->middleware(Autenticador::class)
            ->except('index');
        $this->repository = $repository;
    }

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
        $serie = $this->repository->add($request);
        
        
        return redirect(route('series.index'))
            ->with("mensagem.sucesso", "Série '{$serie->nome}' adicionada com sucesso");
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

    public function update(int $serie, Request $request)
    {   
        $serie = Series::where('id',$serie)->first();
        
        if($serie)
        {
            $serie->update([
                'nome' => $request->nome,
            ]);
        }

            return redirect(route('series.index'))->with('mensagem.sucesso', "Série :{$serie->nome} Atualizada com sucesso ");
    }
}
