<?php

namespace Database\Factories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $admin = DB::table('admins')->get()->pluck('user_id');
        // $admin_max = DB::table('admins')->orderBy('user_id', 'desc')->first();

        return [
            'subject' => $this->faker->sentence(mt_rand(2, 5)),
            'detail' => $this->faker->paragraph(mt_rand(5, 10)),
            'user_id' => mt_rand(1,5),
            'category_id' => mt_rand(1, 3),
            'status_id' => mt_rand(1, 2),
            // 'admin_user_id' => mt_rand($admin_min->user_id, $admin_max->user_id)
            // 'admin_user_id' => $this->faker->randomElement($admin)
        ];
    }
}
