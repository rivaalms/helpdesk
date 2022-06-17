<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Article;
use App\Models\Departement;
use App\Models\Reply;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Worker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create([
            'name' => 'User'
        ]);
        UserRole::create([
            'name' => 'Agent'
        ]);
        
        \App\Models\User::factory(5)->create();

        $user_id = DB::table('users')->where('user_role_id', 1)->get()->pluck('id');

        for($i = 0; $i < count($user_id); $i++) {
            Worker::create([
                'user_id' => $user_id[$i],
                'departement_id' => mt_rand(1, 5)
            ]);
        }

        $user_id = DB::table('users')->where('user_role_id', 2)->get()->pluck('id');

        for($i = 0; $i < count($user_id); $i++) {
            Admin::create([
                'user_id' => $user_id[$i],
            ]);
        }
        
        
        Departement::factory(5)->create();

        Article::factory(20)->create();

        Category::create([
            'name' => 'Uncategorized'
        ]);
        Category::create([
            'name' => 'Computer'
        ]);
        Category::create([
            'name' => 'Software'
        ]);
        Category::create([
            'name' => 'Network'
        ]);

        Status::create([
            'name' => 'Open'
        ]);
        Status::create([
            'name' => 'Closed'
        ]);

        Ticket::factory(15)->create();

        Reply::factory(10)->create();
    }
}
