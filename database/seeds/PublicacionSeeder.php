<?php

use Illuminate\Database\Seeder;
use App\Publicacion;

class PublicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Publicacion::class,50)->create();
    }
}
