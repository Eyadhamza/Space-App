<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
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
        $this->seedUser();
        $this->seedCategoryAndPosts();
    }
    private function seedUser()
    {
        $permissions=["platform.systems.roles"=>true,
            "platform.systems.users"=>true,
            "platform.systems.attachment"=>true,
            "platform.index"=>true,
            "platform.systems.index"=>true];

        User::create([
            'name'=>'Eyad Hamza',
            'email'=>'eyadhamza0@outlook.com',
            'password'=>bcrypt('password'),
            'permissions'=>$permissions

        ]);
    }
    private function seedCategoryAndPosts()
    {
        Category::factory()
            ->has(Post::factory()->count(10))
            ->create();
    }
}
