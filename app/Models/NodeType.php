<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NodeType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'background_color', 'border_color',  'shape'];

    /**
     * Get the Devices for the NodeType.
     */
    public function devices()
    {
        return $this->hasMany(Devices::class);
    }

}
