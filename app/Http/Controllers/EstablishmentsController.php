<?php

namespace App\Http\Controllers;

use App\Http\Resources\EstablishmentResource;
use App\Models\Establishment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstablishmentsController extends Controller
{
    public function index() 
    {


        // $establishments = (new Establishment)->newQuery();

        // //El metodo filled , permite consultar si existe y esta lleno
        // if(request()->filled('category')) {
        //     $establishments->where('category', request('category'));
        // }
        // return $establishments->paginate(10);


        //Refactorizacion del codigo anterior
        abort_unless(Auth::user()->tokenCan('establishment:show') , 403 , "You dont show establishment");

        $establishments =  Establishment::when(request()->filled('category'), function ($query) {
            $query->where('category' , request('category'));
        })
        ->when(request()->exists('popular'), function ($query) {
            $query->orderBy('starts','Desc');
        })
        ->paginate(10);

        //si quiere mostrar los establecimiento con los productos se agrega ->with('products')
        //nombre de la relacion de los productos

        return EstablishmentResource::collection($establishments);

    }

    public function show(Establishment $establishment) 
    {
        abort_unless(Auth::user()->tokenCan('establishment:show') , 403 , "You dont show establishment");

        $establishment->load('products');

        return  new EstablishmentResource($establishment);
    }





}
