<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    
    use HasRoles;

    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }


    /**
     * Dados adicionais nas sessions.
     *
     * @var array
     */
    public function getFotoAttribute(){
        
        $id = $this->id;
        $usuarios = Usuario::find($id);
        
        return $this->foto = $usuarios->foto;//'1509266372.png';
        
    }
    
    public function getEquipeAttribute(){
        
        return $this->equipe = 'fono';
        
    }

    public function getNotificacoesAttribute(){

        $id = $this->id;
        $notificacoes = DB::table('notificacao')->where('id_usuario', $id)->where('status', 'Novo')->get();

        return $notificacoes;

    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
