<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;//インターベンションイメージを読み込む


class ImageService
{
  public static function upload($imageFile, $folderName){//staticで記述するとコロン2つで呼び出すことができる
    //dd($imageFile['image']);
    if(is_array($imageFile))//配列かどうか(下の処理の$fileは、配列形式では上手く動かないため)
    {
      $file = $imageFile['image'];//配列なら画像ファイルを取得
    } else {
      $file = $imageFile;
    }

    $fileName = uniqid(rand().'_');//ユニークIDを生成
    $extension = $file->extension();//拡張子を取得
    $fileNameToStore = $fileName. '.' . $extension;//上記2つを繋げてファイル名を生成
    $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();//encode()とすることで画像として扱う
    Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage );//第1引数(フォルダ名+ファイル名)、第2引数(リサイズした画像)
    
    return $fileNameToStore;
  }
}
//Storage:putFileはFileオブジェクトを想定
//Storage:putは、フォルダがない場合は自動で生成、ファイル名は自分で指定する