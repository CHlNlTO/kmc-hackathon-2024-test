<?php

namespace App\Observers;

use App\Models\JobPosting;
use Illuminate\Support\Str;

class JobPostingObserver
{
    public function creating(JobPosting $jobPosting)
    {
        $jobPosting->job_id = $this->generateUniqueJobId();
    }

    private function generateUniqueJobId()
    {
        do {
            $prefix = strtoupper(Str::random(3));
            $suffix = strtoupper(Str::random(7));
            $jobId = $prefix . '-' . $suffix;
        } while (JobPosting::where('job_id', $jobId)->exists());

        return $jobId;
    }
}
