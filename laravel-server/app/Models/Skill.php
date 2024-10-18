<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function jobPostings(): BelongsToMany
    {
        return $this->belongsToMany(JobPosting::class);
    }

    public function candidates(): BelongsToMany
    {
        return $this->belongsToMany(Candidate::class);
    }
}
