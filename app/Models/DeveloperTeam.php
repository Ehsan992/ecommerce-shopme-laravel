<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeveloperTeam extends Model
{
    use HasFactory;
    protected $table = 'developer_team';
    protected $fillable = ['name','image','roles','facebook','twitter','instagram','linkedin'];
}
