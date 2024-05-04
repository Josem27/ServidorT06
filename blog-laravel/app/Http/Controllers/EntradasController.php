<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Entrada;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EntradasController extends Controller
{
    public function listado($page = 0)
    {
        $offset = $page * 3;
        $entradas = Entrada::with('categoria', 'usuario')
            ->skip($offset)
            ->orderBy('fecha', 'desc')
            ->take(3)
            ->get();
        $numFilas = Entrada::count();
        return view('entradas.index', [
            'entradas' => $entradas,
            'page' => $page,
            'contador' => $numFilas,
            'offset' => $offset
        ]);
    }

    public function guardarEntrada(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required'
        ]);
    
        if(Auth::check()) { // Verificar si hay un usuario autenticado
            $entrada = new Entrada;
            $entrada->titulo = $request->titulo;
            $entrada->categoria_id = $request->categoria;
            $entrada->usuario_id = Auth::id(); // Obtener el ID del usuario autenticado
            $entrada->descripcion = $request->descripcion;
    
            if ($imagen = $request->imagen) {
                $nombreFichImg = time() . "-" . $imagen->getClientOriginalName();
                Storage::putFileAs('public/fotos', $imagen, $nombreFichImg);
                Storage::setVisibility($nombreFichImg, 'public');
                $entrada->imagen = $nombreFichImg;
            } else {
                $entrada->imagen = "----";
            }
    
            $log = new Log;
            $log->usuario = Auth::user()->nick; // Obtener el nick del usuario autenticado
            $log->operacion = "Nueva entrada";
            $log->save();
    
            $entrada->save();
            return redirect()->route('entradas', [0])->with('success', 'Entrada creada correctamente');
        } else {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para crear una entrada');
        }
    }

    public function crearEntrada()
    {
        $categorias = Categoria::all();
        return view('entradas.crear', ['categorias' => $categorias]);
    }

    public function detalle($id = -1)
    {
        if ($id != -1) {
            $detalles = Entrada::with('categoria', 'usuario')->where('id', $id)->get();
            return view('entradas.detalle', ['detalles' => $detalles]);
        } else {
            return redirect()->route('entradas', [0]);
        }
    }

    public function eliminar($id = -1)
    {
        if ($id != -1) {
            $detalles = Entrada::with('categoria', 'usuario')->where('id', $id)->get();
            return view('entradas.eliminar', ['detalles' => $detalles]);
        } else {
            return redirect()->route('entradas', [0]);
        }
    }

    public function borrar($id = -1)
    {
        if ($id != -1) {
            Entrada::where('id', $id)->delete();
            $log = new Log;
            $log->usuario = $_SESSION['nick'];
            $log->operacion = "Entrada Eliminada";
            $log->save();
        }
        return redirect()->route('entradas', [0])->with('eliminado', 'Entrada eliminada');
    }

    public function edicion($id = -1)
    {
        if ($id != -1) {
            $categorias = Categoria::all();
            $detalles = Entrada::with('categoria', 'usuario')->where('id', $id)->get();
            return view('entradas.editar', ['detalles' => $detalles, 'categorias' => $categorias]);
        } else {
            return redirect()->route('entradas', [0]);
        }
    }

    public function editar($id = -1, Request $request)
    {
        if ($id != -1) {
            $entrada =  Entrada::find($id);
            $entrada->titulo = $request->titulo;
            $entrada->categoria_id = $request->categoria;
            $entrada->usuario_id = $request->usuario_id;
            $entrada->descripcion = $request->descripcion;

            if ($imagen = $request->imagen) {
                $nombreFichImg = time() . "-" . $imagen->getClientOriginalName();
                Storage::putFileAs('public/fotos', $imagen, $nombreFichImg);
                Storage::setVisibility($nombreFichImg, 'public');
                $entrada->imagen = $nombreFichImg;
            } else {
                $entrada->imagen = "----";
            }

            $log = new Log;
            $log->usuario = $_SESSION['nick'];
            $log->operacion = "Edicion entrada";
            $log->save();


            $entrada->save();
            return redirect()->route('entradas', [0])->with('success', 'Entrada editada correctamente');
        } else {
            return redirect()->route('entradas', [0]);
        }
    }
}