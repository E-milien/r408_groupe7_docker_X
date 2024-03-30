<script setup>
import Tweet from './components/Tweet.vue'
import { RouterLink } from 'vue-router'
import { useTweetStore } from './store/tweet'
import { ref } from 'vue';

// Variable d'état pour le mode nuit
const isDarkMode = ref(false);

// Fonction pour basculer le mode nuit
const toggleDarkMode = () => {
  isDarkMode.value = !isDarkMode.value;
};

// Appliquer la classe CSS dynamiquement au body
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
  <div id="body">
    <header :class="{ 'dark-mode': isDarkMode }">
      <h1>Twitter</h1>
      <button @click="toggleDarkMode">{{ isDarkMode ? 'Mode Jour' : 'Mode Nuit' }}</button>
      <nav>
        <RouterLink to="/">Accueil</RouterLink>
        <RouterLink to="/register">Créer un compte</RouterLink>
        <RouterLink to="/login">Se connecter</RouterLink>
      </nav>
    </header>



    <div v-if="tweetStore.allTweet.length" class="tweet-list" :class="{ 'dark-mode': isDarkMode }">
      <Tweet v-for="tweet in tweetStore.allTweet" :key="tweet.id" :tweet="tweet" />
    </div>
    <div v-else>
      <p>Aucun tweet trouvé.</p>
    </div>
  </div>
</template>

<style scoped>
#body {
  background-color: white;
}

header {
  background-color: #1da1f2;
  padding: 20px;
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

/* Styles pour la zone des tweets */
.tweet-list {
  margin-top: 20px;
}

/* Styles pour le mode nuit */
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

.addToCart.dark-mode button {
  background-color: #1da1f2;
  color: white;
}

.addToCart.dark-mode button:hover {
  background-color: #0b7bc6;
}
</style>
