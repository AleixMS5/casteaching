<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        create_default_user();
        create_superadmin_user();
        create_regular_user();
        create_sample_videos();
        create_video_manager_user();
        create_useradmin_user();
        create_default_videos();

    }
}
