<?php
// +----------------------------------------------------------------------
// | likeadmin快速开发前后端分离管理后台（PHP版）
// +----------------------------------------------------------------------
// | 欢迎阅读学习系统程序代码，建议反馈是我们前进的动力
// | 开源版本可自由商用，可去除界面版权logo
// | gitee下载：https://gitee.com/likeshop_gitee/likeadmin
// | github下载：https://github.com/likeshop-github/likeadmin
// | 访问官网：https://www.likeadmin.cn
// | likeadmin团队 版权所有 拥有最终解释权
// +----------------------------------------------------------------------
// | author: likeadminTeam
// +----------------------------------------------------------------------


namespace app\adminapi\controller;


use app\adminapi\controller\BaseAdminController;
use app\adminapi\lists\JobPositionsLists;
use app\adminapi\logic\JobPositionsLogic;
use app\adminapi\validate\JobPositionsValidate;


/**
 * JobPositions控制器
 * Class JobPositionsController
 * @package app\adminapi\controller
 */
class JobPositionsController extends BaseAdminController
{


    /**
     * @notes 获取列表
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/10/04 15:22
     */
    public function lists()
    {
        return $this->dataLists(new JobPositionsLists());
    }


    /**
     * @notes 添加
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/10/04 15:22
     */
    public function add()
    {
        $params = (new JobPositionsValidate())->post()->goCheck('add');
        $result = JobPositionsLogic::add($params);
        if (true === $result) {
            return $this->success('添加成功', [], 1, 1);
        }
        return $this->fail(JobPositionsLogic::getError());
    }


    /**
     * @notes 编辑
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/10/04 15:22
     */
    public function edit()
    {
        $params = (new JobPositionsValidate())->post()->goCheck('edit');
        $result = JobPositionsLogic::edit($params);
        if (true === $result) {
            return $this->success('编辑成功', [], 1, 1);
        }
        return $this->fail(JobPositionsLogic::getError());
    }


    /**
     * @notes 删除
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/10/04 15:22
     */
    public function delete()
    {
        $params = (new JobPositionsValidate())->post()->goCheck('delete');
        JobPositionsLogic::delete($params);
        return $this->success('删除成功', [], 1, 1);
    }


    /**
     * @notes 获取详情
     * @return \think\response\Json
     * @author likeadmin
     * @date 2024/10/04 15:22
     */
    public function detail()
    {
        $params = (new JobPositionsValidate())->goCheck('detail');
        $result = JobPositionsLogic::detail($params);
        return $this->data($result);
    }


}