<?php

namespace App\Http\Controllers;

use App\Adresar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class AdresarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $adresar = new Adresar;

        $adresar->ime = $request->ime;
        $adresar->prezime = $request->prezime;
        $adresar->pol = $request->pol;
        $adresar->ulica = $request->ulica;
        $adresar->postanskiBroj = $request->postanskiBroj;
        $adresar->grad = $request->grad;
        $adresar->zemlja = $request->zemlja;
        $adresar->punoletan = $request->punoletan;


        try {
            $adresar->saveOrFail();
        } catch (\Throwable $e) {
            return "greska pri unosu";
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Adresar  $adresar
     * @return \Illuminate\Http\Response
     */
    public function show(Adresar $adresar)
    {
        $adresar = Adresar::all();

        return response()->json(array('data' => $adresar)) ;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Adresar  $adresar
     * @return \Illuminate\Http\Response
     */
    public function edit(Adresar $adresar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Adresar  $adresar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adresar $adresar)
    {
        $adresar = Adresar::find($request->id);


        if($request->ime != ""){
            $adresar->ime = $request->ime;
        }
        if($request->prezime != ""){
            $adresar->prezime = $request->prezime;
        }
        if($request->pol != ""){
            $adresar->pol = $request->pol;
        }
        if($request->ulica != ""){
            $adresar->ulica = $request->ulica;
        }
        if($request->postanskiBroj != ""){
            $adresar->postanskiBroj = $request->postanskiBroj;
        }
        if($request->grad != ""){
            $adresar->grad = $request->grad;
        }
        if($request->zemlja != ""){
            $adresar->zemlja = $request->zemlja;
        }
        $adresar->punoletan = $request->punoletan;

        try {
            $adresar->saveOrFail();
        } catch (\Throwable $e) {
            return "greska pri azuriranju";
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Adresar  $adresar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $adresar = Adresar::find($request->id);
       $adresar->delete();

    }


}
