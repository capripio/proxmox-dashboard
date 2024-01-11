<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProxmoxServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ip_address',
        'token_id',
        'token_secret',
    ];


    public function ips() : HasMany
    {
        return $this->hasMany(IP::class, 'proxmox_server_id','id');
    }
}
