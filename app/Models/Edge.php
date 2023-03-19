<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edge extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'from', 'to',  'utilization', 'is_connected', 'color'];

    /**
     * Get the NodeType that owns the Device.
     */
    public function from()
    {
        return $this->belongsTo(Device::class, 'foreign_key', 'from');
    }

    /**
     * Get the NodeType that owns the Device.
     */
    public function to()
    {
        return $this->belongsTo(Device::class, 'foreign_key', 'to');
    }
}
