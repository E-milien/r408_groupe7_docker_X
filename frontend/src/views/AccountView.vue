<script setup>
import { useRouter } from 'vue-router';
import { ref ,onMounted} from 'vue';
import { useUserStore } from '../store/user';
import { useTweetStore } from '../store/tweet';
import Tweet from '../components/Tweet.vue'


const userStore = useUserStore();
const router = useRouter();
const tweetStore = useTweetStore(); // Initialisez le store des tweets

const variableUser = ref(sessionStorage.getItem('iduser'));
var leUser = ref("");
var userTweets = ref([]);

const fetchUser = async () => {
  if (variableUser.value !== null) {
    return await userStore.getUserById(variableUser.value);
  }
}


fetchUser().then(usr => {
    leUser.value = usr
});


const fetchUserTweets = async () => {
  return await tweetStore.getTweetsByUserId(variableUser.value)
};


fetchUserTweets().then(usr=>{
  userTweets.value=usr

  console.log(userTweets.value)
});


onMounted(() => {
  if (variableUser.value===null) {
    router.push('/login'); // Rediriger vers la page de connexion si aucun utilisateur n'est connecté
  } 
});
</script>

<template>
    <p>@{{ leUser.username }} - {{ userTweets.length }} posts</p>

  <section>
    <header>

    </header>
  </section>
    <Tweet v-for="tweet in userTweets" :key="tweet.id" :tweet="tweet" />

 
</template>

<style scoped>
*{
    color: black;
    
}

section header{
  padding: 100px;
  background-color: #1da1f2;
}
</style>
