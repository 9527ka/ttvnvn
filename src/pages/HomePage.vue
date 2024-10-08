<template>
    <Ui-Header />
    <div class="banner">
        <el-carousel trigger="click" class="swiper" :height= "isSidebarVisible ? '608px' : isSidebarVisible700 ? '508px' : ''">
            <el-carousel-item v-for="item in slides" :key="item" class="swiper-item">
                <img class="slide-image" :src="item.image" alt="">
                <div class="slide-text pc">
                    <div class="title" :style="{'font-size':isSidebarVisible ? '26px' : '20px'}">{{ item.title }}</div>
                    <div class="text"  :style="{'padding-left':isSidebarVisible ? '' : '14px'}">{{ item.desc }}</div>
                    <a class="btn" :style="{
                        'margin-left':isSidebarVisible ? '' : '14px',
                        'width':isSidebarVisible ? '' : '120px',
                        'height':isSidebarVisible ? '' : '34px',
                        'line-height':isSidebarVisible ? '' : '34px',
                        'font-size':isSidebarVisible ? '' : '13px',
                    }" target="_blank" v-if="item.btn_link" :href="item.btn_link">Tìm hiểu thêm</a>
                </div>
            </el-carousel-item>
        </el-carousel>
    </div>
    <div class="brief">
        <div class="title">Hồ sơ công ty</div>
        <div class="pc brief_text" :style="{'padding': isSidebarVisible ? '0 280px' : '0 20px'}">{{about.desc}}</div>
        <a class="brief_btn" href="/company">
            tìm hiểu thêm
        </a>
    </div>
    <div class="banner_ce">
        <div class="pc" :style="{'font-size':isSidebarVisible ? '' : '16px','padding': isSidebarVisible ? '' : '0 20px','line-height':isSidebarVisible ? '' : '24px',}">Chúng tôi phục vụ mọi khách hàng bằng cả trái tim</div>
    </div>
    <div class="serve">
        <div class="title">Dịch vụ của chúng tôi</div>
        <div class="serve_text">Đội ngũ chuyên nghiệp làm mọi thứ một cách cẩn thận</div>
        <div class="serve_swiper">
            <swiper :slidesPerView="isSidebarVisible400 ? 3 : 4"  loop :space-between="0" :modules="modules" effect="coverflow"
                :centeredSlides="true" :CreativeEffectTransform="{
                rotate: 0,
                stretch: 70,
                depth: 160,
                modifier: 2,
                shadow: false
            }">
                <swiper-slide v-for="(item, index) in laws" :key="index" class="swiperItem">
                    <img :src="item.image" class="hzhb" />
                    <div class="hzhb_text">
                        <div class="p1">{{item.title}}</div>
                        <div class="p2">{{item.desc}}</div>
                        <a class="btn" href="{{item.id}}">Xem chi tiết</a>
                    </div>
                </swiper-slide>
            </swiper>
        </div>
    </div>
    <div class="news">
        <div class="title">Tin tức</div>
        <div class="news_text">Thông cáo báo chí mới nhất, tài sản truyền thông và liên hệ tru</div>
        <div class="news_list pc"  :style="{'grid-template-columns' : isSidebarVisible ? 'repeat(4, 1fr)' : isSidebarVisible900 ? 'repeat(3, 1fr)' : 'repeat(1, 1fr)'}">
            <div class="news_list_box" v-for="el in news" :key="el">
                       <a :href="'/detail?id=' + el.id">
              
                <img :src="el.image" alt="">
                <div>{{el.create_time}} </div>
                <span>{{el.desc}}</span>
            </a>

            </div>
        </div>
        <a href="/news" class="btn">Tìm hiểu thêm</a>
    </div>
    <Ui-Footer />
</template>

<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import 'swiper/css/effect-coverflow';  //effect为fade时必须引入，否则可能出现只切换一次就不自动切换的情况

import { Autoplay, Navigation, Pagination, Scrollbar, A11y, EffectCoverflow } from "swiper/modules";
import { ref, onMounted,onUnmounted } from 'vue';
import { fetchBanner,fetchArticles,fetchConfigArticlesInfo } from '../api/request.js';
const isSidebarVisible = ref(true)
const isSidebarVisible700 = ref(true)
const isSidebarVisible400 = ref(true)
const isSidebarVisible900 = ref(true)
//轮播图
const slides = ref([]);
const getBanner = async () => {
    try {
        const res = await fetchBanner('banner');
        console.log(res)
        slides.value = res.data;
    } catch (error) {
        console.error('Error fetching articles:', error);
    }
};
//新闻资讯
const news = ref([]);
const getNews = async () => {
    const res = await fetchArticles(1, 1, 4);
    news.value = res.data.lists;
};
//法律援助
const laws = ref([]);
const getLaws = async () => {
    const res = await fetchArticles(4, 1, 10);
    laws.value = res.data.lists;
};
//获取公司简介
const about = ref([]);
const getAbout = async () => {
    const res = await fetchConfigArticlesInfo('about');
    about.value = res.data;
};

let modules = [Autoplay, Navigation, Pagination, Scrollbar, A11y, EffectCoverflow];

onMounted(() => {
    getAbout()
    getBanner()
    getNews()
    getLaws()
    checkSidebarVisibility();
    window.addEventListener('resize', checkSidebarVisibility);
})
onUnmounted(()=>{
    window.removeEventListener('resize', checkSidebarVisibility);
})
const checkSidebarVisibility = () => {
    isSidebarVisible.value = window.innerWidth > 1200;
    isSidebarVisible700.value = window.innerWidth > 700;
    isSidebarVisible400.value = window.innerWidth > 300  && window.innerWidth < 900;
    isSidebarVisible900.value = window.innerWidth > 900 && window.innerWidth < 1200;
}
</script>

<style lang="less" scoped>
.banner {
    margin-top: 80px;
    /* height: 608px; */
    .swiper{
        width: 100%;
        /* height: 608px; */
        position: relative;
    }
    .slide-image{
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }
    /deep/ .el-carousel__indicators--horizontal{
        bottom: 10px;
    }
    /deep/ .el-carousel__arrow{
        // display: block !important;
        background: transparent !important;
        border: 1px solid #fff;
    }
    /deep/ .el-carousel__arrow--right{
        right: 50px;
    }
    /deep/ .el-carousel__arrow--left{
        left: 50px;
    }
    /deep/ .el-carousel__button{
        background: #fff;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        margin: 0 10px;
        opacity: 1;
        position: relative;
    }
    /deep/ .el-carousel__indicator.is-active button::after{
        border: 1px solid #fff;
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border: 1px solid #fff;
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .swiper-item{
        display: flex;
        align-items: center;
    }
    .slide-text{
        position: sticky;
        color: #333;
        .title{
            max-width: 450px;
            font-size: 26px;
            font-weight: 600;
        }
        .text{
            max-width: 450px;
            font-weight: 400;
            padding: 16px 0;
            line-height: 26px;
        }
        .btn{
            background: #00A0E9;
            border-radius: 14px;
            width: 159px;
            height: 40px;
            text-align: center;
            line-height: 40px;
            color: #fff;
            cursor: pointer;
            display: block;
        }
    }
}
.brief{
    // height: 354px;
    background: url('../assets/home/brief.png') no-repeat;
    background-position: bottom;
    .brief_title{
        // background: #00639D;
        color: #00639D;
        font-size: 20px;
        text-align: center;
        margin: 52px 0 30px;
    }
    .brief_text{
        padding: 0 280px;
        line-height: 26px;
        font-size: 12px;
        text-align: center;
        box-sizing: border-box;
        color: #000;
    }
    .brief_btn{
        cursor: pointer;
        margin: 35px auto 60px;
        background: #0167B5;
        color: #fff;
        text-align: center;
        height: 40px;
        width: 149px;
        line-height: 40px;
        display: block;
        border-radius: 14px;
    }
}
.banner_ce{
    height: 300px;
    background: url('../assets/home/banner_ce.png') no-repeat;
    background-size: cover;
    div{
        height: 100%;
        font-size: 20px;
        display: flex;
        align-items: center;
    }
}
.title{
    color: #00639D;
    font-size: 20px;
    text-align: center;
    margin: 52px 0 30px;
}
.serve{
    // height: 697px;
    .serve_text{
        text-align: center;
        color: #000;
        font-size: 12px;
        font-weight: 400;
    }
    .serve_swiper{
        width: 100%;
        // max-width: 1200px;   
        margin: 40px auto 20px;
        /deep/ .swiper-3d .swiper-slide-shadow-right{
            opacity: 0 !important;
        }
        /deep/ .swiper-3d .swiper-slide-shadow-left{
            opacity: 0 !important;
        }
    }
    .swiperItem{
        // width: 200px;
        // height: 192px;
        // background: #E9F2F9;
        .hzhb{
            width: 200px;
            max-height: 192px;
            margin: auto;
            border-radius: 12px;
            
        }
        .hzhb_text{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-content: center;
            color: #000;
            max-width: 200px;
            text-align: center;
            margin: auto;
            background: #E9F2F9;
            border-radius: 0 0 12px 12px;
            .p1{
                margin-top: 25px;
            }
            .p2{
                margin: 15px 0 65px;
            }
            .btn{
                width: 90%;
                height: 29px;
                background: #fff;
                color: #00A0E9;
                text-align: center;
                line-height: 29px;
                margin: 0 auto 30px;
                border-radius: 8px;
                font-size: 12px;
            }
        }

    }
    
}
.news{
    .news_text{
        color: #000;
        font-size: 12px;
        text-align: center;
    }
    .news_list{
        color: #000;
        margin: 50px auto;
        font-size: 14px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        .news_list_box{
            width: 97%;
            margin-left: 10px;
            line-height: 21px;
            img{
                width: 98%;
                max-height: 159px;
                height: 100%;
                object-fit: cover; 
            }
            div{
                margin: 10px 0;
                color: #7E7E7E;
            }
        }
    }
    .btn{
        background: #00A0E9;
        border-radius: 14px;
        width: 159px;
        height: 40px;
        text-align: center;
        line-height: 40px;
        color: #fff;
        cursor: pointer;
        margin: 0 auto 150px;
        display: block;
    }
}
</style>