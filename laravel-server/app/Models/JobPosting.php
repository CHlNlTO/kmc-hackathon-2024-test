<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'title',
        'description',
        'salary',
        'location',
        'application_deadline',
        'job_type_id',
        'work_model_id',
        'shift_type_id',
        'status_id',
    ];

    protected $casts = [
        'application_deadline' => 'date',
        'salary' => 'decimal:2',
    ];

    public function jobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class);
    }

    public function workModel(): BelongsTo
    {
        return $this->belongsTo(WorkModel::class);
    }

    public function shiftType(): BelongsTo
    {
        return $this->belongsTo(ShiftType::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(JobPostingStatus::class, 'status_id');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
