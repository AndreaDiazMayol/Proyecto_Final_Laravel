<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Familia;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\Comentario;


class ProductController extends Controller
{

    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Productos - Tienda";
        $viewData["subtitle"] =  "Lista de Productos";
        $viewData["products"] = Product::All();
        return view('product.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $product = Product::findOrFail($id);
        $viewData["title"] = $product->getName() . " - Tienda";
        $viewData["subtitle"] =  $product->getName() . " - Informacion de Productos";
        $viewData["product"] = $product;
        $viewData["familia"] = $product;

        // Obtener comentarios para el producto actual
        $comentarios = Comentario::where('product_id', $id)->get();
        $viewData["comentarios"] = $comentarios;

        return view('product.show')->with("viewData", $viewData);
    }

    //!Para crear Comentarios
    public function comentarios($id, Request $request)
    {
        if (auth()->check()) {
            $comentario = $request->input('comentario', '');

            if ($comentario != '') {
                // Crea un nuevo comentario en la base de datos con el user_id
                Comentario::create([
                    'product_id' => $id,
                    'user_id' => auth()->id(),
                    'comentario' => $comentario,
                ]);

                return redirect()->route('product.show', ['id' => $id]);
            }
        } else {
            // Usuario no autenticado, muestra una alerta
            session()->flash('alert', 'Debes iniciar sesión para comentar.');
        }

        return redirect()->back();
    }

    //!Para borrar los comentarios

    public function borrarComentario($id, $idComentario)
    {
        // Obtén el comentario desde la base de datos
        $comentario = Comentario::find($idComentario);

        // Verifica si el comentario existe
        if ($comentario) {
            // Borra el comentario de la base de datos
            $comentario->delete();
        }

        // Redirecciona a la página del producto
        return redirect()->route('product.show', ['id' => $id]);
    }



    //!Para buscar por Familia
    public function buscarFamilia(Request $request)
    {
        //Guardamos el valor familia que se le pasó por get
        $familia = $request->input('familia');
        $viewData = [];
        //Buscamos los productos por la familia
        $products = Product::where('familia', $familia)->get();
        //Comprueba si no esta vacia y asigna a viewdata
        if ($products->isNotEmpty()) {
            $viewData["title"] = "Productos - Tienda";
            $viewData["subtitle"] =  $familia;
            $viewData["products"] = $products;
            $viewData["familias"] = Familia::all();
            return view('product.familia')->with("viewData", $viewData);
        }
    }
    public function index1()
    {
        $viewData = [];
        $viewData["title"] = "Productos - Tienda";
        $viewData["subtitle"] =  "Lista de Productos";
        $viewData["products"] = Product::All();
        $viewData["familias"] = Familia::all();
        return view('product.familia')->with("viewData", $viewData);
    }
}
