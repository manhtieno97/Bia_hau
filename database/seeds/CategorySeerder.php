<?php
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategorySeerder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Bìa cứng','slug' => 'bia-cung','parent_id' => null,'color' => 'bg-orange-500','content'=> 'hhh','created_at' => Carbon::now()],
            ['name' => 'Bìa mềm','slug' => 'bia-mem','parent_id' => null,'color' => 'bg-orange-500','content'=> 'hhh','created_at' => Carbon::now()],
            ['name' => 'Mê ka','slug' => 'me-ka','parent_id' => null,'color' => 'bg-orange-500','content'=> 'hhh','created_at' => Carbon::now()],
            ['name' => 'Ốc bọ','slug' => 'oc-bo','parent_id' => null,'color' => 'bg-orange-500','content'=> 'hhh','created_at' => Carbon::now()],
        ]);
    }
}
