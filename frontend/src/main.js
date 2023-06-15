import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPersist from 'pinia-plugin-persist'
import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/antd.css'
import App from './App.vue'
import router from './router'

import '@/assets/css/main.css'
const pinia = createPinia()
pinia.use(piniaPersist)
const app = createApp(App)

app.use(router)
.use(Antd)
.use(pinia)
.mount('#app')
