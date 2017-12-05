<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Requests\ContatoFormRequest;

class ContatoController extends Controller
{
    //
    public function store(ContatoFormRequest $request) {

    	Mail::send('email',
	        array(
	            'nome' 		=> $request->get('name'),
	            'email' 	=> $request->get('email'),
	            'mensagem' 	=> $request->get('message'),
	            'titulo' 	=> 'Contato pelo Site'
	        ), function($message)
	    {
	        $message->from('no-reply@fonovitta.com.br');
	        $message->to('lineglp@gmail.com', 'Contato Fonovitta')->subject('Nova mensagem de contato');
	    });

    	return response()->json([
            'success' => 'Obrigado pela mensagem!', 'error' => 'teste'
        ]);

    }

}
