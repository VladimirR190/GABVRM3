<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminder;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send event reminders to users';

    public function handle()
    {
        $events = Event::whereBetween('start_time', [
            now()->addHour(),
            now()->addHours(2)
        ])->get();

        foreach ($events as $event) {
            $event->user->notify(new EventReminder($event));
        }

        $this->info('Reminders sent successfully!');
    }
}
