<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')->select('group_name')->groupBy('group_name')->get();
        return $permission_groups;
    } // End Method 
    public static function getpermissionByGroupName($group_name)
    {

        $permissions = DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    } // End Method 

    public static function roleHasPermissions($role, $permissions)
    {

        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
            }
            return $hasPermission;
        }
    } // End Method
    public function userinsrest(): BelongsTo
    {
        return $this->belongsTo(Userinterest::class,'id', 'user_id');
    }
    public function property(): HasMany
    {
        return $this->hasMany(Property::class, 'agent_id', 'id');
    }
    public function packagehistory(): HasMany
    {
        return $this->hasMany(PackagePlan::class, 'user_id', 'id');
    }
    
}
