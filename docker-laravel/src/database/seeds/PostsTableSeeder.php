<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $faker = Faker\Factory::create('ja_JP');
    //clear data
    // DB::table('posts')->truncate();

    // ランダムに記事を作成
    for ($i = 0; $i < 80; $i++) {
      DB::table('posts')->insert([
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime(),
                'title' => $faker->text(20),
                'image_top' => $faker->url,
                'thumbnail_pc' => $faker->url,
                'thumbnail_mobile' => $faker->url,
                'image_seq1' => $faker->url,
                'image_seq2' => $faker->url,
                'image_seq3' => $faker->url,
                'image_seq4' => $faker->url,
                'sequence_body' => $faker->text(200),
                'cooking_time' => $faker->numberBetween(1, 40),
                'budget' => $faker->numberBetween(100, 500),
                'user_id' => $faker->numberBetween(1, 20),
                // 'using_status' => $faker->boolean(50),
            ]);
    }
    // for ($i = 0; $i < 10; $i++) {
        //     DB::table('posts')->insert([
        //         'image_seq3' => $faker->url,
        //         'image_seq4' => $faker->url
        //     ]);
        // }
  }
}
