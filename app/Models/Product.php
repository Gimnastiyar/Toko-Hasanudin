<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
use HasFactory;
protected $fillable = ['barcode', 'name', 'category', 'price', 'cost_price', 'stock', 'description', 'image', 'supplier_id', 'expired_date'];
 public function transactions()
{
return $this->hasMany(Transaction::class);
}
public function supplier()
{
    return $this->belongsTo(\App\Models\Supplier::class);
}
}