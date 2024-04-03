<script setup>
import { ref, defineProps, onMounted } from 'vue';
import { useTweetStore } from '../store/tweet';
import Tweet from './Tweet.vue';

const props = defineProps({
    retweet: {
        required: true,
        type: Object
    }
});

const tweet = ref([]);
const tweetStore = useTweetStore();

const getCurrentUserId = () => {
    return sessionStorage.getItem('iduser');
};

const fetchTweet = async () => {
    const currentUserId = getCurrentUserId();
    if (currentUserId && props.retweet && props.retweet.tweet_id) {
        const tw = await tweetStore.getTweetsById(props.retweet.tweet_id);
        tweet.value = tw;
    } else {
        tweet.value = [];
    }
};

onMounted(fetchTweet);
</script>

<template>
    <p>retweet</p>
    <Tweet v-bind:key="tweet.id" :tweet="tweet" />
</template>

<style scoped>
</style>
