/* eslint-disable import/order */
import '@/@iconify/icons-bundle'
import App from '@/App.vue'
import vuetify from '@/plugins/vuetify'
import { loadFonts } from '@/plugins/webfontloader'
import router from '@/router'
import '@core/scss/template/index.scss'
import '@layouts/styles/index.scss'
import '@styles/styles.scss'
import { createPinia } from 'pinia'
import { createApp } from 'vue'



/* sweetalert */
import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.min.css'


/* axios */
import axios from 'axios'
import VueAxios from 'vue-axios'
axios.defaults.baseURL = 'http://localhost:8080/'



/* Toast */
import ToastPlugin from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-default.css'


import { createI18n } from 'vue-i18n'

loadFonts()


const i18n = createI18n({
    // something vue-i18n options here ...
})

// Create vue app
const app = createApp(App)


// Use plugins
app.use(vuetify)
app.use(createPinia())
app.use(router)
app.use(VueAxios, axios)
app.use(VueSweetalert2)
app.use(ToastPlugin)
app.use(i18n)

// Mount vue app
app.mount('#app')
