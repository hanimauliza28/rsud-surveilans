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

    public function parent()
    {
        return $this->belongsTo($this, 'parent_menu', 'id');
    }

    public function grupUser()
    {
        return $this->belongsToMany(GrupUser::class, 'grup_user_menu');
    }

    public function getLabelStatusAttribute()
    {
        if($this->status == 'Y'){
            $result = '<span class="badge badge-success">Aktif</span>';
        }else{
            $result = '<span class="badge badge-danger">Tidak Aktif</span>';
        }
        return $result;
    }
}
