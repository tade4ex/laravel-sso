<?php

namespace App\Providers;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class OAuth2Provider extends AbstractProvider implements ProviderInterface
{

    protected $scopes = [
        'view-user'
    ];

    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase('https://sso.test/oauth/authorize', $state);
    }

    protected function getTokenUrl(): string
    {
        return 'https://sso.test/oauth/token';
    }

    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()
            ->get(
                'https://sso.test/api/user',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json'
                    ],
                ]
            );

        return json_decode($response->getBody(), true);
    }

    protected function formatScopes(array $scopes, $scopeSeparator): string
    {
        return implode($scopeSeparator, $scopes);
    }

    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name']
        ]);
    }
}
