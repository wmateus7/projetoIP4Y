<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'Status';
    protected $fillable = ['description'];

    // Relacionamento '1->muitos' com a table Tasks
    public function Status()
    {
        return $this->belongsTo(Tasks::class);
    }
}
