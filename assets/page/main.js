import { createApp } from 'vue'
import JobList from './components/JobList.vue'

const app = createApp()

app.component('job-list', JobList)

app.mount('#app')
