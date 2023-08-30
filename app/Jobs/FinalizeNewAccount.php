<?php

namespace App\Jobs;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FinalizeNewAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $modelId;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->modelId=$id;
    }

    /**
     * Execute the job.
     */
    public function handle(UserRepositoryInterface $repository): void
    {
        $model = $repository->findById($this->modelId);
        event(new \Illuminate\Auth\Events\Registered($model));
        //
    }
}
