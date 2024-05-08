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
    public static $credinital_file_path  = 'clientapi.json';

    protected Model $model;
    public static function makeClient(array $scope = []): Client | \Illuminate\Routing\Redirector | \Illuminate\Http\RedirectResponse
    {

        if (empty($scope)) {
            $scope = [
                Drive::DRIVE_READONLY,
                Forms::FORMS_BODY_READONLY,
                Forms::FORMS_RESPONSES_READONLY
            ];
        }

        $client = new Client;
        $client->setAuthConfig(static::get_credinital());
        $client->setRedirectUri(config('google.redirect_uri'));

        $client->setScopes($scope);

        $client->setAccessType(config('google.access_type'));
        // validate token expiration and validatiy
        $client =  self::setAccessToken($client);
        
        return $client;
    }


    protected static function setAccessToken(Client $client): Client
    {

        !$client->isAccessTokenExpired()
            ? $client->setAccessToken(self::get_token()->toArray())
            : $client->setAccessToken(self::fetchAccessTokenWithRefreshToken($client, self::getRefreshToken())->toArray());
        return $client;
    }


    public static function makeClinetToAuthnticate(array $scope = [])
    {
        if (empty($scope)) {
            $scope = [
                Drive::DRIVE_READONLY,
                Forms::FORMS_BODY_READONLY,
                Forms::FORMS_RESPONSES_READONLY
            ];
        }

        $client = new Client;
        $client->setAuthConfig(static::get_credinital());
        $client->setRedirectUri(config('google.redirect_uri'));

        $client->setScopes($scope);

        $client->setAccessType(config('google.access_type'));

        return $client;
    }


    protected static function fetchAccessTokenWithRefreshToken(Client $client, string $refresh_token): Token
    {

        $access_token =  $client->fetchAccessTokenWithRefreshToken($refresh_token);
        $tokenModel = static::get_token();
        $access_token['code'] = $tokenModel->code;


        $tokenModel->update($access_token);

        return $tokenModel;
    }

    protected static function validate_token(Client $client): bool
    {

        return $client->isAccessTokenExpired();
    }



    protected static function getRefreshToken(): string
    {

        // return json_decode(file_get_contents(base_path('refresh_token.json')), true)['refresh_token'];
       return self::get_token()->refresh_token;
    }


    public static function makeAuthnticateUrl(array $scope = [])
    {
        // $client = static::makeClient($scope);

        $client = new Client;
        $client->setAuthConfig(static::get_credinital());
        $client->setRedirectUri(config('google.redirect_uri'));

        $client->setScopes($scope);

        $client->setAccessType(config('google.access_type'));
        return $client->createAuthUrl($scope);
    }


    public static function get_credinital()
    {
        return config('google.auth_config_path');
    }

    protected static function get_token($email = null): Model | null
    {
        if (is_null($email)) return app(config('google.token_model'))->first();

        return app(config('google.token_model'))->where('account_email', $email)->first();
    }
}
