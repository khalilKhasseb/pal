<?php

/**
 * This class will have one static method which will return a configured client instance to use
 * for make calls for services
 *
 * To make a service call you have to include
 * - App credintial [Client id , Client secret , Redirect uri , scopes]
 * - Authnticate client and store access toke in databse
 * - validate token in each request if not valid request for new token by making new authntication
 */

namespace App\Classes;


use Google\Client;  

use App\Models\Token;
use Google\Service\Exception;
use Illuminate\Database\Eloquent\Model;
use Google\Service\Drive;
use Google\Service\Forms;
use Illuminate\Support\Facades\Redirect;


class GoogleAuthnticate
{
    protected static string $credinital_file_path = 'clientapi.json';

    protected static string $token_model = \App\Models\Token::class;

    public static function createClient(array $scopes = []): Client
    {
        $client = new Client();
        $client->setAuthConfig(self::getCredentials());
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes($scopes ?? [
            Drive::DRIVE_READONLY,
            Forms::FORMS_BODY_READONLY,
            Forms::FORMS_RESPONSES_READONLY,
        ]);
        $client->setAccessType(config('google.access_type'));

        return self::validateToken($client);
    }

    protected static function validateToken(Client $client): Client
    {
        if (!$client->isAccessTokenExpired()) {
            return $client;
        }
          
        if(self::getRefreshToken() === null) {
            return $client;
        }

         $client->setAccessToken(self::fetchAccessTokenWithRefreshToken($client, self::getRefreshToken())->toArray());

        return $client; 
    }

    /**
     * Fetches a fresh access token with a given refresh token.
     * 
     * @param Client $client An instance of Google Client
     * @param string|null $refresh_token The refresh token to be used
     * 
     * @return Model The updated token model
     */
    protected static function fetchAccessTokenWithRefreshToken(Client $client, string | null $refresh_token): Model
    {
        $access_token =  $client->fetchAccessTokenWithRefreshToken($refresh_token);
        $tokenModel = static::get_token();
        $access_token['code'] = $tokenModel->code;

        $tokenModel->update($access_token);

        return $tokenModel;
    }  

    protected static function getRefreshToken(): string | null
    {
        return self::get_token()->refresh_token ?? null;
    }

    public static function makeAuthnticateUrl(array $scope = []): string
    {
        $client = static::createClient($scope);
        return $client->createAuthUrl($scope);
    }

    protected static function getCredentials()
    {
        return config('google.auth_config_path');
    }

    protected static function get_token($email = null): Model | null
    {
        if (is_null($email)) return app(static::$token_model)->first();

        return app(static::$token_model)->where('account_email', $email)->first();
    }
}
