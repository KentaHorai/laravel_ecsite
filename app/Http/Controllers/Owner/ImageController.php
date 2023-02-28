<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('image'); 
            if(!is_null($id)){ 
            $imagesOwnerId = Image::findOrFail($id)->owner->id;
                $imageId = (int)$imagesOwnerId; 
                if($imageId !== Auth::id()){ 
                    abort(404);
                }
            }
            return $next($request);
        });
    } 


    public function index()
    {
        $images = Image::where('owner_id', Auth::id())
        ->orderBy('updated_at', 'desc')
        ->paginate(20);

        return view('owner.images.index', 
        compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        //画像を複数アップロード
        $imageFiles = $request->file('files');//fileメソッドでname属性のfilesを指定する(resources\views\owner\images\create.blade.phpで指定したname属性)、複数の画像を配列形式で取得
        if(!is_null($imageFiles)){//app\Http\Requests\UploadImageRequest.phpで必須(required)でバリデーションをかけているのでnull判定は不要だが、念のため記述
            foreach($imageFiles as $imageFile){//複数形as単数形で1つずつImageService::uploadで処理し、ファイル名を返り値として取得
                $fileNameToStore = ImageService::upload($imageFile, 'products');    
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameToStore  
                ]);
            }
        }

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像登録を実施しました。',
        'status' => 'info']);
    }

    
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('owner.images.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:50'
        ]);

        $image = Image::findOrFail($id);
        $image->title = $request->title;
        $image->save();

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像情報を更新しました。',
        'status' => 'info']);
    }


    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        
        $imageInProducts = Product::where('image1', $image->id)//削除したい画像が商品画像に使用されていたら
        ->orWhere('image2', $image->id)
        ->orWhere('image3', $image->id)
        ->orWhere('image4', $image->id)
        ->get();//画像が使用されている商品の情報を全て取得

        if($imageInProducts){//変数の中に値が入っていたら
            $imageInProducts->each(function($product) use($image){//$imageInProductsはCollection型のため、メソッドを繋げることができる(eachメソッドでCollectionの中の1つずつの要素に処理ができる)
                if($product->image1 === $image->id){//削除したい画像がimage1に設定されていたら
                    $product->image1 = null;
                    $product->save();
                }
                if($product->image2 === $image->id){
                    $product->image2 = null;
                    $product->save();
                }
                if($product->image3 === $image->id){
                    $product->image3 = null;
                    $product->save();
                }
                if($product->image4 === $image->id){
                    $product->image4 = null;
                    $product->save();
                }//全ての商品のそれぞれimage1からimage4に対してチェックする
            });
        }
        
        $filePath = 'public/products/' . $image->filename;

        if(Storage::exists($filePath)){///ファイルパスがあったら(ストレージに画像があったら)
            Storage::delete($filePath);
        }

        Image::findOrFail($id)->delete(); 

        return redirect()
        ->route('owner.images.index')
        ->with(['message' => '画像を削除しました。',
        'status' => 'alert']);
    }
}