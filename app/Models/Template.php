<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'proxmox_server_id',
        'vm_id',
    ];

    public function proxmoxServer(): BelongsTo
    {
        return $this->belongsTo(ProxmoxServer::class);
    }
}
