<template>
    <Ui-Header />
    <div class="banner"><img src="@/assets/home/banner_love.png" alt=""></div>
    <!-- <div class="nav">
        <ul class="header_nav pc">
            <li class="add">Từ thiện và từ thiện</li>
            <li>Phân loại 1</li>
            <li>Phân loại 2</li>
            <li>Phân loại 3</li>
        </ul>
    </div> -->
    <div class="com">
        <div class="title">Từ thiện và từ thiện</div>
        <div class="pc com_text"  :style="{'padding':!isSidebarVisible?'10px 20px' : ''}">{{love.desc}}</div>
        <div class="pc content" style="line-height:24px;padding:10px;" v-html="love.content"></div>
        <div class="title">Đội ngũ của chúng tôi</div>
    </div>
    <div class="lun">
        <swiper class="pc" :slidesPerView="isSidebarVisible400 ? 2.1 : 3"  loop :space-between="0" :modules="modules" effect="coverflow"
            :centeredSlides="true" :CreativeEffectTransform="{
            rotate: 0,
            stretch: 70,
            depth: 160,
            modifier: 2,
            shadow: false
        }">
            <swiper-slide v-for="(item, index) in articles" :key="index" class="swiperItem">
                <img :src="item.image" class="hzhb" />
            </swiper-slide>
        </swiper>
    </div>
    <Ui-Footer />
</template>

<script setup>
import { ref ,onMounted,onUnmounted} from 'vue';
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import 'swiper/css/effect-coverflow';
import { fetchArticles,fetchConfigArticlesInfo } from '../api/request.js';
import { Autoplay, Navigation, Pagination, Scrollbar, A11y, EffectCoverflow } from "swiper/modules";
const isSidebarVisible = ref(true)
const isSidebarVisible400 = ref(true)
//获取慈善事业常量文章
const love = ref([]);
const getLove = async () => {
    const res = await fetchConfigArticlesInfo('love');
    love.value = res.data;
};
const articles = ref([]);
const getArticles = async () => {
    const res = await fetchArticles(1, 1, 15);
    console.log(res)
    articles.value = res.data.lists;
};
let modules = [Autoplay, Navigation, Pagination, Scrollbar, A11y, EffectCoverflow];

onMounted(() => {
    getArticles()
    getLove()
    checkSidebarVisibility();
    window.addEventListener('resize', checkSidebarVisibility);
})
onUnmounted(()=>{
    window.removeEventListener('resize', checkSidebarVisibility);
})
const checkSidebarVisibility = () => {
    isSidebarVisible400.value = window.innerWidth > 300  && window.innerWidth < 900;
    isSidebarVisible.value = window.innerWidth > 1200;
}
</script>

<style lang="less" scoped>
.banner {
    margin-top: 80px;
    max-height: 350px;
    /* height: 279px;
    background: url('../assets/home/banner_love.png') no-repeat;
    background-size: cover; */
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

.com {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    .title {
        color: #00639D;
        font-size: 20px;
        margin: 40px auto 30px;
    }

    .com_text {
        padding: 30px 100px 30px;
        color: #000;
        font-size: 12px;
        text-align: center;
        line-height: 26px;
    }
    .content{
        line-height:24px;
        margin:20px 0 100px 0;
    }

    .articles {
        width: 100%;
        max-width: 800px;
        margin: 0 auto;

        .article-item {
            border-bottom: 1px solid #ddd;
            padding: 20px 0;

            h2 {
                font-size: 18px;
                margin-bottom: 10px;
            }

            p {
                font-size: 14px;
                color: #555;
            }
        }
    }

    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;

        button {
            margin: 0 10px;
            padding: 5px 10px;
            cursor: pointer;

            &[disabled] {
                opacity: 0.5;
                cursor: not-allowed;
            }
        }

        span {
            margin: 0 10px;
        }
    }
}

.lun {
    .pc {
        padding: 20px 0;
    }
}

.tu {
    .title {
        color: #00639D;
        font-size: 20px;
        margin: 40px auto 30px;
        text-align: center;
    }

    .tu_list {
        display: grid;
        grid-template-columns: repeat(3, 1fr);

        .box {
            padding: 20px;
            box-sizing: border-box;

            img {
                width: 100%;
                height: 100%;
            }
        }
    }
}
</style>