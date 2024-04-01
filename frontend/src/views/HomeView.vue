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
    <a href="/publish"><img src="../assets/tweet.png" alt="img" class="publish-image"></a>

</template>
<style scoped>
.tweet-list {
    margin-top: 20px;
}

.publish-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.publish-button:hover {
    background-color: #0056b3;
}

.publish-image {
    position: fixed;
    bottom: 60px;
    right: 20px;
    width: 70px;
    height: auto;
    cursor: pointer;
}
</style>
