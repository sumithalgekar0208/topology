<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NodeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            0 => array('name' => 'CCR', 'background_color' => '#73A5DF', 'border_color' => '#73A5DF', 'shape' => 'circle'),
            1 => array('name' => 'MAG2', 'background_color' => '#D9825C', 'border_color' => '#D9825C', 'shape' => 'box'),
            2 => array('name' => 'PEYTO', 'background_color' => '#5CD98A', 'border_color' => '#5CD98A', 'shape' => 'ellipse'),
        );
        
        foreach ($data as $val) {
            DB::table('node_types')->insert([
                'name' => $val['name'],
                'background_color' => $val['background_color'],
                'border_color' => $val['border_color'],
                'shape' => $val['shape']
            ]);
        }
    }
}
