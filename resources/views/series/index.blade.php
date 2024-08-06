<x-layout title="Séries">
    <a href="/series/criar">Adicionar</a>

    <ul>
        @foreach($seriesList as $serie)
            <li>{{ $serie }}</li>
        @endforeach
    </ul>
</x-layout>
