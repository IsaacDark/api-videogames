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


    public function store(Request $request){
        
        $fecha = Carbon::createFromFormat('m-d-Y', $request->get('publication_date'));

        $newVideoGame = new VideoGame([
        'name' => $request->get('name'),
        'publication_date' => $fecha,
        'created_by' => "uno",
        'updated_by' => "dos"
        ]);

        $newVideoGame->save();

        return response()->json($newVideoGame);
    }


    public function show($id){

        $videoGame = VideoGame::findOrFail($id);
        return response()->json($videoGame);
    }


    public function update(Request $request, $id){

        $videoGame = VideoGame::findOrFail($id);

        $fecha = Carbon::createFromFormat('m-d-Y', $request->get('publication_date'));

        $videoGame->name = $request->get('name');
        $videoGame->publication_date = $fecha;
        

        $videoGame->save();

        return response()->json($videoGame);
    }
}
