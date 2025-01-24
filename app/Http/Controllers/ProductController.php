<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public $apiData = array(
        'status'    => 'success',
        'code'      => 200,
        'message'   => '',
        'data'      => array(),
        'errors'    => array()
    );

    public function getProduct( $publicId){
        $product = Product::where('public_id', $publicId)->first();
        if($product){
            $this->apiData['data'] = $product;
                return response()->json($this->apiData);
            }
            else{
                $this->apiData['status'] = 'error';
                $this->apiData['code'] = 404;
                $this->apiData['message'] = 'Product not found';
                return response()->json($this->apiData);
            }
    }

}
