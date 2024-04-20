<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function requisition()
    {
        return $this->morphMany(Requisition::class, 'requestable');
    }

    public function sanction()
    {
        return $this->morphMany(Sanction::class, 'sanctionable');
    }

    public function resanctionRequest()
    {
        return $this->morphMany(ResanctionRequest::class, 'requestable');
    }

    public function resanction()
    {
        return $this->morphMany(Resanction::class, 'sanctionable');
    }
}
