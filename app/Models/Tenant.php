<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;
    // protected $fillable = ['name','email','password','data'];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'password'
        ];
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }


    public function setDomainNameAttribute($value)
    {
        // If $value is null here, strtolower will fail.
        $this->attributes['domain_name'] = strtolower($value);
    }
}
