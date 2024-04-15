<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model

{
   // protected $table='items';
  //  protected $primaryKey='id';
  //  protected $fillable = ['name','item_no','quantity','category_id'];



    use HasFactory;


    // Item.php
public function sales()
{
    return $this->hasMany(sales::class,'id');
}
//department.php
   
}

