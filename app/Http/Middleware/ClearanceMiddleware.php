<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
        
		// if (Auth::user()->hasPermissionTo('Administrativo')) {
            // return $next($request);
        // }
		
		/**
		* Controle de acesso para 'Objetivos'.
		*
		*/
        if ($request->is('objetivos/create')) {
            if (!Auth::user()->hasPermissionTo('Objetivo_Cadastrar')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
		
		
        /**
		* Controle de acesso para 'Pacientes'.
		*
		*/
        if ($request->is('pacientes/create')) {
            if (!Auth::user()->hasPermissionTo('Paciente_Cadastrar')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
		
		if ($request->is('pacientes/*/edit')) {
            if (!Auth::user()->hasAnyPermission(['Paciente_Editar_Todos', 'Paciente_Editar_Equipe', 'Paciente_Editar_Meu']) ) {
                abort('401');
            } else {
                return $next($request);
            }
        }
		
		
		/**
		* Controle de acesso para 'Terapias'.
		*
		*/
        if ($request->is('terapia/create')) {
            if (!Auth::user()->hasAnyPermission(['Terapia_Todos', 'Terapia_Meu'])) {
                abort('401');
            } else {
                return $next($request);
            }
        }
		


		/* ------------------------------------------------------------- */
		
        if ($request->is('posts/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) {
            if (!Auth::user()->hasPermissionTo('Delete Post')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}