<template>
    <Ui-Header />
    <!-- <div class="banner" /> -->
        <div class="banner" >
        <img src="@/assets/home/banner_news.png" alt="">
    </div>

    <div class="ber pc"></div>
    <div class="pc detail-box">
        <div class="title">
            {{ detail.title }}
        </div>
        <div class="desc">{{ detail.create_time }}</div>
        <div class="content" v-html="detail.content" style="width: 96%;margin: 0 auto;"></div>
    </div>
    <Ui-Footer />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { fetchArticlesInfo } from '../api/request.js';
//新闻资讯
const detail = ref([]);
const getDetail = async () => {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    const res = await fetchArticlesInfo(id);
    detail.value = res.data;
};
onMounted(() => {
    getDetail()
});
</script>

<style lang="less" scoped>
// html, body {
//      height: auto !important;
// }
.detail-box {
    max-width: 900px;
    line-height: 24px;
    margin-bottom: 100px;
}

.title {
    margin: 80px 0 25px 0;
    text-align: center;
    font-size: 24px;
}

.desc {
    font-size: 16px;
    color: #ccc;
    width: 60%;
    margin: auto;
    margin-bottom: 30px;
    text-align: center;
    line-height: 24px;
}

// .banner {
//     margin-top: 80px;
//     height: 250px;
//     background: url('../assets/home/banner_news.png') no-repeat;
//     background-size: 100% 100%;
// }
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
}
</style>