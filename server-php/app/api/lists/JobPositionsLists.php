<?php
namespace app\api\lists;

use app\api\lists\BaseApiDataLists;
use app\common\enum\YesNoEnum;
use app\common\lists\ListsSearchInterface;
use app\common\model\JobPositions;

/**
 * 招聘列表
 * Class JobPositionsLists
 * @package app\api\lists\JobPositions
 */
class JobPositionsLists extends BaseApiDataLists implements ListsSearchInterface
{

    /**
     * @notes 搜索条件
     * @return \string[][]
     * @author 段誉
     * @date 2022/9/16 18:54
     */
    public function setSearch(): array
    {
        return [
            '=' => ['id']
        ];
    }


    /**
     * @notes 自定查询条件
     * @return array
     * @author 段誉
     * @date 2022/10/25 16:53
     */
    public function queryWhere()
    {
        $where[] = ['id', '>', 0];
        if (!empty($this->params['keyword'])) {
            $where[] = ['position_name', 'like', '%' . $this->params['keyword'] . '%'];
        }
        return $where;
    }


    /**
     * @notes 获取招聘列表
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * @author 段誉
     * @date 2022/9/16 18:55
     */
    public function lists(): array
    {
        $orderRaw = 'id desc';
        $sortType = $this->params['sort'] ?? 'default';
        
        $field = '*';
        $result = JobPositions::field($field)
            ->where($this->queryWhere())
            ->where($this->searchWhere)
            ->orderRaw($orderRaw)
            ->limit($this->limitOffset, $this->limitLength)
            ->select()->toArray();
        return $result;
    }


    /**
     * @notes 获取招聘数量
     * @return int
     * @author 段誉
     * @date 2022/9/16 18:55
     */
    public function count(): int
    {
        return JobPositions::where($this->searchWhere)
            ->where($this->queryWhere())
            ->count();
    }
}