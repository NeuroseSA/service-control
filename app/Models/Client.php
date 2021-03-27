<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    public function users(){ 
        return $this->belongsToMany(Client::class, 'wallet', 'client_id', 'user_id');     
    }
}