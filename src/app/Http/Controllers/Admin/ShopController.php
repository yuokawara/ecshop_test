<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// 以下を追記することでShop Modelが扱えるようになる
use App\Shop;

class ShopController extends Controller
{
  public function add()
  {
      return view('admin.shop.create');
  }

  public function create(Request $request)
  {

      // 以下を追記
      // Varidationを行う
      $this->validate($request, Shop::$rules);

      $goods = new shop;
      $form = $request->all();

      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $goods->image_path = basename($path);
      } else {
          $goods->image_path = null;
      }

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      // フォームから送信されてきたimageを削除する
      unset($form['image']);

      // データベースに保存する
      $goods->fill($form);
      $goods->save();

      return redirect('admin/shop/create');
  }
  public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          $posts = Shop::where('title', $cond_title)->get();
      } else {
          $posts = Shop::all();
      }
      return view('admin.shop.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

  // 以下を追記

  public function edit(Request $request)
  {
      // Shop Modelからデータを取得する
      $goods = Shop::find($request->id);
      if (empty($goods)) {
        abort(404);    
      }
      return view('admin.shop.edit', ['goods_form' => $goods]);
  }


  public function update(Request $request)
  {
    // Validationをかける
    $this->validate($request, Shop::$rules);
    // Shop Modelからデータを取得する
    $goods = Shop::find($request->id);
    // 送信されてきたフォームデータを格納する
    $goods_form = $request->all();
    if (isset($goods_form['image'])) {
      $path = $request->file('image')->store('public/image');
      $goods->image_path = basename($path);
      unset($goods_form['image']);
    } elseif (0 == strcmp($request->remove, 'true')) {
      $goods->image_path = null;
    }
    unset($goods_form['_token']);
    unset($goods_form['remove']);

    // 該当するデータを上書きして保存する
    $goods->fill($goods_form)->save();

    return redirect('admin/shop');
  }
  // 以下を追記　　
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $goods = Shop::find($request->id);
      // 削除する
      $goods->delete();
      return redirect('admin/shop/');
  }  
}
