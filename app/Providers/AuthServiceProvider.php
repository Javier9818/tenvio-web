<?php

namespace App\Providers;

use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user) {
            if ($user->isAdmin) return true;
        });

        Gate::define('gestionar-panel-general', function($user){
            return $user->isAdmin;
        });

        Gate::define('gestionar-personal', function($user){
            $permisos = $user->permisoUser;
            foreach ($permisos as $key => $permiso) {
                if($permiso->id === 1)
                return true;
            }
            return false;
        });

        Gate::define('gestionar-contabilidad', function($user){
            $permisos = $user->permisoUser;
            foreach ($permisos as $key => $permiso) {
                if($permiso->id === 2)
                return true;
            }
            return false;
        });

        Gate::define('gestionar-pedidos', function($user){
            $permisos = $user->permisoUser;
            foreach ($permisos as $key => $permiso) {
                if($permiso->id === 3)
                return true;
            }
            return false;
        });

        Gate::define('gestionar-productos', function($user){
            $permisos = $user->permisoUser;
            foreach ($permisos as $key => $permiso) {
                if($permiso->id === 4)
                return true;
            }
            return false;
        });

        Gate::define('gestionar-entregas', function($user){
            $permisos = $user->permisoUser;
            foreach ($permisos as $key => $permiso) {
                if($permiso->id === 5)
                return true;
            }
            return false;
        });

        Gate::define('edit-company', function($user){
            $permisos = $user->permisoUser;
            foreach ($permisos as $key => $permiso) {
                if($permiso->id === 6)
                return true;
            }
            return false;
        });

        Gate::define('edit-profile', function($user, User $userEdit) { //Considerar poner esto en after
            return Session::get('empresa') === $user->userEmpresa->empresa_id;
        });

        Gate::define('visit-company', function($user) { //Considerar poner esto en after
            return Session::get('empresa') === $user->userEmpresa->empresa_id;
        });

    }
}
