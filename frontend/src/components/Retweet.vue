<script setup>
import { ref, defineProps } from 'vue';
import { useTweetStore } from '../store/tweet';
import { useUserStore } from '../store/user';
import Tweet from './Tweet.vue';
const userStore = useUserStore();
const props = defineProps({
    retweet: {
        required: true,
        type: Object
    }
});
const retweet = props.retweet
const tweet = ref([]);
const tweetStore = useTweetStore();

const fetchRetweet = async () => {
    return await tweetStore.getTweetsById(retweet.tweet_id)
};
const getCurrentUserId = () => {
    return sessionStorage.getItem('iduser');
};

fetchRetweet().then(t => {
    tweet.value = t[0]
});

const fetchUser = async () => {
    return await userStore.getUserById(retweet.user_id);
};

var leUser = ref("");
fetchUser().then(usr => {
    leUser.value = usr
});

</script>

<template>
    <div class="retweet">
        <p v-if="leUser.id !== getCurrentUserId">@{{ leUser.username }} à reposté</p>
        <p v-else>Vous avez reposté</p>
        <Tweet :key="tweet.id" :tweet="tweet" />
    </div>
</template>

<style scoped>
.retweet {
    background-color: #f4f4f4;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.retweet p {
    font-size: 18px;
    margin-bottom: 10px;
}
</style>
