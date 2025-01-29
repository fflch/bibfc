<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        Gate::define('admin', function ($user) {
            return true;
        });

        Gate::define('reports', function ($user) {
            if($user->email == 'catalog@fito.br') return false;
            return true;
        });

        Gate::define('cadastro_registros', function ($user){
            if($user->id == auth()->user()->id) return true;
            return false;
        });

        Gate::define('admin_unidade', function ($user, $model){ //Gate para admins terem acesso somente à unidade participante
            if($model->unidade_id == $user->unidade_id) return true;
            return false;
        });

    }
}
