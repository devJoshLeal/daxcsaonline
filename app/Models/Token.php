<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'personal_access_tokens';
    protected $fillable = [
        'user_id',
        'token'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
