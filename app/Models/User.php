<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;


/**
 * Class User
 *
 * @property string $photo
 * @property string $role
 * @property string $nom
 * @property string|null $prenom
 * @property string $membre
 * @property string $voix
 * @property string $genre
 * @property string $indicatif_pays
 * @property string $contact
 * @property string $profession
 * @property string $email
 * @property string $password
 * @property int $premiere_annee_ucjg
 * @property string $anecdote
 * @property string $releve_assuree
 * @property string $souhait_30_ans
 * @property string|null $otp_code
 * @property Carbon|null $otp_expires_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * 
 * @package App\Models
 */


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $fillable = [
        'photo',
        'role',
        'nom',
        'prenom',
        'membre',
        'voix',
        'genre',
        'indicatif_pays',
        'contact',
        'profession',
        'email',
        'password',
        'premiere_annee_ucjg',
        'anecdote',
        'releve_assuree',
        'souhait_30_ans',
        'otp_code',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'otp_expires_at' => 'datetime',
        'premiere_annee_ucjg' => 'integer',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getImageUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/default.svg');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'user_id');
    }
}
