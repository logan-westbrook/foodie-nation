<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Requests\Admin\ProfileUpdateRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\FileUploadTrait;
use Throwable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, FileUploadTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public function updateUserFromRequest(): void
    {
        try {
            $this->save();
        } catch (Throwable $t) {
            error_log("Error updating user: {$t->getMessage()}");
        }
    }

    public function updateUserSettingsFromRequest(Request $request): void
    {
        $this->name = $request->name ?? $this->name;
        $this->email = $request->email ?? $this->email;
        $this->avatar = self::uploadFile($request, 'avatar') ?? $this->avatar;
        $this->updateUserFromRequest();
    }

    public function updateUserPasswordFromRequest(Request $request): void
    {
        $this->password = Hash::make($request->password);
        $this->updateUserFromRequest();
    }
}
