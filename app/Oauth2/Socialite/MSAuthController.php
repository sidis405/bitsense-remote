<?php

namespace App\Oauth2\Socialite;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class MSAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::with('bitsense_auth')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::with('bitsense_auth')->user();

            dd($user);
        } catch (InvalidStateException $e) {
            return redirect()->to('/login');
        } catch (RequestException $e) {
            return $e->getMessage();
        }
    }
}
