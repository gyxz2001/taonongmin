<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 18:20
 */

namespace app\index\model;
use think\Model;

class Product extends Model
{

    /**
     * 关联 Category模型
     */
    public function category()
    {
        return $this->hasOne('category', 'id', 'productCategoryId');
    }
}