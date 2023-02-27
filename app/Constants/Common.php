<?php

namespace App\Constants;

class Common
{
  const PRODUCT_ADD = '1';
  const PRODUCT_REDUCE = '2';

  const PRODUCT_LIST = [
    'add' => self::PRODUCT_ADD,//クラスの中でconstを選択する際はselfを使用する
    'reduce' => self::PRODUCT_REDUCE
  ];
}