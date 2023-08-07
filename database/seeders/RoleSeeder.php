<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'role' => 'Project Manager',
            'salary' => '6000',
            'salary_per_day' => '300',
        ]);

        DB::table('roles')->insert([
            'role' => 'Developer',
            'salary' => '4000',
            'salary_per_day' => '200',
        ]);

        DB::table('roles')->insert([
            'role' => 'Designer',
            'salary' => '3000',
            'salary_per_day' => '150',
        ]);

        DB::table('company_profit')->insert([
            'otherFactor' => '20',
            'company_profit' => '60',
            'factor_1' => '0',
            'factor_2' => '0',
            'factor_3' => '50',
            'factor_4' => '50',
            'factor_5' => '50',
            'factor_6' => '100',
            'factor_7' => '100',
        ]);

        DB::table('services')->insert([
            'service_desc' => 'Migration',
        ]);

        DB::table('services')->insert([
            'service_desc' => 'Traning',
        ]);

        DB::table('services')->insert([
            'service_desc' => 'Security SPA',
        ]);

        DB::table('services')->insert([
            'service_desc' => 'Maintenance',
        ]);

        DB::table('services')->insert([
            'service_desc' => 'Other',
        ]);

        DB::table('events')->insert([
            'event_desc' => 'Bengkel 1',
        ]);

        DB::table('events')->insert([
            'event_desc' => 'Bengkel 2',
        ]);

        DB::table('events')->insert([
            'event_desc' => 'Bengkel 3',
        ]);

        DB::table('events')->insert([
            'event_desc' => 'Latihan Teknikal',
        ]);

        DB::table('hotels')->insert([
            'hotel_desc' => 'Bengkel 1',
        ]);

        DB::table('hotels')->insert([
            'hotel_desc' => 'Bengkel 2',
        ]);

        DB::table('hotels')->insert([
            'hotel_desc' => 'Bengkel 3',
        ]);

        DB::table('transportations')->insert([
            'transportation_desc' => 'Flight Veeco',
        ]);

        DB::table('infrastructures')->insert([
            'infrastructure_desc' => 'Server VPS 1',
        ]);

        DB::table('infrastructures')->insert([
            'infrastructure_desc' => 'Dedicated Server',
        ]);

        DB::table('marketings')->insert([
            'marketing_desc' => 'Video (training)',
        ]);

        DB::table('marketings')->insert([
            'marketing_desc' => 'Video (tv)',
        ]);

        DB::table('marketings')->insert([
            'marketing_desc' => 'Video promotion',
        ]);

        DB::table('marketings')->insert([
            'marketing_desc' => 'Design bunting',
        ]);

        DB::table('marketings')->insert([
            'marketing_desc' => 'Design Flyters',
        ]);

        DB::table('marketings')->insert([
            'marketing_desc' => 'Goodies',
        ]);

        DB::table('marketings')->insert([
            'marketing_desc' => 'Majlis opening',
        ]);
    }
}
