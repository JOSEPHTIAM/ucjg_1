<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'video';
    protected $primaryKey = 'id_video';

    protected $fillable = [
        'video',
        'identite',
        'commentaire',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getVideoUrlAttribute(): string
    {
        return $this->video ? asset('storage/' . $this->video) : asset('images/default-video.svg');
    }
}
