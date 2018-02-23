<?php

namespace App\Oauth2\Auth;

use GuzzleHttp\Exception\RequestException;

class MSAuth
{
    private $system_name;
    private $username;
    private $password;
    private $access_token;
    private $refresh_token;
    public $response;
    public $code = null;
    public $message = null;
    public $user;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->system_name = 'clients';
    }

    public function getTokens()
    {
        try {
            $http = new \GuzzleHttp\Client(['verify' => false ]);

            $response = $http->post('https://b-api.dev/oauth/token', [

                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => 2,
                        'client_secret' => 'OovruiIBce1wFojZWBElqeNNAcnC01n7l4coMIMh',

                        'username' => $this->username,
                        'password' => $this->password,
                        'scope' => 'all',
                    ]

                ]);

            $this->response = json_decode((string) $response->getBody(), true);

            $this->access_token = $this->response['access_token'];
            $this->refresh_token = $this->response['refresh_token'];
        } catch (RequestException $e) {
            $this->handleError($e);
        }
    }

    public function getUser()
    {
        if (! $this->code) {
            try {
                $http = new \GuzzleHttp\Client(['verify' => false ]);

                $response = $http->request('GET', 'https://b-api.dev/api/me', [

                        'headers' => [
                            "Content-Type" => "application/json",
                            "Accept" => "application/json",
                            "Authorization" => "Bearer {$this->access_token}",
                            "HTTP_X-System" => "{$this->system_name}",

                        ],

                    ]);

                $this->user = json_decode((string) $response->getBody(), true);

                if (!$this->user) {
                    return null;
                }

                $this->user['access_token'] = $this->access_token;
                $this->user['refresh_token'] = $this->refresh_token;
                $this->user['password'] = '';


                return $this->user;
            } catch (RequestException $e) {
                $this->handleError($e);
            }
        } else {
            return null;
        }
    }

    protected function handleError($e)
    {
        $errcode = $e->getCode();

        switch ($errcode) {
            case '401':
                $this->code = 401;
                $this->message = 'Unauthorized';
                break;

            default:
                # code...
                break;
        }
    }
}
