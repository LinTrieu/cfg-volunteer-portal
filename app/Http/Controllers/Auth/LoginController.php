<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Models\SocialIdentity;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect to socialite provider api.
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Reads the incoming request, retrieves user information from the provider, and logs user in.
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);
    }

    /**
     * Find user based on OAuth details, or create user if not found.
     */
    public function findOrCreateUser($providerUser, $provider)
    {
        Log::debug("HALLO");
        Log::debug("Provider: ", [$provider]);
        Log::debug("Provider User: ", [$providerUser]);
        $authUser = SocialIdentity::where('provider_id', [$providerUser->id])->first();
        Log::debug("Auth User: ", [$authUser]);

        if ($authUser) {
            return $authUser->user;
        } else {
             $user = User::where('email', $providerUser->getEmail())->first();

            if (!$user) {
                $$user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name'  => $providerUser->getName(),
                ]);
            }
//
//            $user->identities()->create([
//                'provider_name' => $provider,
//                'provider_id' => $providerUser->id,
//                'user_id' => $user->id,
//            ]);
            Log::debug("User object: ", [$user]);
            return $user;
        }
    }
}
