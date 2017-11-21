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
     * Cadastrar nova Sugestão.
     *
     */
    public function store(Request $request)
    {
		
		// Cadastra nova sugestao
		$sugestao = DB::table('sugestoes')->insertGetId([
			'id_usuario'    => Auth::user()->id,
			'tipo'      	=> $request->tipo,
			'comentario' 	=> $request->comentario,
			'status' 		=> 'aberto',
			'updated_by'    => Auth::user()->id
		]);
		
        // Retorna página de objetivos
		return redirect()->action('SugestaoController@tickets');
		
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
        
        $tickets = DB::table('sugestoes')
                    ->orderBy('status', 'asc')
                    ->orderBy('id', 'asc')
                    ->paginate(10);

        // Retorna página para ver sugestao
		return view('sugestoes/tickets', ['tickets' => $tickets])->with(["page" => "tickets"]);
		
    }


    /**
     * Mostrar tickets especifico.
     *
     */
    public function mostrar_ticket($id)
    {
        
        // Buscar dados do ticket
        $ticket = DB::table('sugestoes')
                        ->join('usuarios', 'sugestoes.id_usuario', '=', 'usuarios.id')
                        ->where('sugestoes.id', $id)
                        ->select('sugestoes.*', 'usuarios.id as usuario_id', 'usuarios.nome as nome')
                        ->first();

        // Buscar historico de comentarios do ticket
        $comentarios = DB::table('sugestoes_chat')
                        ->join('usuarios', 'sugestoes_chat.id_usuario', '=', 'usuarios.id')
                        ->where('sugestoes_chat.id_sugestao', $id)
                        ->orderBy('sugestoes_chat.id', 'desc')
                        ->select('sugestoes_chat.*', 'usuarios.id as usuario_id', 'usuarios.nome as nome')
                        ->get();

        // Limpar notificações
        $notificacao = DB::table('notificacao')
                        ->where('id_usuario', Auth::user()->id)
                        ->where('nome_tabela', 'sugestoes')
                        ->where('id_tabela', $id)
                        ->update(['status' => 'visualizado']);

        // Retorna página para ver sugestao
        return view('sugestoes/mostrar_ticket', ['ticket' => $ticket, 'comentarios' => $comentarios])->with(["page" => "tickets"]);
        
    }


    /**
     * Cadastrar novo comentario.
     *
     */
    public function comentar(Request $request)
    {
        
        // Cadastra nova sugestao
        $comentario = DB::table('sugestoes_chat')->insertGetId([
            'id_sugestao'   => $request->id_ticket,
            'id_usuario'    => Auth::user()->id,
            'comentario'    => $request->comentario,
            'updated_by'    => Auth::user()->id
        ]);

        
        // Cadastra nova notificação
        if(Auth::user()->id == '2'){

            // Se o usuario for o Administrador, cria notificação para dono do ticket
            $notificacao = DB::table('notificacao')->insertGetId([
                'id_tabela'   => $request->id_ticket,
                'nome_tabela' => 'sugestoes',
                'status'      => 'Novo',
                'id_usuario'  => $request->id_usuario,
                'assunto'     => 'Resposta de ticket',
                'texto'       => $request->comentario
            ]);

        }else{

            // Se o usuario for o dono do ticket, cria notificação para administrador
            $notificacao = DB::table('notificacao')->insertGetId([
                'id_tabela'   => $request->id_ticket,
                'nome_tabela' => 'sugestoes',
                'status'      => 'Novo',
                'id_usuario'  => '2',
                'assunto'     => 'Resposta de ticket',
                'texto'       => $request->comentario
            ]);

        }

        // Retorna página de objetivos
        return redirect()->action(
            'SugestaoController@mostrar_ticket', ['id' => $request->id_ticket]
        );

    }


    /**
     * Iniciar um ticket.
     *
     */
    public function iniciar($id)
    {
        
        // Inicia ticket da tabela de sugestões
        DB::table('sugestoes')->where('id', $id)->update(['status' => 'Em andamento']);
        
        // Retorna resposta para AJAX
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
        
    }

    /**
     * Finalizar um ticket.
     *
     */
    public function finalizar($id)
    {
        
        // Finaliza ticket da tabela de sugestões
        DB::table('sugestoes')->where('id', $id)->update(['status' => 'Finalizado']);

        // Recupera id do usuario que abriu o ticket
        $ticket = DB::table('sugestoes')->where('id', $id)->first();

        // Notifica conclusão para usuário que abriu o ticket.
        $notificacao = DB::table('notificacao')->insertGetId([
            'id_tabela'   => $id,
            'nome_tabela' => 'sugestoes',
            'status'      => 'Novo',
            'id_usuario'  => $ticket->id_usuario,
            'assunto'     => 'Ticket finalizado',
            'texto'       => 'Seu ticket foi finalizado com sucesso!'
        ]);
        

        // Retorna resposta para AJAX
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
        
    }


}
