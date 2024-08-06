<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $seriesList = [
            'Punisher',
            'Lost',
            'Grey\'s Anatomy'
        ];

        return view('series.index', compact('seriesList'));
    }

    public function create()
    {
        return view('series.create');
    }
}
