<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Pagina de Inicio - Tienda";
        return view('home.index')->with("viewData", $viewData);
    }

    public function about()
    {
        $viewData = [];
        $viewData["title"] = "Sobre Nosotros - Tienda";
        $viewData["subtitle"] =  "Sobre Nosotros";
        $viewData["description"] =  "Esta es una tienda dedicada a vender productos sobre impresoras 3D";
        $viewData["author"] = "Desarrollado por: Andrea Diaz Mayol";
        return view('home.about')->with("viewData", $viewData);
    }
}
