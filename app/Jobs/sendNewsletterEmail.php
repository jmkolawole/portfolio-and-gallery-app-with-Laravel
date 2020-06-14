<?php

namespace App\Jobs;

use App\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Newsletters;


class sendNewsletterEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $subscriber;
    public $post;
    public function __construct(Subscriber $subscriber,$post)
    {
        //

        $this->subscriber = $subscriber;
        $this->post = $post;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->subscriber->email)->send(new Newsletters($this->subscriber,$this->post));

    }
}
