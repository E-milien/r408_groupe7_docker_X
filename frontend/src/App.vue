<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useTweetStore } from './store/tweet'

const tweetStore = useTweetStore()
tweetStore.getTweet()
</script>

<template>
  {{ tweetStore.allTweet }}
  <header>

    <div>

      <nav>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/about">About</RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />
</template>

<style scoped></style>
./store/Tweet./store/tweet