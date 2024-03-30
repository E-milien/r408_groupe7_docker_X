<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useTweetStore } from './store/tweet'

const tweetStore = useTweetStore()
tweetStore.getTweet()
</script>

<template>

  <header>
    {{ tweetStore.allTweet }}

    <nav>
      <RouterLink to="/">Acceuil</RouterLink>
      <RouterLink to="/register">Créer un compte</RouterLink>
      <RouterLink to="/login">Se connecter</RouterLink>
    </nav>
  </header>
</template>

<style scoped></style>