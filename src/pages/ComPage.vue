<template>
    <Ui-Header />
    <div class="banner">
        <img src="@/assets/com/banner.png" alt="">
    </div>
    <!-- <div class="nav">
        <ul class="header_nav pc">
            <li class="add">Hồ sơ công ty</li>
            <li>văn hóa doanh nghiệp</li>
        </ul>
    </div> -->
    <div class="com">
        <div class="title">Hồ sơ công ty</div>
        <div class="pc com_text" style="width: 80%;margin-bottom: 2%;">{{ about.desc }}</div>
        <div class="pc" style="line-height:24px;padding:10px;" v-html="about.content"></div>
        <div class="title">Môi trường văn phòng của chúng tôi</div>
    </div>
    <div class="lun">
        <swiper class="pc" :slidesPerView="isSidebarVisible400 ? 2.5 : 3"  loop :space-between="0" :modules="modules" effect="coverflow"
            :centeredSlides="true" :CreativeEffectTransform="{
            rotate: 0,
            stretch: 70,
            depth: 160,
            modifier: 2,
            shadow: false
        }">
            <swiper-slide v-for="(item, index) in office" :key="index" class="swiperItem">
                <img :src="item.image" class="hzhb" @click="showModalImgOffice(index)"/>
            </swiper-slide>
        </swiper>
    </div>
    <ImageGallery :images="office" :show="isModalVisibleOffice" :initialIndex="initialIndexOffice"
        @update:show="isModalVisibleOffice = $event"/>
    <div class="tu">
        <div class="title">Đội ngũ của chúng tôi</div>
        <div class="tu_list pc" :style="{'grid-template-columns' : isSidebarVisible400 ? 'repeat(1, 1fr)' : 'repeat(3, 1fr)'}">
            <div class="box" v-for="(item, index) in team" :key="index" >
                <img :src="item.image" @click="showModalImg(index)">
            </div>
        </div>
    </div>
    <ImageGallery :images="team" :show="isModalVisible" :initialIndex="initialIndex"
        @update:show="isModalVisible = $event"/>
    <Ui-Footer />
</template>

<script setup>
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import 'swiper/css/effect-coverflow';  //effect为fade时必须引入，否则可能出现只切换一次就不自动切换的情况

import { ref,onMounted,onUnmounted } from 'vue';
import { fetchBanner, fetchConfigArticlesInfo } from '../api/request.js';
import ImageGallery from '../components/ImageGallery.vue';

const isModalVisible = ref(false);
const initialIndex = ref(0);
const showModalImg = (index) => {
    console.log(index)
    initialIndex.value = index;
    isModalVisible.value = true;
};

const isModalVisibleOffice = ref(false);
const initialIndexOffice = ref(0);
const showModalImgOffice = (index) => {
    console.log(index)
    initialIndexOffice.value = index;
    isModalVisibleOffice.value = true;
};

//获取公司简介
const about = ref([]);
const getAbout = async () => {
    const res = await fetchConfigArticlesInfo('about');
    about.value = res.data;
};
const isSidebarVisible400 = ref(true)
//公司环境
const office = ref([]);
const getOffice = async () => {
    const res = await fetchBanner('office');
    office.value = res.data
}
//公司团队
const team = ref([]);
const getTeam = async () => {
    const res = await fetchBanner('team');
    team.value = res.data;
}
onMounted(() => {
    getAbout()
    getOffice()
    getTeam()
    checkSidebarVisibility();
    window.addEventListener('resize', checkSidebarVisibility);
})
onUnmounted(()=>{
    window.removeEventListener('resize', checkSidebarVisibility);
})
const checkSidebarVisibility = () => {
    isSidebarVisible400.value = window.innerWidth > 300  && window.innerWidth < 900;
}
import { Autoplay, Navigation, Pagination, Scrollbar, A11y, EffectCoverflow } from "swiper/modules";

let modules = [Autoplay, Navigation, Pagination, Scrollbar, A11y, EffectCoverflow];
</script>

<style lang="less" scoped>
.hzhb{cursor: pointer;}
.banner {
    margin-top: 80px;
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
        // padding: 30px 100px 30px;
            max-width: 994px;
        color: #000;
        font-size: 12px;
        text-align: center;
        line-height: 26px;
    }
}

.lun {
    background: #EDF3F7;

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
            cursor: pointer;
            padding: 20px;
            box-sizing: border-box;

            // width: 208px;
            // height: 141px;
            // margin-bottom: 20px;
            img {
                width: 100%;
                height: 100%;
            }
        }
    }
}
</style>