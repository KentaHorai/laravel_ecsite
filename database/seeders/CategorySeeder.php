<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('primary_categories')->insert([
            [
                'name' => '東京ディズニーランド',
                'sort_order' => 1,
            ],
            [
                'name' => '東京ディズニーシー',
                'sort_order' => 2,
            ],
            [
                'name' => 'ディズニーホテル',
                'sort_order' => 3,
            ],
            [
                'name' => 'バケーションパッケージ',
                'sort_order' => 4,
            ],
        ]);

        DB::table('secondary_categories')->insert([
            [
                'name' => 'スプラッシュマウンテン',
                'sort_order' => 1,
                'primary_category_id' => 1
            ],
            [
                'name' => 'ミッキーのフィルハーマジック',
                'sort_order' => 2,
                'primary_category_id' => 1
            ],
            [
                'name' => 'ホーンテッド・マンション',
                'sort_order' => 3,
                'primary_category_id' => 1
            ],
            [
                'name' => '美女と野獣"魔法のものがたり"',
                'sort_order' => 4,
                'primary_category_id' => 1
            ],
            [
                'name' => 'ソアリン：ファンタスティック・フライト',
                'sort_order' => 5,
                'primary_category_id' => 2
            ],
            [
                'name' => 'タワー・オブ・テラー',
                'sort_order' => 6,
                'primary_category_id' => 2
            ],
            [
                'name' => 'シンドバッド・ストーリーブック・ヴォヤッジ',
                'sort_order' => 7,
                'primary_category_id' => 2
            ],
            [
                'name' => '東京ディズニーランドホテル',
                'sort_order' => 8,
                'primary_category_id' => 3
            ],
            [
                'name' => 'ディズニーアンバサダーホテル',
                'sort_order' => 9,
                'primary_category_id' => 3
            ],
            [
                'name' => '東京ディズニーシー・ホテルミラコスタ',
                'sort_order' => 10,
                'primary_category_id' => 3
            ],
            [
                'name' => '東京ディズニーリゾート・トイ・ストーリーホテル',
                'sort_order' => 11,
                'primary_category_id' => 3
            ],
            [
                'name' => '東京ディズニーセレブレーションホテル',
                'sort_order' => 12,
                'primary_category_id' => 3
            ],
        ]);

    }
}