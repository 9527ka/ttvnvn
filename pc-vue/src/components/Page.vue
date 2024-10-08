<template>
    <el-config-provider>
        <el-pagination background class="lj-paging" layout="prev, pager, next, jumper" :pager-count="5" :total="total"
            :current-page="pageIndex" :page-size="pageSize" @current-change="changePage" />
    </el-config-provider>
</template>

<script lang='ts' setup>
type TProps = {
    pageIndex: number
    pageSize: number
    total: number
}
const props = withDefaults(defineProps<TProps>(), {})

const emit = defineEmits(['onChangePage'])

const changePage = (page: number) => {
    emit('onChangePage', page)
}


</script>

<style lang='scss' scoped>
.lj-paging {
    :deep(button) {
        border-radius: 50%;
        margin: 0 4px;
        width: 40px;
        height: 40px;

        i {
            font-size: 20px !important;
        }
    }

    :deep(.el-pager) {
        li {
            width: 40px;
            height: 40px;
            line-height: 40px;
            font-size: 20px;
            border-radius: 50%;
            margin: 0 4px;
            color: #757B92;

            &.is-active {
                border: 1px solid #5C7DEE;
                background: #5C7DEE;
                box-shadow: 0 0 10px 0#6268FF;
                color: #ffffff;
                font-weight: normal;
            }
        }
    }

    :deep(.el-pagination__jump) {
        font-size: 16px;
    }

    :deep(.el-input__inner) {
        font-size: 20px !important;
    }
}
</style>