<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Illuminate\Database\Seeder;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all active doctors
        $doctors = Doctor::where('is_active', true)->get();

        if ($doctors->isEmpty()) {
            $this->command->info('No active doctors found. Please create doctors first.');
            return;
        }

        foreach ($doctors as $doctor) {
            // Check if doctor already has schedules
            if ($doctor->schedules()->count() > 0) {
                $this->command->info("Doctor {$doctor->name} already has schedules. Skipping...");
                continue;
            }

            // Create a default schedule for weekdays (Sunday to Thursday)
            $weekdays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday'];

            foreach ($weekdays as $day) {
                DoctorSchedule::create([
                    'doctor_id' => $doctor->id,
                    'day_of_week' => $day,
                    'start_time' => '09:00',
                    'end_time' => '17:00',
                    'slot_duration' => 30,
                    'is_active' => true,
                ]);
            }

            $this->command->info("Created schedule for doctor: {$doctor->name}");
        }

        $this->command->info('Doctor schedules seeded successfully!');
    }
}
