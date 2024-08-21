<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Mail\SeriesCreated;
use App\Models\Series;
use App\Models\User;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    private SeriesRepository $repository;

    public function __construct(SeriesRepository $repository)
    {   
        $this->middleware('auth')
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
        
        

        $userList = User::all();
        foreach ($userList as $user) {
            $email = new SeriesCreated(
                $serie->nome,
                $serie->id,
                $request->seasonsQty,
                $request->episodesPerSeason
            );
            Mail::to($user)->queue($email);
            //sleep(2);
        }
        
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
