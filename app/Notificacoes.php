<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;

class Notificacoes extends Model
{
    
    //
	public function getNotificacoes(){

		$notificacoes = DB::table('notificacao')
						->where('id_usuario', Auth::user()->id)
						->where('status', 'Novo')
						->get();

    	return $notificacoes;

	}

	public function getQntNotificacoes(){

		$qnt_notificacao = DB::table('notificacao')
						->where('id_usuario', Auth::user()->id)
						->where('status', 'Novo')
						->count();

    	return $qnt_notificacao;

	}


}
