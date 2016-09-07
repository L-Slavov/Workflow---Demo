<?php

use Illuminate\Database\Seeder;
use App\Partner;

class PartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partner::create([
        	'name'=>"LyuboINC"
        	]);
        Partner::create([
        	'name'=>'Classic2000'
        	]);
    }
}
