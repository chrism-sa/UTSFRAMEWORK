<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
    ];

    protected $dates = [
        'waktu_mulai',
        'waktu_selesai',
    ];

    public function notifications()
{
    return $this->hasMany(Notification::class);
}
public function user()
    {
        return $this->belongsTo(User::class);
    }
}
