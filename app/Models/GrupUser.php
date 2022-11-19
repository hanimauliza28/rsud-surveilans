<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupUser extends Model
{
    use HasFactory;
    protected $table = 'grup_user';
    protected $fillable = ['nama_grup', 'kd_grup_bagian', 'grup_bagian', 'kd_bagian', 'nama_bagian'];

    public function menu()
    {
        return $this->belongsToMany(Menu::class, 'grup_user_menu');
    }
}
