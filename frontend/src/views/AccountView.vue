<script setup>
import { useRouter } from 'vue-router';
import { ref } from 'vue';

const router = useRouter();
const variableUser = ref(sessionStorage.getItem('iduser'));

if (variableUser.value === null) {
  router.push('/login'); 
}
</script>

<template>
</template>

<style scoped>
</style>
