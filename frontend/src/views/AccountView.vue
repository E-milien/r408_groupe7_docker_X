<script setup>
import { useRouter } from 'vue-router';
import { ref, onMounted } from 'vue';
import { useUserStore } from '../store/user';
import { useTweetStore } from '../store/tweet';
import { useRtStore } from '../store/retweet';
import { useFollowStore } from '../store/follow';

import Tweet from '../components/Tweet.vue'
import Retweet from '../components/Retweet.vue'


const userStore = useUserStore();
const router = useRouter();
const tweetStore = useTweetStore();
const retweetStore = useRtStore();
const followStore = useFollowStore();

const variableUser = ref(sessionStorage.getItem('iduser'));
var leUser = ref("");
var userTweets = ref([]);
var userRetweets = ref([]);
var userFollowers = ref([]);
var userFollowing = ref([]);

const fetchFollowers = async () => {
  if (variableUser.value !== null) {
    return await followStore.getFollowById(variableUser.value);
  }
}

fetchFollowers().then(flw => {
  userFollowers.value = flw
})

const fetchFollowing = async () => {
  if (variableUser.value !== null) {
    return await followStore.getFollowingById(variableUser.value);
  }
}

fetchFollowing().then(flw => {
  userFollowing.value = flw
})

const fetchUser = async () => {
  if (variableUser.value !== null) {
    console.log(variableUser.value)
    console.log(sessionStorage.getItem('iduser'))
    return await userStore.getUserById(variableUser.value);
  }
}
const goToAccueil = () => {
  router.push('/');
}

fetchUser().then(usr => {
  leUser.value = usr
});

const fetchUserTweets = async () => {
  return await tweetStore.getTweetsByUserId(variableUser.value)
};


fetchUserTweets().then(usr => {
  userTweets.value = usr
});

const fetchUserRetweets = async () => {
  return await retweetStore.getRtByIdUser(variableUser.value)
};


fetchUserRetweets().then(rt => {
  userRetweets.value = rt
});

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  const date = new Date(dateString);
  const formattedDate = date.toLocaleDateString('fr-FR', options);
  return formattedDate;
};


onMounted(() => {
  if (variableUser.value === null) {
    router.push('/login');
  }
});
</script>

<template>
  <!-- Flèche à gauche -->

  <p><span @click="goToAccueil" class="arrow">&larr;</span> {{ leUser.firstname }} {{ leUser.lastname }} - {{
    userTweets.length }} posts</p>

  <section>
    <header>

      <div class="profile-pic">

        <img v-if="leUser && leUser.profile_pic" id="profile_pic" :src="leUser.profile_pic" alt="profile_picture">
        <img v-else id="profile_pic" src="../assets/pp/default.png" alt="profile_picture">
        <p id="username">{{ leUser.firstname }} {{ leUser.lastname }}</p>
        <p id="arobase-user">@{{ leUser.username }}</p>
        <p id="date">🗓 A rejoint Twitter le {{ formatDate(leUser.birthdate) }}</p>
        <div id="stats">
          <p id="nbFollower">{{ userFollowers.length }} Abonné(s)</p>
          <p id="nbFollower">{{ userFollowing.length }} Abonnement(s)</p>
        </div>
      </div>
      <p></p>
    </header>

  </section>
  <div class="divider"></div>
  <div v-if="userTweets.length === 0 && userRetweets.length === 0">
    <p>L'utilisateur n'a pas encore posté de tweets ni de retweets.</p>
  </div>
  <div v-else>
    <div v-for="retweet in userRetweets">
      <Retweet :key="retweet.user_id" :retweet="retweet" />
    </div>
    <div v-for="tweet in userTweets">
      <Tweet :key="tweet.id" :tweet="tweet" />
    </div>
  </div>
</template>

<style scoped>
* {
  color: black;

}

.divider {
  margin: 150px 0;


}

.profile_pic {}

#date {
  right: 0;
}

header {
  height: 10px;
}

img {

  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: solid black 2px;

}

#arobase-user {
  color: grey;
  font-weight: bold;
  margin-top: 7px;
}

.profile-pic #username,
b {
  font-size: 30px;
}

#username {
  color: black;
}

.arrow {
  font-size: 30px;
  cursor: pointer;
}

section header {
  padding: 70px;
  background-color: #1da1f2;
}

p span {
  color: black;
}

#stats {
  display: flex;
}

#stats p {
  margin-right: 10px;
}
</style>
