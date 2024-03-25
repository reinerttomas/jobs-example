<script setup>
import { useDateFormat } from '@vueuse/core'

defineProps({
    job: {
        id: String,
        title: String,
        accessState: Number,
        dateCreated: String,
        publicLink: String,
        editLink: String,
    },
})
</script>

<template>
    <tr>
        <td></td>
        <td>{{ job.title }}</td>
        <td>
            <span class="badge">{{ job.accessState }}</span>
        </td>
        <td>
            {{ useDateFormat(job.dateCreated, 'D.M.YYYY HH:mm').value }}
        </td>
        <td>
            <a :href="job.publicLink">Public</a>
            <a :href="job.editLink">Edit</a>
        </td>
    </tr>
</template>
