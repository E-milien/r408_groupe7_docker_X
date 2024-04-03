<script setup>
import { useRouter } from 'vue-router';
import { ref ,onMounted} from 'vue';
import { useUserStore } from '../store/user';
import { useTweetStore } from '../store/tweet';
import { useFollowStore } from '../store/follow';

import Tweet from '../components/Tweet.vue'


const userStore = useUserStore();
const router = useRouter();
const tweetStore = useTweetStore();
const followStore=useFollowStore();

const variableUser = ref(sessionStorage.getItem('iduser'));
var leUser = ref("");
var userTweets = ref([]);
var userFollower=ref([]);

const fetchFollower=async()=>{
  if (variableUser.value !== null) {
    return await tweetStore.getFollowById(variableUser.value);
  }
}

fetchFollower().then(flw=>{
  userFollower.value=flw
})

const fetchUser = async () => {
  if (variableUser.value !== null) {
    return await userStore.getUserById(variableUser.value);
  }
}
const goToAccueil = () => {
  router.push('/');
}

fetchUser().then(usr => {
    leUser.value = usr
});

console.log(variableUser.value)
const fetchUserTweets = async () => {
  return await tweetStore.getTweetsByUserId(variableUser.value)
};


fetchUserTweets().then(usr=>{
  userTweets.value=usr

  console.log(userTweets.value)
});

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  const date = new Date(dateString);
  const formattedDate = date.toLocaleDateString('fr-FR', options);
  return formattedDate;
};


onMounted(() => {
  if (variableUser.value===null ) {
    router.push('/login'); 
    } 
});
</script>

<template>
       <!-- Flèche à gauche -->

    <p><span @click="goToAccueil" class="arrow">&larr;</span>   @{{ leUser.firstname }}      {{ leUser.lastname }} - {{ userTweets.length }} posts</p>

  <section>
    <header>

      <div class="profile-pic">
        <img src="../assets/pp/default.png" alt="">
        <p id="username"><b>{{ leUser.firstname }}   {{ leUser.lastname }}</b></p>
        <p id="arobase-user">@{{ leUser.username }}</p>
        <p id="date">🗓A rejoint Twitter le {{ formatDate(leUser.birthdate) }}</p>
        <p id="nbFollower">{{ userFollower.length }} Abonnements</p>
      </div>
      <p></p>
    </header>

  </section>
  <div class="divider"></div>
  <div v-if="userTweets.length === 0">
            <p>L'utilisateur n'a pas encore posté de tweets.</p>
        </div>

        <Tweet v-else v-for="tweet in userTweets" :key="tweet.id" :tweet="tweet" />

 
</template>

<style scoped>
*{
    color: black;
    
}
.divider{
  margin: 150px 0; /* Ajustez la marge selon vos besoins */


}
.profile_pic{
}
#date{
  right: 0;
}
header{
  height: 10px;
}
img{

  width: 100px;
  height: 100px;
  border-radius: 50%;
  border:solid black  2px;

}
#arobase-user{
  color: grey;
  font-weight: bold;
  margin-top: 7px;
}
.profile-pic #username,b {
  color: white;
  font-size: 30px;
}


.arrow {
font-size: 30px;
  cursor: pointer; 
}
section header{
  padding: 70px;
  background-color: #1da1f2;
}
</style>
