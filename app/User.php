<?php

namespace App;

use App\Models\Activity;
use App\Models\Manager;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_MODERATOR = 'moderator';
    const ROLE_CLIENT = 'client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'login', 'email', 'email_verified_at', 'password', 'phone', 'phone_verified_at', 'activity_id',
        'manager_id', 'company_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activity_id')->withDefault();
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class, 'manager_id')->withDefault();
    }

    public function role(): HasOne
    {
        return $this->hasOne(Role::class);
    }

    public function verified()
    {
        return (!empty($this->email_verified_at) || !empty($this->phone_verified_at));
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone']  = preg_replace('/\D+/', null, $value);
    }
}
