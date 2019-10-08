<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;

class ComentarioController extends Controller
{
    public function index(){
        $comentarios = Encuesta::paginate(5);
        return view('comentario.index',compact('comentarios'));
    }

    public function getComentarios()
    {
        $data = Encuesta::paginate(5);

        return response()->json($data);
    }
    
}
