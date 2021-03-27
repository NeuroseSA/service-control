<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallet';
    
    public function users(){ 
        return $this->hasMany(Wallet::class, 'id', 'user_id');        
    }

    public function clients(){ 
        return $this->hasMany(Wallet::class, 'id', 'client_id');        
    }

    public function cli(){ 
        return $this->belongsTo(Client::class, 'client_id', 'id');        
    }
}
