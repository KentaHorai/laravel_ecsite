<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;
use App\Models\SecondaryCategory;
use App\Models\Image;

class Product extends Model
{
    use HasFactory;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function category()
    {
        return $this->belongsTo(SecondaryCategory::class, 'secondary_category_id');//メソッド名をsecondaryCategoryではなくcategoryにしているため、第2引数で外部キーのカラム名を設定
    }

    public function imageFirst()//image1はデータベースのテーブル名と同じでエラーとなるため、imageFirstとする
    {
        return $this->belongsTo(Image::class, 'image1', 'id');//第2引数で外部キーのカラム名を設定、第3引数でimageモデルのidと紐づける
    }
}