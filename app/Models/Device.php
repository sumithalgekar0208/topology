<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'node_type_id', 'x_axis', 'y_axis'];

    /**
     * Get the NodeType that owns the Device.
     */
    public function nodeType()
    {
        return $this->belongsTo(NodeType::class);
    }

}
