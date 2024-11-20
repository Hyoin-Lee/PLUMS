<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\WebsiteMessages;

class WebsiteMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WebsiteMessages::create([
            'name' => 'welcome',
            'message' => 'Welcome to PLUMS!'
        ]);

        WebsiteMessages::create([
            'name' => 'privacy_disclaimer',
            'message' => 'Please note that PLUMS stores some personally identifiable information which is necessary for the operation of the platform. This information is not shared with any third parties and is only used for the purpose of providing the service. PLUMS is not associated with TAFE.'
        ]);

        WebsiteMessages::create([
            'name' => 'sign_out',
            'message' => 'You have been signed out successfully. Thank you for using PLUMS!'
        ]);
    }
}
