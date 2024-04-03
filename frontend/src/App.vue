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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <div class="container">
    <div class="content-wrapper">

    <header class="header">
      <h1>Twitter</h1>
      <!-- <button @click="toggleDarkMode">{{ isDarkMode ? 'Mode Jour' : 'Mode Nuit' }}</button> -->
      <nav>
        <img src="./assets/twtter.png" alt="twitter logo">

        <p><RouterLink to="/" class="nav-link"><i class="fas fa-home"></i>Home</RouterLink></p>
        <p><RouterLink to="/register" class="nav-link"> Créer un compte</RouterLink></p>
        <p><RouterLink to="/login" class="nav-link" > <i class="fas fa-sign-in-alt"></i>Se connecter</RouterLink></p>
        <p><RouterLink to="/account" class="nav-link"> <i class="fas fa-user"></i>Mon compte</RouterLink></p>
      </nav>
      <h1>{{ connected }}</h1>
    </header>
    <main class="main-content">
      <RouterView />
    </main>
  </div>

  </div>
</template>

<style scoped>
img{
 width: 70px;
 height: 70px;
}
.container {
  display: flex;
  height: 100vh;
}
.content-wrapper {
  display: flex;
  flex: 1; 
  justify-content: space-between; /* Ajustement pour aligner les éléments à gauche et à droite */

}
i{
  color: black;
  margin-right: 10px;
}

nav {
  margin-top: 70px;
  display: flex;
  flex-direction: column;
  position: fixed;
  
}
nav a {
  text-decoration: none;
}
nav p {
  margin-top: 70px;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-weight: 400;
  font-size: 30px;
  text-decoration: none;
}
.nav-link {
  color: black;
}
.nav-link:hover {
  color: #1da1f2;
  font-size: 30px;
  font-weight: bold;
}
.nav-link:hover i {
  color: #1da1f2; /* Change la couleur de l'icône au survol */
}
.header {
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  padding-right: 50;
  margin-left: 300px;
}
.header h1 {
  margin-bottom: 10px;
}
.main-content {
  margin-left: 100px;
flex: 1;
}
</style>
