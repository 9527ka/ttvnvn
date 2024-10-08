<template>
    <Ui-Header />
    <div class="banner">
        <img src="@/assets/home/banner_law.png" alt="">
    </div>
    <!-- <div class="nav">
        <ul class="header_nav pc">
            <li class="add">trợ giúp pháp lý</li>
            <li>Phân loại 1</li>
            <li>Phân loại 2</li>
        </ul>
    </div> -->
    <div class="com">
        <div class="title">trợ giúp pháp lý</div>
        <div class="pc com_text" :style="{'padding':!isSidebarVisible?'10px 20px' : ''}">{{law.desc}}</div>
        <div class="pc content" style="line-height:24px;padding:10px;" v-html="law.content"></div>
        <div class="title">Đội ngũ của chúng tôi</div>
    </div>
    <div class="lun">
        <swiper 
            class="pc"
            :slidesPerView="isSidebarVisible400 ? 2.1 : 3" 
            loop
            :space-between="0" 
            :modules="modules" 
            effect="coverflow"
            :centeredSlides = "true"
            :CreativeEffectTransform="{
                rotate: 0,
                stretch: 70, 
                depth: 160, 
                modifier: 2, 
                shadow: false
            }"
        >
            <swiper-slide v-for="(item, index) in arrList" :key="index" class="swiperItem">
                <img :src="item.img" class="hzhb"/>
            </swiper-slide>
        </swiper>
    </div>
    <Ui-Footer />
</template>

<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import 'swiper/css/effect-coverflow';  //effect为fade时必须引入，否则可能出现只切换一次就不自动切换的情况
import { Autoplay, Navigation, Pagination, Scrollbar, A11y ,EffectCoverflow} from "swiper/modules";
let modules = [Autoplay, Navigation, Pagination, Scrollbar, A11y,EffectCoverflow];
import { ref ,onMounted,onUnmounted} from 'vue';
import { fetchConfigArticlesInfo } from '../api/request.js';
const isSidebarVisible = ref(true)
const isSidebarVisible400 = ref(true)
//获取法律援助常量文章
const law = ref([]);
const getLaw = async () => {
    const res = await fetchConfigArticlesInfo('law');
    law.value = res.data;
};

const arrList = ref([
    {
        img:require('@/assets/home/banner.png'),
    },{
        img:require('@/assets/home/banner.png'),
    },{
        img:require('@/assets/home/banner.png'),
    },{
        img:require('@/assets/home/banner.png'),
    },{
        img:require('@/assets/home/banner.png'),
    },{
        img:require('@/assets/home/banner.png'),
    },
])
onMounted(() => {
    getLaw()
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
.banner{
    margin-top: 80px;
    max-height: 350px;
    /* background: url('../assets/home/banner_law.png') no-repeat;
    background-size: cover; */
    img{
        height:100%;
        max-height: 350px;
        width:100%;
    }
} 
.nav{
    height: 42px;
    color: #373737;
    background: #F2F7FA;
    .header_nav{
        font-size: 12px;
        display: flex;
        align-items: center;
        height: 100%;
        li{
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
.com{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    .title{
        color: #00639D;
        font-size: 20px;    
        margin: 40px auto 30px;
    }
    .com_text{
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
}
.lun{
    // background: #EDF3F7;
    .pc{
        padding: 20px 0;
    }
}
.tu{
    .title{
        color: #00639D;
        font-size: 20px;    
        margin: 40px auto 30px;
        text-align: center;
    }
    .tu_list{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        .box{
            padding: 20px;
            box-sizing: border-box;
            // width: 208px;
            // height: 141px;
            // margin-bottom: 20px;
            img{
                width: 100%;
                height: 100%;
            }
        }
    }
}
</style>