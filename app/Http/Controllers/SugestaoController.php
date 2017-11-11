<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use DB;

class SugestaoController extends Controller
{
    

    /**
     * Formulário para criar uma nova sugestão.
     *
     */
    public function create()
    {
        
        // Retorna página para criar sugestao
		return view('sugestoes/cadastrar')->with(["page" => "sugestao"]);
		
    }


    /**
     * Cadastrar novo objetivo.
     *
     */
    public function store(Request $request)
    {
		
		// Cadastra nova sugestao
		$objetivo = DB::table('sugestoes')->insertGetId([
			'id_usuario'    => Auth::user()->id,
			'tipo'      	=> $request->tipo,
			'comentario' 	=> $request->comentario,
			'status' 		=> 'aberto',
			'updated_by'    => Auth::user()->id
		]);
		
        // Retorna página de objetivos
		return redirect()->action('UsuarioController@mine');
		
    }


    /**
     * Mostrar meus tickets.
     *
     */
    public function meus()
    {
        
        // Retorna página para criar sugestao
		return view('sugestoes/cadastrar')->with(["page" => "sugestao"]);
		
    }


    /**
     * Mostrar todos tickets.
     *
     */
    public function tickets()
    {
        
        $tickets = DB::table('sugestoes')->orderBy('status', 'asc')->paginate(15);

        // Retorna página para ver sugestao
		return view('sugestoes/tickets', ['tickets' => $tickets])->with(["page" => "tickets"]);
		
    }


}
