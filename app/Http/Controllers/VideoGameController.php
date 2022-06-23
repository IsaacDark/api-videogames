<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VideoGame;
use Carbon\Carbon;

class VideoGameController extends Controller
{
    public function index(){
        $videogames = VideoGame::all();


        return response()->json($videogames);
    }


    public function store(Request $request)
    {
        
        $fecha = Carbon::createFromFormat('m/d/Y', $request->get('publication_date'));

        $newVideoGame = new VideoGame([
        'name' => $request->get('name'),
        'publication_date' => $fecha,
        'created_by' => "uno",
        'updated_by' => "dos"
        ]);

        $newVideoGame->save();

        return response()->json($newVideoGame);
    }
}
