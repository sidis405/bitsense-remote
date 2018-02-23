<?php

namespace App\Oauth2\Socialite;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class MSAuthProvider extends AbstractProvider implements ProviderInterface
{
    protected $scopes = ['all'];



    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        // dd($this->buildAuthUrlFromBase('https://b-api.dev/oauth/authorize', $state));
        return $this->buildAuthUrlFromBase('https://b-api.dev/oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return 'https://b-api.dev/oauth/token';
    }

    public function getAccessToken($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'body' => $this->getTokenFields($code),
        ]);

        return $this->parseAccessToken($response->getBody());
    }

    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code'
        ]);
    }

    protected function getUserByToken($token)
    {
        // Can catch token here
        // dd($token);

        $response = $this->getHttpClient()->get('https://b-api.dev/api/me', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map([
            'id'       => $user['id'],
            'email'    => $user['email'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
}
