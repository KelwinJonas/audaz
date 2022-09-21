<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operator::create(['code' => 'OP01']);
        Operator::create(['code' => 'OP02']);
        Operator::create(['code' => 'OP03']);
        Operator::create(['code' => 'OP04']);
    }
}
