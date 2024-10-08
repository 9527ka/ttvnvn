<template>
    <header class="header">
        <nav class="pc flex">
            <div class="header_logo" @click="goHome">
                <a href="/"><img src="@/assets/logo.png" alt="Logo" class="logo-img" :style="{'width':isSidebarVisible400?'50%' : '124px','height':isSidebarVisible400?'50%' : '63px'}"/></a>
            </div>
            <ul class="header_nav"  v-if="isSidebarVisible">
                <li v-for="el in Rout" :key="el.id" @click="goToAbout(el)" :class="{ 'add': pages === el.id }">{{ el.name }}</li>
            </ul>
            <div v-else class="small-menu" @click="isShowMenu = !isShowMenu">
                <img src="@/assets/com/tree.png" alt="" class="menu-icon">
            </div>
            <div class="menu-nav" v-if="isShowMenu">
                <div class="menu-item" v-for="el in Rout" :key="el.id" @click="goToAbout(el)" :class="pages == el.id ? 'add' : '' ">
                    {{ el.name }}
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup>
import { ref, onMounted, watch,onUnmounted} from 'vue';
import { useRouter, useRoute } from 'vue-router';
const pages = ref('home');
const router = useRouter();
const route = useRoute();
const Rout = ref([
    {
        id: 'home',
        key: '/',
        name: 'Trang chủ',
    },
    {
        id: 'company',
        key: '/company',
        name: 'Hồ sơ công ty',
    },
    {
        id: 'love',
        key: '/love',
        name: 'Tâm huyết với công ích',
    },
    {
        id: 'law',
        key: '/law',
        name: 'Trợ giúp pháp lý',
    },
    {
        id: 'adv',
        key: '/adv',
        name: 'Tuyển dụng nội bộ',
    },
    {
        id: 'news',
        key: '/news',
        name: 'Tin tức',
    }
])
const goToAbout = (v) => {
    pages.value = v.id;
    router.push(v.key);
}
const isShowMenu = ref(false)
const isSidebarVisible = ref(true)
const isSidebarVisible400 = ref(true)
onMounted(() => {
    const currentPath = route.path;
    for (let item of Rout.value) {
        if (item.key === currentPath) {
            pages.value = item.id;
            break;
        }else if (currentPath == '/detail' && item.key === '/news') {
            pages.value = item.id;
            break;
        }
    }
    checkSidebarVisibility();
    window.addEventListener('resize', checkSidebarVisibility);
});
onUnmounted(()=>{
    window.removeEventListener('resize', checkSidebarVisibility);
})
const checkSidebarVisibility = () => {
    console.log(window.innerWidth)
    isSidebarVisible400.value = window.innerWidth  < 401;
    isSidebarVisible.value = window.innerWidth > 1200;
    if(window.innerWidth > 1200) {
        isShowMenu.value = false
    }
}
// 监听路由变化
watch(route, (to) => {
    const currentPath = to.path;
    for (let item of Rout.value) {
        if (item.key === currentPath) {
            pages.value = item.id;
            break;
        }
    }
}, { immediate: true });
const goHome = () => {
    router.push('/');
};
</script>
<style lang="less" scoped>
.header_nav li:not(:last-child)::after {
    content: '|';
    margin: 0 10px;
}

.header_nav li.add::after {
    display: block;
}
.header{
    position: fixed;
    top: 0;
    width: 100%;
    height: 80px;
    // background: rgba(0,0,0,0.12);
    background: #fff;
    box-shadow: 0px 1px 0px 0px rgba(255,255,255,0.15);
    color: #000;
    z-index: 999;
    .pc{
        display: flex;
        align-items: center;
        height: 100%;
        justify-content: space-between;
    }
    .header_logo{
        cursor: pointer;
        .logo-img{
            width: 50%;
            height: 50%;
            width:124px;
            height:63px;
        }
        margin-right: 182px;
    }
    .header_nav{
        font-size: 12px;
        display: flex;
        align-items: center;
        flex: 1;
        height: 100%;
        justify-content: right;
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
        img{
            width: 20px;
            height: 21px;
            margin-left: 16px;
            cursor: pointer;
        }
    }
    .small-menu{
        padding:10px;
        border:1px solid #dedede;
        /* width: 100px; */
        margin-right: 10px;
        .menu-icon{
            width:30px;
            height: 30px;
            cursor: pointer;
        }
    }
    .menu-nav{
        width:257px;
        height: calc(100% - 80px);
        background: #fff;
        position: fixed;
        right:0;
        top:80px;
        border-top:1px solid #e3e3e3;
        .menu-item{
            padding-left:10px;
            height:40px;
            line-height:40px;
            border-bottom:1px solid #e3e3e3;
            font-weight: bold;
            font-size:12px;
            cursor: pointer;
        }
        .add{
            border-bottom:1px solid #1e90ff;
            color: #1e90ff;
        }
    }
}
</style>