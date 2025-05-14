<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        WeightLog::factory()->count(35)->create([
            'user_id' => $user->id,
        ]);

        WeightTarget::factory()->create([
            'user_id' => $user->id,
        ]);
    }
}
