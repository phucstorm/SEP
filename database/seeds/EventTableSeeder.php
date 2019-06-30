<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'event_name' => "Demo01",
            'event_code' => "code01",
            'event_description' => "This is event for demo",
            'event_link' => "http://localhost:8000/room?room=code01",
            'user_id' => "1",
            'start_date' => "2019-06-04",
            'end_date' => "2019-06-05",
            'setting_join' => "1",
            'setting_question' => "1",
            'setting_reply' => "1",
            'setting_moderation' => "1",
            'setting_anonymous' => "1",
        ]);
    }
}
