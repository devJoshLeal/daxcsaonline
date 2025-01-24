<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Token;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $apiData = array(
        'status'    => 'success',
        'code'      => 200,
        'message'   => '',
        'data'      => array(),
        'errors'    => array()
    );
    public function test(){
        $this->apiData['message'] = 'Test Success';
        return response()->json($this->apiData);
    }
    public function orderByTrack($trackId){
        $order = Order::with('user','productList')->where('tracking_id', $trackId)->first();

        if($order){
            $this->apiData['data'] = $order;
            return response()->json($this->apiData);
        }
        else{
            $this->apiData['message'] = 'Order Not Found';
            return response()->json($this->apiData);
        }

    }
    public function listByUser(Request $request){
        $token = $request->header('Authorization');
        $user = Token::with('user')->where('token', $token)->first()->user;
        if (!$user){
            $this->apiData['message'] = 'User Not Found';
            return response()->json($this->apiData);
        }
        $orders = Order::with('user','productList')->where('user_id', $user
        ->id)->get();
        if (!$orders){
            $this->apiData['message'] = 'No Orders Found';
            return response()->json($this->apiData);
        }
        $this->apiData['data'] = $orders;
        return response()->json($this->apiData);
    }
}
