@component('mail::message')
    # {{ $nomeSerie }} Criada

    A série {{$nomeSerie}} com {{ $qtdTemporadas }} temporadas e {{ $episodiosPorTemporada }} episodios por temporadas
    foi criada.
    
    Acess aqui:
    @component('mail::button',['url' => route('seasons.index', $idSerie)])
        Ver Serie
    @endcomponent
@endcomponent