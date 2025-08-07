<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'title' => 'About Us',
            'description' => 'Welcome to our world of innovation and excellence. We are committed to delivering cutting-edge solutions that empower businesses and enhance lives.',
            'button_text' => 'Learn More',
            'ip_address' => '127.0.0.1',
        ]);
    }
}