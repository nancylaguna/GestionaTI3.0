<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AppController extends Controller
{
    public function index1(){
        // $candidatos = User::all();
        $candidatos=DB::table('candidates')->get();
        return view('candidatos.index',['candidatos'=>$candidatos]);}

    public function index2(){
        return view('graficas.index');}

    public function index3(){
        return view('vacantes.index');}
}
