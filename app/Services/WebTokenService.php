<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Token;

class WebTokenService
{
    public static function manageToken()
    {
        $token = User::with('webToken')->where("id", Auth::id())->first()->webToken;

        if ($token) {
            // If token expired, extends 3 more days
            if ($token->expires_at < now()) {
                $token->expires_at = now()->addDays(3);
                $token->save();
            }
        } else {
            // If token does not exist, it creates a new one
            $token = new Token();
            $token->user_id =  Auth::id();
            $token->token = bin2hex(random_bytes(32));
            $token->last_used_at = now();
            $token->expires_at = now()->addDays(3);
            $token->save();
        }

        return $token->token;
    }
}
