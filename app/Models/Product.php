<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;
    protected $fillable = ['category_id','subcategory_id','childcategory_id','brand_id','pickup_point_id','name','code','unit','tags','color','size','video','purchase_price','selling_price','discount_price','stock_quantity','warehouse','description','thumbnail','images','featured','today_deal','status','trendy','admin_id'];
    
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

    public function childcategory(){
        return $this->belongsTo(Childcategory::class,'childcategory_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function pickuppoint(){
        return $this->belongsTo(Pickuppoint::class,'pickup_point_id');
    }

    // Define searchable fields
    public function toSearchableArray()
    {
        return [
            'id' => $this->id, // Include the product ID
            'name' => $this->name,
            'description' => $this->description,
            // Add more fields as needed
        ];
    }
   
    
}
