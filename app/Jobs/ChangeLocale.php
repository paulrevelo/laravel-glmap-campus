<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeLocale extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $lang;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        session()->set('locale', $this->lang);
    }
}
