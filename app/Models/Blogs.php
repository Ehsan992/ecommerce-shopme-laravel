<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    use HasFactory;
    protected $fillable = ['blog_category_id','title','slug','publish_date','description','thumbnail','tag','status'];
    
    public function blog_category(){
        return $this->belongsTo(blog_category::class,'blog_category_id');
    }
}
