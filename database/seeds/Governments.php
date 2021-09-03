<?php

use Illuminate\Database\Seeder;
use App\Government;

class Governments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Government::create([
            'name'=>'القاهرة'
        ]);

        Government::create([
            'name'=>'الإسكندرية'
        ]);
        Government::create([
            'name'=>'الإسماعيلية'
        ]);
        Government::create([
            'name'=>'أسوان'
        ]);
        Government::create([
            'name'=>'أسيوط'
        ]);
        Government::create([
            'name'=>'الأقصر'
        ]);
        Government::create([
            'name'=>'البحر الأحمر'
        ]);
        Government::create([
            'name'=>'البحيرة'
        ]);
        Government::create([
            'name'=>'بني سويف'
        ]);
        Government::create([
            'name'=>'بورسعيد'
        ]);
        Government::create([
            'name'=>'جنوب سيناء'
        ]);
        Government::create([
            'name'=>'الجيزة'
        ]);
        Government::create([
            'name'=>'الدقهلية'
        ]);
        Government::create([
            'name'=>'سوهاج'
        ]);
        Government::create([
            'name'=>'السويس'
        ]);
        Government::create([
            'name'=>'الشرقية'
        ]);
        Government::create([
            'name'=>'شمال سيناء'
        ]);
        Government::create([
            'name'=>'الغربية'
        ]);
        Government::create([
            'name'=>'الفيوم'
        ]);
        Government::create([
            'name'=>'القليوبية'
        ]);
        Government::create([
            'name'=>'قنا'
        ]);
        Government::create([
            'name'=>'كفر الشيخ'
        ]);
        Government::create([
            'name'=>'مطروح'
        ]);
        Government::create([
            'name'=>'المنوفية'
        ]);
        Government::create([
            'name'=>'المنيا'
        ]);
        Government::create([
            'name'=>'الوادي الجديد'
        ]);

    }
}
