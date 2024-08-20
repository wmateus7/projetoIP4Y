<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'Tasks';
    protected $fillable = ['title', 'description', 'status_id', 'project_id', 'user_id', 'expiredDate'];

    // Relacionamento '1->muitos' com a table status
    public function Tasks()
    {
        return $this->hasMany(Status::class);
    }
}
