<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ServiceNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->isQueueListenerRunning()) {
            $users = User::all();
            foreach ($users as $user) {
                if ($user->id != $this->service->user_id) {
                    send($user->device_token, $this->service->title, $this->service->desc, 'service', $this->service->id);
                }
            }
            $pid = $this->startQueueListener();
            $this->saveQueueListenerPID($pid);
        }


        $users = User::all();
        foreach ($users as $user) {
            if ($user->id != $this->service->user_id) {
                send($user->device_token, $this->service->title, $this->service->desc, 'service', $this->service->id);
            }
        }

    }

    private function isQueueListenerRunning()
    {
        if (!$pid = $this->getLastQueueListenerPID()) {
            return false;
        }

        $process = exec("ps -p $pid -opid=,cmd=");
        //$processIsQueueListener = str_contains($process, 'queue:listen'); // 5.1
        $processIsQueueListener = !empty($process); // 5.6 - see comments

        return $processIsQueueListener;
    }

    private function getLastQueueListenerPID()
    {
        if (!file_exists(__DIR__ . '/queue.pid')) {
            return false;
        }

        return file_get_contents(__DIR__ . '/queue.pid');
    }

    private function saveQueueListenerPID($pid)
    {
        file_put_contents(__DIR__ . '/queue.pid', $pid);
    }

    private function startQueueListener()
    {
        $command = 'php-cli ' . base_path() . '/artisan queue:work --timeout=60 --sleep=5 --tries=3 > /dev/null & echo $!'; // 5.6 - see comments
        $pid = exec($command);

        return $pid;
    }
}
