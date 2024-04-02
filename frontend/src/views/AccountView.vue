<script setup>
import { useRouter } from 'vue-router';
import { ref } from 'vue';
import { useUserStore } from '../store/user';

const userStore = useUserStore();
const router = useRouter();
const variableUser = ref(sessionStorage.getItem('iduser'));
var leUser = ref("");

const fetchUser = async () => {
  if (variableUser.value !== null) {
    console.log(variableUser.value)
    return await userStore.getUserById(variableUser.value);
  }
}


fetchUser().then(usr => {
    leUser.value = usr
    console.log(leUser.value)
});

if (variableUser.value === null) {
  router.push('/login'); 
}
</script>

<template>
  <div >

   <p> {{ leUser.username }}</p>
  </div>
 
</template>

<style scoped>
*{
    color: black;
}
</style>
