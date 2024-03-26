<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\ActivityDeadlineNotification;
use App\Models\{Activity,User};
use Carbon\Carbon;

class SendActivityDeadlineNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity:deadline-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send notifications for activities with deadlines within 15 days.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $activities = Activity::where('end_date', '<=', strtotime(Carbon::now()->addDays(15)))
                               ->where('end_date', '>=', Carbon::now())
                               ->get();

        foreach ($activities as $activity) {
            $user = User::find(1);
            $message = "Your activity '{$activity->name}' is approaching its deadline.";
            $user->notify(new ActivityDeadlineNotification($activity, $message));
        }

        $this->info('Deadline notifications sent successfully.');
    }
}
