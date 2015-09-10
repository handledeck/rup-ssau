<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $menu=DB::table('menu');
        $menu->insert(array(
            'id'=>1,
            'name'=>'root'
        ));
        $menu->insert(array(
            'id'=>2,
            'name'=>'Электроэнергия',
            'parent'=>1
        ));
        $menu->insert(array(
            'id'=>3,
            'name'=>'Потребление',
            'icon'=>'io ion-speedometer',
            'parent'=>2
        ));
        $menu->insert(array(
            'id'=>4,
            'name'=>'Витебскэнерго',
            'icon'=>'',
            'parent'=>3
        ));
        $menu->insert(array(
            'id'=>5,
            'name'=>'Витебские ЭС',
            'parent'=>3
        ));
        $menu->insert(array(
            'id'=>6,
            'name'=>'Оршанские ЭС',
            'parent'=>3
        ));
        $menu->insert(array(
            'id'=>7,
            'name'=>'Полцкие ЭС',
            'parent'=>3
        ));
        $menu->insert(array(
            'id'=>8,
            'name'=>'Глубокские ЭС',
            'parent'=>3
        ));
	}

}
