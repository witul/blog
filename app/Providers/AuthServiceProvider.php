<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Enums\Role;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];
    protected $permissionMap = [
        'access-admin' => [Role::Editor, Role::Admin],
        'manage-posts' => [Role::Editor, Role::Admin],
        'manage-users' => [Role::Admin]
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        /*
        Gate::before(function (User $user) {
            if ($user->hasRole(Role::Admin)) {
                return true;
            }
        });
*/
        foreach($this->permissionMap as $perm=>$roles){
            Gate::define($perm, function (User $user) use($roles) {
                return in_array($user->role, $roles);
            });
        }
    }
}
