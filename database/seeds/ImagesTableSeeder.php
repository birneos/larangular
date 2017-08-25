<?php

use Illuminate\Database\Seeder;
use App\Image;
use Faker\Factory as Faker;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $imageLinks = array(
        "https://angularbooks.com/img/angular4/img1",
        "https://angularbooks.com/img/angular4/img2",
        "https://angularbooks.com/img/angular4/img3",
        "https://angularbooks.com/img/angular4/img4",
        "https://angularbooks.com/img/angular4/img5",
        "https://angularbooks.com/img/angular4/img6",
        "https://angularbooks.com/img/angular4/img7",
        "https://angularbooks.com/img/angular4/img8", 
    );

                foreach($imageLinks as $imageLink)
                {

                    Image::create([
                        'title' => $faker->text(80),
                        'description' => $content = $faker->paragraph(18),
                        'thumbnail' => $imageLink.".jpg",
                        'imageLink' => $imageLink."-l.jpg",
                        'user_id' => $faker->numberBetween($min = 1, $max = 5),
                    ]);
                }
    }
}
