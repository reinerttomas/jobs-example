<script setup>
import { onMounted, reactive, ref } from 'vue'
import axios from 'axios'
import JobItem from './JobItem.vue'
import ThePaginator from './ThePaginator.vue'

const loading = ref(true)
const jobs = ref([])
const paging = reactive({})

const getJobs = async () => {
    loading.value = true

    try {
        const response = await axios.get('/api/jobs')
        jobs.value = response.data.data
        paging.value = response.data.paging
    } catch (error) {
        console.error(error)
        if (error.response.status === 422) {
        }
    } finally {
        loading.value = false
    }
}

onMounted(async () => {
    await getJobs()
})
</script>

<template>
    <div v-if="loading">Loading ...</div>
    <div v-else class="card">
        <div class="card-header">Jobs ({{ paging.value.total }})</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">AccessState</th>
                        <th scope="col">DateCreated</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <job-item v-for="job in jobs" :key="job.id" :job="job" />
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <the-paginator :paging="paging.value" />
        </div>
    </div>
</template>
