<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\DTOs\ProviderUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

use function Sodium\randombytes_buf;

/**
 * @property string $avatar_url
 * @property string $data_source
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'data_source'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function createFromProvider(ProviderUser $dto): self
    {
        $fullName = implode(' ', array_filter([$dto->first_name, $dto->last_name]));

        $user = new User;
        $user->forceFill([
            'id' => $dto->id,
            'name' => $fullName,
            'email' => $dto->email,
            'password' => Hash::make(bin2hex(random_bytes(16))),
            'avatar_url' => $dto->avatar_url,
            'data_source' => $dto->data_source,
        ])->save();

        return $user;
    }
}
