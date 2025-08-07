<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create([
            'name' => 'John Doe',
            'designation' => 'CEO',
            'message' => 'Solo Leveling is the best webtoon ever.',
            'name_2' => 'Jane Smith',
            'designation_2' => 'CTO',
            'message_2' => 'Another great message about something amazing.',
            'ip_address' => '127.0.0.1',
        ]);
    }
}
