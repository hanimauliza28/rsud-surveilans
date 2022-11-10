<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = ['id', 'nama_menu', 'url', 'icon', 'parent_menu', 'section_menu', 'permission', 'urut'];

    public function children()
    {
        return $this->hasMany($this, 'parent_menu');
    }
}
