import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'

const Pinia = createPinia()

const app = createApp(App).use(Pinia)

app.use(router)

app.mount('#app')
