<script setup>
import Tweet from '../components/Tweet.vue'
import { useTweetStore } from '../store/tweet'
import { ref } from 'vue';

const tweetStore = useTweetStore()
tweetStore.getTweets()
</script>

<template>

    <section>
        <div class="tweet-list" :class="{ 'dark-mode': isDarkMode }">
            <Tweet v-for="tweet in tweetStore.allTweet" :key="tweet.id" :tweet="tweet" />
        </div>
    </section>


</template>
<style scoped>
.tweet-list {
    margin-top: 20px;
}
</style>
