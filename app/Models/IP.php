<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IP extends Model
{
    use HasFactory;
    protected $table = 'ips';

    protected $fillable = [
        'proxmox_server_id',
        'ip_address',
        'status',
    ];

    function proxmoxServer(): BelongsTo
    {
        return $this->belongsTo(ProxmoxServer::class);
    }
}
