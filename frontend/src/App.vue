<script setup>
import Tweet from './components/Tweet.vue'
import { RouterLink,RouterView } from 'vue-router'
import { useTweetStore } from './store/tweet'
import { ref } from 'vue';

const isDarkMode = ref(false);

const toggleDarkMode = () => {
  isDarkMode.value = !isDarkMode.value;
};

import { watch } from 'vue';
watch(isDarkMode, (value) => {
  if (value) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }
});

document.title = "Tweeter";

const tweetStore = useTweetStore()
tweetStore.getTweets()
</script>

<template>
  <div class="body" :class="{ 'dark-mode': isDarkMode }">
    <header :class="{ 'dark-mode': isDarkMode }">
      <h1>Twitter</h1>
      <button @click="toggleDarkMode">{{ isDarkMode ? 'Mode Jour' : 'Mode Nuit' }}</button>
      <nav>
        <RouterLink to="/">Accueil</RouterLink>
        <RouterLink to="/register">Créer un compte</RouterLink>
        <RouterLink to="/login">Se connecter</RouterLink>
      </nav>
    </header>
    <keep-alive include="page1">  
    <router-view></router-view>
</keep-alive>
    <div class="tweet-list" :class="{ 'dark-mode': isDarkMode }">
      <Tweet v-for="tweet in tweetStore.allTweet" :key="tweet.id" :tweet="tweet" />
    </div>
  </div>
</template>


<style scoped>
body,
.body {
  background-color: white;
  width: 100%;
  margin: 0;
  padding: 0;
}

body.dark-mode,
.body.dark-mode {
  background-color: #444444;
}

header,
.tweet-list {
  width: 100%;
  margin: 0 auto;
  padding: 20px;
}

header {
  background-color: #1da1f2;
  color: white;
}

nav {
  display: flex;
  justify-content: space-around;
  margin-top: 10px;
}

nav a {
  color: white;
  text-decoration: none;
}

nav a:hover {
  text-decoration: underline;
}

.tweet-list {
  margin-top: 20px;
}

body.dark-mode {
  background-color: #121212;
  color: #ffffff;
}

header.dark-mode {
  background-color: #333333;
}

.text.dark-mode {
  color: #cccccc;
}

.like.dark-mode button {
  background-color: #1da1f2;
  color: white;
}

.like.dark-mode button:hover {
  background-color: #0b7bc6;
}
</style>
