<?php

namespace App\Oauth2\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

trait MSAuthTrait
{
    public function doMSAuth($email, $password, $request)
    {
        $auth = new MSAuth($email, $password);
        $auth->getTokens();
        $user = $auth->getUser();

        if ($user) {
            $authed_user = new User;
            $authed_user->fill($user);

            $existing_user = User::whereEmail($authed_user->email)->first();

            if (! $existing_user) {
                $saved_user = $authed_user->save();
                Auth::loginUsingId($authed_user->id, true);

                Session::put('acl', $user['roles']);
            } else {
                $saved_user = $existing_user->update($authed_user->toArray());
                Auth::loginUsingId($existing_user->id, true);

                Session::put('acl', $user['roles']);
            }

            return $this->sendLoginResponse($request);
        }
    }
}
