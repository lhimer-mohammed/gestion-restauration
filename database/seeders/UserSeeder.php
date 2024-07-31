<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // تأكد من استخدام الفضاء الصحيح هنا

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(User::class)->create(); // تأكد من استخدام الفضاء الصحيح هنا أيضًا
    }
}
