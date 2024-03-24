<template>
    <div>
        <a href="https://vuejs.org/" target="_blank">
            <img :src="logoVue" style="width: 100px" alt="Vue logo" />
        </a>
    </div>
    <h1>{{ message }}</h1>
</template>

<script setup>
import { ref } from 'vue';
import logoVue from '~/images/logo-vue.svg';

const message = ref('Hello Vue!');
</script>
