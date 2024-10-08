<template>
    <Ui-Header />
    <div class="banner" >
        <img src="@/assets/home/banner_news.png" alt="">
    </div>
    <!-- <div class="nav">
        <ul class="header_nav pc">
            <li class="add">Tin tức</li>
            <li>Phân loại 1</li>
            <li>Phân loại 2</li>
            <li>Phân lo</li>
        </ul>
    </div> -->
    <div class="select pc flex">
        <div class="select_in">
            <input type="text" placeholder="Vui lòng nhập vị trí bạn đang tìm kiếm" v-model="keyword">
            <button class="btn" @click="getNewList">Tìm thấy</button>
        </div>
    </div>
    <div class="ber pc"></div>
    <div class="news_list pc" v-if="news_list.length > 0" :style="{
        'grid-template-columns' : isSidebarVisible ? 'repeat(3, 1fr)' : isSidebarVisible700 ? 'repeat(2, 1fr)' : 'repeat(1, 1fr)',
        'padding': isSidebarVisible ? '40px 0 50px' :  '40px 10px 50px'
        }"
        
        >
        <div class="news_list_box" v-for="el in news_list" :key="el">
            <a :href="'/detail?id=' + el.id">
                <img :src="el.image">
                <div>{{ el.create_time }}</div>
                <span>{{ el.title }}</span>
            </a>
        </div>
    </div>
    <div class="news_list pc" v-else style="color:#8a8a8a;height:300px;" >Không tìm thấy dữ liệu, hãy thử các từ khóa
        khác...</div>

    <div class="paginator pc">
        <div class="example-one" v-if="news_list.length > 0">
            <vue-awesome-paginate :total-items="total" :items-per-page="9" :max-pages-shown="5" v-model="currentPage"
                @click="onClickHandler" />
        </div>
    </div>
    <Ui-Footer />
</template>

<script setup>
import { ref ,onMounted,onUnmounted} from 'vue';
const isSidebarVisible = ref(true)
const isSidebarVisible700 = ref(true)
import { fetchArticles } from '../api/request.js';
const keyword = ref('');
const currentPage = ref(1);
//新闻资讯
const news_list = ref([]);
const total = ref([]);
const getNewList = async () => {
    console.log(keyword.value)
    const res = await fetchArticles(1, currentPage.value, 9, keyword.value);
    total.value = res.data.count
    news_list.value = res.data.lists;
};
const onClickHandler = async (num) => {
    currentPage.value = num
    getNewList()
}
onMounted(() => {
    getNewList()
    checkSidebarVisibility();
    window.addEventListener('resize', checkSidebarVisibility);
})
onUnmounted(()=>{
    window.removeEventListener('resize', checkSidebarVisibility);
})
const checkSidebarVisibility = () => {
    isSidebarVisible.value = window.innerWidth > 1200;
    isSidebarVisible700.value = window.innerWidth > 700 && window.innerWidth < 1200;
}
</script>

<style>
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

.example-one .active-page:hover {}

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
    background: url('../assets/home/banner_news.png') no-repeat;
    background-size: cover; */
    max-height: 350px;
    img{
        height:100%;
        max-height: 350px;
        width:100%;
    }
}

.nav {
    height: 42px;
    color: #373737;
    background: #F2F7FA;

    .header_nav {
        font-size: 12px;
        display: flex;
        align-items: center;
        height: 100%;

        li {
            padding: 0 20px;
            font-weight: bold;
            cursor: pointer;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        li::after {
            display: none;
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 3px;
            background-color: #1e90ff;
            border-radius: 2px;
        }

        // li:hover::after {
        //     display: block;
        // }
        li.add::after {
            display: block;
        }
    }
}

.select {
    padding: 40px 0;

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
            border: unset;
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

.ber {
    height: 2px;
    background: rgba(96, 96, 96, .15);
}

.news_list {
    padding: 40px 0 50px;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;

    .news_list_box {
        // width: 238px;
        // padding: 0 20px;
        line-height: 21px;
        color: #000;

        img {
            width: 100%;
            height: 159px;
            object-fit: cover;
        }

        div {
            margin: 10px 0;
            color: #7E7E7E;
        }
    }
}

.paginator {
    display: flex;
    align-items: center;
    justify-content: center;
    // margin: 70px auto;
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

.pagination-container {
    display: flex;

    column-gap: 10px;
}

.back-button {
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

.paginate-buttons {
    height: 40px;

    width: 40px;

    border-radius: 20px;

    cursor: pointer;

    background-color: rgb(242, 242, 242);

    border: 1px solid rgb(217, 217, 217);

    color: black;
}

.paginate-buttons:hover {
    background-color: #d8d8d8;
}

.active-page {
    background-color: #3498db;

    border: 1px solid #3498db;

    color: white;
}

.active-page:hover {
    background-color: #2988c8;
}
</style>