<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Token;

class TokenController extends Controller
{
    public $apiData = array(
        'status'    => 'success',
        'code'      => 200,
        'message'   => '',
        'data'      => array(),
        'errors'    => array()
    );
    public function getTokenFromUser( Request $request ){
        $json = $request->input('json');
        $params = json_decode($json, true);
        $userId = $params['id'];
        $userInDb = User::find($userId);
        if($userInDb){
            $token = Token::where('user_id', $userId)->first();
            if($token){
                $this->apiData['data'] = $token;
                $this->apiData['message'] = 'Token found';
                // Si el token ya expiro, se extiende por 3 dias
                if($token->expires_at < now()){
                    $token->expires_at = now()->addDays(3);
                    $token->save();

                }
            }
            else{
                // Si no existe token, se crea uno nuevo
                $token = new Token();
                $token->user_id = $userId;
                $token->token = bin2hex(random_bytes(32));
                $token->last_used_at = now();
                $token->expires_at = now()->addDays(3);
                $token->save();
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
