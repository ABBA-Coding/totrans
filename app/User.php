<?php

namespace App;

use App\Models\Activity;
use App\Models\District;
use App\Models\Manager;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN = 'admin';
    const ROLE_LOGIST = 'logist';
    const ROLE_SALES = 'sales';
    const ROLE_CLIENT = 'client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'login', 'email', 'email_verified_at', 'password', 'phone', 'phone_verified_at', 'activity_id',
        'manager_id', 'company_name', 'district_id'
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

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id')->withDefault();
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

    public static function getAuthRole()
    {
        return \Illuminate\Support\Facades\Auth::user()->role->role;
    }

    public static function generateLogin(): string
    {
        $prefix = 'AN-';
        $start = 1990;
        $generates = DB::table('generated_numbers')->count();
        $newID = $prefix.($start+$generates);

        DB::table('generated_numbers')->insert([
            'value' => $newID
        ]);

        return $newID;
    }
}
