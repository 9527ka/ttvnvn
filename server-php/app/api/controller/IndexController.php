<?php
namespace app\api\controller;

use app\api\logic\IndexLogic;
use think\response\Json;
use app\common\model\Banner;
use app\api\lists\JobPositionsLists;
/**
 * index
 * Class IndexController
 * @package app\api\controller
 */
class IndexController extends BaseApiController
{
    public array $notNeedLogin = ['jobs','banner','index', 'config', 'policy', 'decorate'];

    //招聘列表
    public function jobs()
    {
        return $this->dataLists(new JobPositionsLists());
    }
    //轮播图
    public function banner()
    {
        $type = $this->request->get('type/s', '');
        $data = Banner::where('type',$type)->select()->toArray();
        return $this->success('success',$data);
    }
    /**
     * @notes 首页数据
     */
    public function index()
    {
        $result = IndexLogic::getIndexData();
        return $this->data($result);
    }

    /**
     * @notes 全局配置
     * @return Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @author 段誉
     * @date 2022/9/21 19:41
     */
    public function config()
    {
        $result = IndexLogic::getConfigData();
        return $this->data($result);
    }


    /**
     * @notes 政策协议
     * @return Json
     * @author 段誉
     * @date 2022/9/20 20:00
     */
    public function policy()
    {
        $type = $this->request->get('type/s', '');
        $result = IndexLogic::getPolicyByType($type);
        return $this->data($result);
    }


    /**
     * @notes 装修信息
     * @return Json
     * @author 段誉
     * @date 2022/9/21 18:37
     */
    public function decorate()
    {
        $id = $this->request->get('id/d');
        $result = IndexLogic::getDecorate($id);
        return $this->data($result);
    }


}