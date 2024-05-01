<?php
//app\Models\Notification.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // ID pengguna yang menerima notifikasi
        'message', // Pesan notifikasi
        'description', // Deskripsi notifikasi (opsional)
    ];

    // Definisikan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
