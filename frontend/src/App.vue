<template>
  <div class="container">
    <header class="header">
      <h1>Twitter</h1>
      <button @click="toggleDarkMode">{{ isDarkMode ? 'Mode Jour' : 'Mode Nuit' }}</button>
      <nav>
        <p><RouterLink to="/" class="nav-link">Home</RouterLink></p>
        <p><RouterLink to="/register" class="nav-link">Créer un compte</RouterLink></p>
        <p><RouterLink to="/login" class="nav-link">Se connecter</RouterLink></p>
        <p><RouterLink to="/account" class="nav-link">Mon compte</RouterLink></p>
      </nav>
      <h1>{{ connected }}</h1>
    </header>
    <main class="main-content">
      <RouterView />
    </main>
  </div>
</template>

<style scoped>
.container {
  display: flex;
  height: 100vh;
}
nav {
  display: flex;
  flex-direction: column;
  position: fixed;
  
}
nav a {
  text-decoration: non;
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
float:  right 30%;
}
/* Ajoutez ici d'autres styles nécessaires */
</style>
