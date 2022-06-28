<?php

namespace App\Http\Controllers;
use App\Http\Resources\VideoGameCollection;
use App\Http\Resources\VideoGameResource;
use Illuminate\Http\Request;
use App\Models\VideoGame;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class VideoGameController extends Controller
{
    public function index(Request $request){
        
        $data = $request->header();

        
        try{

            $userFound = User::where('email', $data['authorization'])->first();

            $videoGames = $userFound->videogames;

            return new VideoGameCollection($videoGames, 200);

        }catch(Exception $e){
            return response()->json(['error' => 'error del servidor'], 500);
        }
    }


    public function store(Request $request){

        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'publication_date' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json(['errors'=>$validator->errors()], 400);
        }
        
        try{

            $fecha = Carbon::createFromFormat('Y-m-d', $data['publication_date']);

            $userFound = User::where('email', $data['email'])->first();

            $newVideoGame = new VideoGame([
            'name' => strtoupper($data['name']),
            'publication_date' => $fecha,
            'user_id' => $userFound->id,
            'created_by' => $userFound->name,
            'updated_by' => null
            ]);

            $newVideoGame->save();

            return new VideoGameResource($newVideoGame, 201);

        }catch(Exception $e){
            return response()->json(['error' => 'error del servidor'], 500);
        }
    }


    public function show($id){

        try{

            $videoGame = VideoGame::findOrFail($id);

            return new VideoGameResource($videoGame, 200);

        }catch(Exception $e){
            return response()->json(['error' => 'error del servidor'], 500);
        }

    }


    public function update(Request $request, $id){

        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'publication_date' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
    
            return response()->json(['errors'=>$validator->errors()], 400);
        }


        try{
            $fecha = Carbon::createFromFormat('Y-m-d', $data['publication_date']);

            $videoGame = VideoGame::findOrFail($id);

            $userFound = User::where('email', $data['email'])->first();

            $videoGame->name = strtoupper($data['name']);
            $videoGame->updated_by = $userFound->name;
            $videoGame->publication_date = $fecha;
            

            $videoGame->save();

            return response()->json($videoGame, 200);
            
        }catch(Exception $e){
            return response()->json(['error' => 'error del servidor'], 500);
        }
    }
}
