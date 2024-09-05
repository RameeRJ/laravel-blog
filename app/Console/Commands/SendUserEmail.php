<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\UserEmail;

class SendUserEmail extends Command
{
    // The name and signature of the console command.
    protected $signature = 'user:send {id}';

    // The console command description.
    protected $description = 'Send an email to a user by ID';

    // Execute the console command.
    public function handle()
    {
        // Get the user ID from the command argument
        $userId = $this->argument('id');

        // Find the user by ID
        $user = User::find($userId);

        if ($user) {
            // Send email
            Mail::to($user->email)->send(new UserEmail($user));
            $this->info('Email sent successfully to user ID ' . $userId . '.');
        } else {
            $this->error('User with ID ' . $userId . ' not found.');
        }
    }
}