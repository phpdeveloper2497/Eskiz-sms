<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'name' => [
                'en' => 'New',
                'ru' => 'Новый',
                'uz' => 'Yangi'
            ],
        ]);
        Status::create([
            'name' => [
                'en' => 'Under review',
                'ru' => 'На рассмотрении',
                'uz' => 'Ko\'rib chiqilmoqda'
            ],
        ]);
        Status::create([
            'name' => [
                'en' => 'Being analyzed',
                'ru' => 'Aнализируется',
                'uz' => 'Tahlil qilinmoqda'
            ],
        ]);
        Status::create([
            'name' => [
                'en' => 'Approved',
                'ru' => 'Одобренный',
                'uz' => 'Tasdiqlandi'
            ],
        ]);
        Status::create([
            'name' => [
                'en' => 'Rejected',
                'ru' => 'Отклоненный',
                'uz' => 'Rad etildi'
            ],
        ]);
    }
}
