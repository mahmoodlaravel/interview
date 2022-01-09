<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class interview extends Model
{
    use HasFactory;

    protected $fillable=['title','description','date','remembered'];

    public function scopeNotRemembered()
    {
        return $this->where('remembered',false);
    }
}
