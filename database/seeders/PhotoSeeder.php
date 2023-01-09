<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            DB::table('photos')->insert([
                'name' => '画像test' . $i,
                'description' => Str::random(20),
                'album_id' => Album::find($i + 1)->id,
                'user_id' => User::find($i + 1)->id,
                'extension' => 'jpg',
            ]);
        }
    }
}
