<script setup>
defineProps({
    paging: {
        page: Number,
        from: Number,
        to: Number,
        total: Number,
    },
})
</script>

<template>
    <div class="d-flex justify-content-between">
        <div>Page {{ paging.page }} of {{ paging.to }}</div>
    </div>
</template>
