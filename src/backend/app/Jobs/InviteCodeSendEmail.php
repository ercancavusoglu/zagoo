<?php

namespace App\Jobs;

use App\Mail\InviteCodeEmail;
use App\Models\InviteCodes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class InviteCodeSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $userId;
    protected string $to;
    protected string $code;

    /**
     * Create a new job instance.
     *
     * @param int $userId
     * @param string $to
     * @param string $code
     */
    public function __construct(int $userId, string $to, string $code)
    {
        $this->userId = $userId;
        $this->to = $to;
        $this->code = $code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $email = new InviteCodeEmail($this->code);

        Mail::to($this->to)->send($email);

        InviteCodes::create([
            'user_id' => $this->userId,
            'to' => $this->to,
            'code' => $this->code,
            'is_used' => 0
        ]);
    }
}
