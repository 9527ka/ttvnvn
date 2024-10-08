<template>
    <Ui-Header />
    <div class="banner" >
        <img src="@/assets/home/banner_adv.png" alt="">
    </div>
    <div class="select flex_c">
        <!-- <div class="select_s flex_c">
            loại
        </div> -->
        <div class="select_in">
            <input type="text" placeholder="Vui lòng nhập vị trí bạn đang tìm kiếm" v-model="keyword">
            <div class="btn" @click="getAdvList"><img src="../assets/home/select1.png"></div>
        </div>
    </div>

    <div class="adv_list">
        <div class="cell_list pc" v-if="adv_list.length > 0">
            <div class="row active_row" v-for="(el, index) in adv_list" :key="el.id">
                <div class="common_content" :class="{ active_bg: el.isActive }" @click="toggleActive(index)">
                    <div class="cell_item" style="width:30%;">
                        <p class="item_label" style="color:#424547;">{{ el.position_name }}</p>
                    </div>
                    <div class="cell_item">
                        <p class="item_label">số lượng tuyển dụng</p>
                        <span class="num_text">{{ el.recruitment_number }}</span>
                    </div>
                    <div class="cell_item">
                        <p class="item_label">nơi làm việc</p>
                        <p class="num_text">{{ el.work_location }}</p>
                    </div>
                    <div class="cell_item">
                        <p class="item_label">ngày phát hành</p>
                        <p class="num_text date">{{ el.create_time }}</p>
                    </div>
                    <div class="cell_item arrow" :class="{ down: el.isActive }">
                        <svg t="1728119181193" class="icon" viewBox="0 0 1024 1024" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" p-id="1783" id="mx_n_1728119181194" width="20"
                            height="30">
                            <path
                                d="M784.91 500.586c-0.096-0.096-472.883-473.279-472.883-473.279-7.865-8.069-20.89-8.233-28.959-0.369-8.069 7.865-8.233 20.89-0.369 28.959l458.561 458.848-457.756 452.745c-8.069 7.865-8.233 20.89-0.369 28.959 7.865 8.069 20.89 8.233 28.959 0.369l472.446-467.285c8.069-7.851 8.233-20.876 0.369-28.945z"
                                fill="#51595E" p-id="1784"></path>
                        </svg>
                    </div>
                </div>
                <div v-if="el.isActive" class="active_content">
                    <!-- <img class="active_img" src="../assets/home/active_img.png" alt="" srcset=""> -->
                    <div class="active_content_desc">
                        <div class="desc_1">
                            <p class="desc_title_text">Trách nhiệm công việc</p>
                            <p class="desc_main_text" v-html="el.responsibilities"></p>
                        </div>
                        <div class="desc_1">
                            <p class="desc_title_text">Yêu cầu công việc</p>
                            <p class="desc_main_text" v-html="el.requirements"></p>
                        </div>
                        <!-- <div class="active_content_btn">Áp dụng</div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="cell_list pc" v-else style="color:#8a8a8a;height:300px;">Không tìm thấy dữ liệu, hãy thử các từ khóa
            khác...
        </div>

        <div class="paginator pc">
            <div class="example-one" v-if="adv_list.length > 0">
                <vue-awesome-paginate :total-items="total" :items-per-page="9" :max-pages-shown="5"
                    v-model="currentPage" @click="onClickHandler" />
            </div>
        </div>
    </div>
    <Ui-Footer />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { fetchAdvLists } from '../api/request.js';
const keyword = ref('');
const currentPage = ref(1);
//招聘列表
const adv_list = ref([]);
const total = ref([]);
const getAdvList = async () => {
    const res = await fetchAdvLists(1, currentPage.value, 9, keyword.value);
    total.value = res.data.count
    adv_list.value = res.data.lists.map(item => ({ ...item, isActive: false }));
};
const onClickHandler = async (num) => {
    currentPage.value = num
    getAdvList()
}
const toggleActive = (index) => {
    adv_list.value[index].isActive = !adv_list.value[index].isActive;

    // 如果当前行是激活的，则关闭其他所有行
    if (adv_list.value[index].isActive) {
        adv_list.value.forEach((el, i) => {
            if (i !== index) {
                el.isActive = false;
            }
        });
    }
};
onMounted(() => {
    getAdvList()
});
</script>

<style>
@media (max-width: 430px) {
    .adv_list .cell_list .common_content .item_label,.adv_list .cell_list .common_content .num_text,.adv_list .cell_list .common_content .cell_item{
    font-size: 14px !important;
    font-weight:unset !important;
  }
  
}
.row {
    background-color: #F2F7FA;
    margin-bottom: 5px;
}
/* 为偶数行设置背景色 */
.row:nth-child(even) {
    background-color: #E1ECF2;
}

.common_content.active_bg {
    background: linear-gradient(90deg, #929292, #00639E, #00A0E9);
}

.common_content.active_bg .item_label,
.common_content.active_bg .num_text {
    color: #ffffff !important;
}

.arrow {
    transition: transform 0.3s ease;
}

.arrow.down {
    transform: rotate(90deg);
}

.active_row {
    cursor: pointer;
}

.example-one .pagination-container {
    column-gap: 10px;

}

.example-one .paginate-buttons {
    height: 40px;
    width: 40px;
    border-radius: 20px;
    cursor: pointer;
    background-color: #00A0E9;
    border: 1px solid #00A0E9;
    color: #ffffff;
}

.example-one .paginate-buttons:hover {
    background-color: #ffffff;
    color: #00A0E9;
}

.example-one .active-page {
    color: #3498db !important;
}

.example-one .back-button:active,
.example-one .next-button:active {
    background-color: #c4c4c4;
}

.example-one .number-buttons {
    background-color: unset;
    color: #000;
    font-size: 16px;
    border: unset;
}
</style>

<style lang="less" scoped>
.banner {
    margin-top: 80px;
    /* height: 279px;
    background: url('../assets/home/banner_adv.png') no-repeat;
    background-size: cover; */
    max-height: 350px;
    img{
        height:100%;
        max-height: 350px;
        width:100%;
    }
}

.select {
    padding: 40px 0;

    .select_s {
        width: 176px;
        height: 55px;
        border-radius: 10px;
        background: #F2F7FA;
        color: #CCCFD1;
        // font-size: 12px;
    }

    .select_in {
        width: 596px;
        height: 55px;
        background: #F2F7FA;
        border-radius: 10px;
        margin-left: 10px;
        position: relative;

        input {
            width: 100%;
            height: 100%;
            border: none;
            outline: none;
            padding: 0 75px 0 10px;
            background: #F2F7FA;
        }

        .btn {
            top: 5px;
            right: 4px;
            position: absolute;
            width: 116px;
            height: 45px;
            border-radius: 5px;
            background: #00A0E9;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            cursor: pointer;

            img {
                width: 29px;
                height: 29px;
            }
        }
    }
}
.adv_list {
    .cell_list {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        .row {
            max-width: 1200px;
            width: 97%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .common_content {
            padding: 20px 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 4px;

            .cell_item {
                flex-direction: column;
                font-family: 'Krub-SemiBold';
                font-weight: 600;
                font-size: 22px;
                color: #81878B;
                text-align: center;
                align-items: center;
            }

            .item_label {
                font-family: 'Krub-SemiBold';
                font-weight: 600;
                font-size: 16px;
                color: #81878B;
                margin-bottom: 14px;
            }

            .num_text {
                font-family: 'Krub-SemiBold';
                font-weight: 600;
                font-size: 16px;
                color: #687379;
            }
        }
    }

    .active_content {
        display: flex;
        padding: 15px 0;
        // width: 100%;
            width: 95%;

        .active_img {
            width: 60%;
            height: auto;
        }

        .active_content_desc {
            flex: 1;
        }

        .desc_main_text {
            font-family: Krub;
            font-weight: 400;
            font-size: 18px;
            color: #5B5B5B;
            line-height: 30px;
            margin-bottom: 20px;
        }

        .active_content_btn {
            width: 142px;
            height: 52px;
            background-color: #00A0E9;
            font-family: Krub;
            font-weight: 400;
            font-size: 20px;
            color: #FFFFFF;
            text-align: center;
            line-height: 52px;
        }
    }

    .desc_title_text {
        font-family: Krub;
        font-weight: 600;
        font-size: 20px;
        color: #000000;
        margin-bottom: 20px;
    }
}

.paginator {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 0;

    .paginator_left_arrow,
    .paginator_left_arrow {
        width: 39px;
        height: 39px;
        background-color: #00A0E9;
        border-radius: 50%;
        line-height: 39px;
        text-align: center;
        font-family: JLinXin;
        font-weight: 400;
        font-size: 20px;
        color: #FFFFFF;
    }

    .page_num {
        width: 161px;
        display: flex;
        justify-content: space-between;
        font-family: Microsoft YaHei UI;
        font-weight: bold;
        font-size: 20px;
        color: #606060;
        margin: 0 35px;
    }
}
</style>