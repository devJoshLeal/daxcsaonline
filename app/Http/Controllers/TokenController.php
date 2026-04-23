<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;

class TokenController extends Controller
{
    public function getTokenFromUser( Request $request ){
        // Search for token based on user's json
        $json = $request->input('json');
        $params = json_decode($json, true);
        $userId = $params['id'];
        $userInDb = User::find($userId);
        if($userInDb){
            $token = Token::where('user_id', $userId)->first();
            if($token){
                $this->apiData['data'] = $token;
                $this->apiData['message'] = 'Token found';
                // If token expired, extends 3 more days
                if($token->expires_at < now()){
                    $token->expires_at = now()->addDays(3);
                    $token->save();

                }
            }
            else{
                // If token does not exist, it creates a new one
                $token = new Token();
                $token->user_id = $userId;
                $token->token = bin2hex(random_bytes(32));
                $token->last_used_at = now();
                $token->expires_at = now()->addDays(3);
                $token->save();
                $this->apiData['code'] = 201;
                $this->apiData['data'] = $token;
                $this->apiData['message'] = 'Token created';
            }
        }
        else{
            $this->apiData['errors'][] = 'User not found';
            $this->apiData['status'] = 'error';
            $this->apiData['code'] = 404;
        }
        return response()->json($this->apiData, $this->apiData['code']);

    }
}
