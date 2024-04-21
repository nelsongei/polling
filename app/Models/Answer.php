<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'option'
    ];
    public function vote(){
        return $this->hasOne(Vote::class);
    }
    public function votes(){
        return $this->hasMany(Vote::class);
    }
}
