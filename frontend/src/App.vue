<script setup>
import { RouterLink, RouterView } from 'vue-router'
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
var variableUser = ref('')
variableUser = sessionStorage.getItem('iduser');
var connected = ref('')
if (variableUser != null) {
  if (variableUser > 0) {
    connected.value = 'Connecté'
  }
  else connected.value = 'Deconnecté'
}
else connected.value = 'Deconnecté'
document.title = "Twitter";
</script>

<template>
  <aside class="header-aside">
  <div :class="{ 'dark-mode': isDarkMode }">
    <header :class="{ 'dark-mode': isDarkMode }">
      <h1>Twitter</h1>
      <button @click="toggleDarkMode">{{ isDarkMode ? 'Mode Jour' : 'Mode Nuit' }}</button>
      <nav>

        <RouterLink to="/">Accueil</RouterLink>
        <RouterLink to="/register">Créer un compte</RouterLink>
        <RouterLink to="/login">Se connecter</RouterLink>
        <RouterLink to="/account">Mon compte</RouterLink>

      </nav>
      <h1>{{ connected }}</h1>
    </header>
    <RouterView />

  </div>
  </aside>
</template>


<style scoped>
#app {
  background-color: white;
  width: max-content;
  margin: 0;
  padding: 0;
}

body {
  background-color: white;
  width: max-content;
  margin: 0;
  padding: 0;
}

body.dark-mode,
.body.dark-mode {
  background-color: #444444;
}

.header-section {
  display: flex;
  flex-direction: column;
  width: auto;
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
