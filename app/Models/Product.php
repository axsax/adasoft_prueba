<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'description',
        'price',
        'image',
        'minimum_amount'
    ];

    public function stock(){
        return $this->hasOne(Stock::class);
    }

    public function getGetImageAttribute(){
        if($this->image){
            return url("storage/$this->image"); //este lo busca en public no en storage, por lo que que hay que crear un enlaze simbolico (acceso directo) para que storage este en public, lo hacemos con el comando php artisan storage:link
        }
    }
}
