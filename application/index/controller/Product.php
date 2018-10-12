<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/11
 * Time: 18:16
 */

namespace app\index\controller;
use think\Controller;
use app\index\model\Product as ProductModel;
use think\facade\Request;
use think\Db;

class Product extends Controller
{
    /**
     * 产品列表
     * @return json
     * @throws \think\exception\DbException
     */
    public function index()
    {
        /* 当前分页 */
        $pageNum = Request::param('pageNum');
        /* 取得条数 */
        $pageSize = Request::param('pageSize');

        /* 产品列表总数 */
        $count = Db::name('product')
            ->limit($pageNum, $pageSize)
            ->count();

        /* 返回字段 */
        $fields = [
            'sort_num',
            'id',
            'thumbnail' => 'thumbnail_temp',
            'name',
            'sales',
            'price',
            'marketPrice',
            'isRecommend',
            'stock'
        ];

        /* 查询产品 */
        $data = Db::name('product')
            ->field($fields)
            ->limit($pageNum, $pageSize)
            ->select();

        /* 返回数据 */
        $data = [
            'data' => [
                'list' => $data,
                'page' => $count
            ]
        ];

        return json_encode($data);
    }

    /**
     * 产品分页
     */
    public function getProductPage()
    {
        return [
            'pageNum' => count(ProductModel::all()),
            'isMarketable' => true,
            'pageSize' => ''
        ];
    }
}