<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservas extends Model{
    
    protected $fillable = [
        'livro_id', 'status'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
