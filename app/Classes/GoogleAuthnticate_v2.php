<?php

namespace App\Classes;

use Google\Client;
use App\Models\Token;
use Google\Service\Exception;
use Google\Service\Drive;
use Google\Service\Forms;
use Illuminate\Support\Facades\Log;

class GoogleAuthnticate_v2
{
    /**
     * Path to the Google service account credentials JSON file.
     */
    protected static string $credential_file_path = 'clientapi.json';

    /**
     * Token model to interact with the database.
     */
    protected static string $token_model = \App\Models\Token::class;

    /**
     * Creates and configures a Google Client instance.
     *
     * @param array $scopes
     * @return Client
     */

   public static function createClient(array $scopes = []): Client
    {
        $client = new Client();

        // Set client configuration
        $client->setAuthConfig(self::getCredentials());
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes($scopes ?: [
            Drive::DRIVE_READONLY,
            Forms::FORMS_BODY_READONLY,
            Forms::FORMS_RESPONSES_READONLY,
        ]);
        $client->setAccessType(config('google.access_type', 'offline'));

        // Validate token
        return self::validateToken($client);
    }

    /**
     * Validates and sets the access token for the client.
     *
     * @param Client $client
     * @return Client
     */
    protected static function validateToken(Client $client): Client
    {
        try {
            $token = self::get_token();

            if ($token) {
                // Set access token if available
                $client->setAccessToken($token->toArray());

                // Check if the token is expired
                if ($client->isAccessTokenExpired()) {
                    // Refresh the token if expired
                    $refreshToken = self::getRefreshToken();
                    if ($refreshToken) {
                        $newToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
                        self::updateToken($newToken);
                        $client->setAccessToken($newToken);
                    }
                }
            }

            return $client;
        } catch (\Exception $e) {
            Log::error("Google Client Token Validation Error: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Fetches the refresh token from the database.
     *
     * @return string|null
     */
    protected static function getRefreshToken(): string|null
    {
        return self::get_token()->refresh_token ?? null;
    }

    /**
     * Generates an authentication URL to authorize the client.
     *
     * @param array $scope
     * @return string
     */
    public static function makeAuthnticateUrl(array $scope = []): string
    {
        $client = new Client();
        $client->setAuthConfig(self::getCredentials());
        $client->setRedirectUri(config('google.redirect_uri'));
        $client->setScopes($scope);

        return $client->createAuthUrl();
    }

    /**
     * Updates the token record in the database.
     *
     * @param array $newToken
     * @return void
     */
    protected static function updateToken(array $newToken): void
    {
        try {
            $tokenModel = self::get_token();
            $tokenModel->update([
                'access_token' => $newToken['access_token'],
                'expires_in' => $newToken['expires_in'],
                'created' => time(),
            ]);
        } catch (\Exception $e) {
            Log::error("Token Update Error: " . $e->getMessage());
        }
    }

    /**
     * Retrieves the credentials file path.
     *
     * @return string
     */
    protected static function getCredentials(): string
    {
        $credentialsPath = storage_path(self::$credential_file_path);

        if (!file_exists($credentialsPath)) {
            throw new \Exception("Credentials file not found at: {$credentialsPath}");
        }

        return $credentialsPath;
    }

    /**
     * Retrieves the token from the database.
     *
     * @param string|null $email
     * @return Token|null
     */
    protected static function get_token(string|null $email = null): ?Token
    {
        $query = app(static::$token_model);

        if ($email) {
            return $query->where('account_email', $email)->first();
        }

        return $query->first();
    }

    
}
