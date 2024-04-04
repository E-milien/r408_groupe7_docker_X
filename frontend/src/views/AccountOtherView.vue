<script setup>
import { useRouter } from 'vue-router';
import { ref, onMounted } from 'vue';
import { useUserStore } from '../store/user';
import { useTweetStore } from '../store/tweet';
import { useRtStore } from '../store/retweet';
import { useFollowStore } from '../store/follow';

import Tweet from '../components/Tweet.vue'
import Retweet from '../components/Retweet.vue'

const getCurrentUserId = () => {
  return sessionStorage.getItem('iduser');
};

const userStore = useUserStore();
const router = useRouter();
const tweetStore = useTweetStore();
const retweetStore = useRtStore();
const followStore = useFollowStore();
var variableUser = ref('')
var textFollow = ref("pas assigné");

variableUser.value = sessionStorage.getItem('idForAccount')

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

const fetchFollow = async () => {
  const currentId = getCurrentUserId();
  if (currentId !== "") {
    if (currentId > 0) {
      return await followStore.followed(currentId, theTweet.user_id)
    }
    else
      return false;
  }
};

fetchFollow().then(follow => {
  if (follow) {
    textFollow.value = 'followed'
  }
  else
    textFollow.value = 'follow'
});

fetchUserRetweets().then(rt => {
  userRetweets.value = rt
});

const toggleFollow = () => {
  const currentId = getCurrentUserId();
  if (currentId !== "") {
    if (currentId > 0) {
      if (textFollow.value == 'follow') {
        followStore.addFollow({ 'follower_id': currentId, 'followed_id': theTweet.user_id });
        textFollow.value = 'followed';
      } else {
        followStore.removeFollow({ 'follower_id': currentId, 'followed_id': theTweet.user_id });
        textFollow.value = 'follow';
      }
      document.querySelector('.follow-button').classList.toggle('clicked');

    }
    else {
      router.push('/login')
    }
  }
  else {
    router.push('/login')
  }
};

const formatDate = (dateString) => {
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  const date = new Date(dateString);
  const formattedDate = date.toLocaleDateString('fr-FR', options);
  return formattedDate;
};
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
        <p v-if="leUser.bio"> {{ leUser.bio }}</p>
        <p id="date">🗓A rejoint Twitter le {{ formatDate(leUser.birthdate) }}</p>
        <div id="stats">
          <p id="nbFollower">{{ userFollowers.length }} Abonné(s)</p>
          <p id="nbFollower">{{ userFollowing.length }} Abonnement(s)</p>
        </div>
        <button v-if="parseInt(leUser.id) !== parseInt(getCurrentUserId())" class="follow-button"
          @click="toggleFollow">{{ textFollow }}</button>
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

.follow-button {
  background-color: transparent;
  border: 1px solid #1da1f2;
  color: #1da1f2;
  border-radius: 9999px;
  padding: 8px 16px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
  margin-left: auto;
}

.follow-button {
  margin-left: 7px;
}
</style>
