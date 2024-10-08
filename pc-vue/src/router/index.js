import { createRouter, createWebHistory } from 'vue-router';

// 定义路由
const routes = [
    {
        path: '/',
        name: 'HomePage',
        component: () => import('@/pages/HomePage.vue'),
    },
    {
        path: '/company',
        name: 'ComPage',
        component: () => import('@/pages/ComPage.vue'),
    },
    {
        path: '/love',
        name: 'LovePage',
        component: () => import('@/pages/LovePage.vue'),
    },
    {
        path: '/law',
        name: 'LawPage',
        component: () => import('@/pages/LawPage.vue'),
    },
    {
        path: '/adv',
        name: 'AdvPage',
        component: () => import('@/pages/AdvPage.vue'),
    },
    {
        path: '/news',
        name: 'NewsPage',
        component: () => import('@/pages/NewsPage.vue'),
    },
    {
        path: '/detail',
        name: 'DetailPage',
        component: () => import('@/pages/DetailPage.vue'),
    }
];

// 创建 router 实例
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;