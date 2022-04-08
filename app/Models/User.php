<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements HasMedia
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'employee_id',
        'employee_type',
        'employee_status',
        'email',
        'email_personal',
        'password',
        'quota_hours',
        'log_type',
        'department',
        'contact',
        'school',
        'course',
        'coordinator',
        'coordinator_email',
        'orientation_day',
        'first_day',
        'last_day',
        'exit_day',
        'comment'
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

    public function avatar()
    {
        $image = $this->getMedia('avatars')
                ->last();
        if ($image) {
            $image = $image->getUrl();
        }
        else {
            $image = config('app.url') . '/assets/img/alien_default_smile.png';
        }
        return $image;
    }

    public function viewRequirement($employee_id, $type) {

        $file = $this->getMedia($type)
                ->last();
        if ($file) {
            $file = $file->getUrl();
        }
        return $file;
    }
}
