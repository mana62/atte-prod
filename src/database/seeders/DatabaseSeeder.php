<?php

namespace Database\Seeders;

use App\Models\AttendanceSheet;
use App\Models\BreakTime;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(70)->create()->each(function ($user) {

            $attendanceSheet = AttendanceSheet::factory()->create(['user_id' => $user->id]);

            $breakCount = rand(1, 3);
            BreakTime::factory()->count($breakCount)->create([
                'attendance_sheet_id' => $attendanceSheet->id,
            ]);
        });
    }
}
