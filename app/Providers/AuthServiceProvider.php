<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSuperadministrator',function($user){
            return $user->type === 'Superadministrator';

        });
        Gate::define('isAdministrator',function($user){
            return $user->type === 'Administrator';

        });
        Gate::define('isEnseignant',function($user){
            return $user->type === 'Enseignant';

        });

        Gate::define('isUser',function($user){
            return $user->type === 'User';

        });
        Gate::define('isSuperadministratorOrAdministratorOrEnseignant',function($user){
            return $user->type === 'Superadministrator' ||  $user->type === 'Administrator'||  $user->type === 'Enseignant' ;
        });

        Gate::define('isSuperadministratorOrAdministrator',function($user){
            return $user->type === 'Superadministrator' ||  $user->type === 'Administrator' ;
        });

        Gate::define('isAdministratorOrEnseignant',function($user){
            return $user->type === 'Administrator' ||  $user->type === 'Enseignant' ;
        });
        Gate::define('isUserOrEnseignant',function($user){
            return $user->type === 'User' ||  $user->type === 'Enseignant' ;
        });


        Passport::routes();
        //
    }
}
