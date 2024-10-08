import { createApp } from 'vue'
import App from './App.vue'
import router from './router';
import GlobalComponents from './components/index'; // 引入批量注册逻辑

import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'

// import the package
import "vue-awesome-paginate/dist/style.css";
import VueAwesomePaginate from "vue-awesome-paginate";

const app = createApp(App);

// GlobalComponents(app);
app.use(GlobalComponents).use(ElementPlus)

app.use(router).use(VueAwesomePaginate).mount('#app')
