<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function index()
    {
        $stocks = DB::table('t_stocks')//商品ごとに数量を合計して新たにテーブルを作成
        ->select('product_id', 
        DB::raw('sum(quantity) as quantity'))//DB::rawでSQL文を直接使う
        ->groupBy('product_id')
        ->having('quantity', '>=', 1);//数量の合計が1以上か

        $products = DB::table('products')
        ->joinSub($stocks, 'stock', function($join){//$stocksテーブルに別名をつける(stock)
            $join->on('products.id', '=', 'stock.product_id');//ProductテーブルとStockテーブルを結合する
        })
        ->join('shops', 'products.shop_id', '=', 'shops.id')//Shopテーブルを結合する
        ->join('secondary_categories', 'products.secondary_category_id', '=', 'secondary_categories.id')
        ->join('images as image1', 'products.image1', '=', 'image1.id')
        ->join('images as image2', 'products.image2', '=', 'image2.id')
        ->join('images as image3', 'products.image3', '=', 'image3.id')
        ->join('images as image4', 'products.image4', '=', 'image4.id')
        ->where('shops.is_selling', true)//販売中か
        ->where('products.is_selling', true)//販売中か
        ->select('products.id as id', 'products.name as name', 'products.price'
        ,'products.sort_order as sort_order'
        ,'products.information', 'secondary_categories.name as category'
        ,'image1.filename as filename')
        ->get();//getで指定したテーブルのレコードを取得

        // dd($stocks, $products);
        // $products = Product::all();

        return view('user.index', compact('products'));
    }
}