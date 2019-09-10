<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = array('id');
    protected $table = 'create_goods_table';
    // 以下を追記
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',

    );

    // 以下を追記
    // Shopモデルに関連付けを行う
    public function histories()
    {
      return $this->hasMany('App\History');

    }
}