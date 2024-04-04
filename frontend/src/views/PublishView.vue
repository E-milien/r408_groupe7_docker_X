<script setup>
import { useRouter } from 'vue-router';
import { ref, onMounted } from 'vue';
import { useTweetStore } from '../store/tweet';

const router = useRouter();
const tweetStore = useTweetStore();
const tweetText = ref('');

const getCurrentUserId = () => {
    return sessionStorage.getItem('iduser');
};

onMounted(async () => {
    await tweetStore.getTweets();
});
const postTweet = async () => {
    try {
        await tweetStore.addTweet({ 'user_id': getCurrentUserId(), 'tweet_text': tweetText.value });
        router.push('/');
    } catch (error) {
        console.error('Erreur lors de la publication du tweet:', error.message);
    }
}
</script>

<template>
    <div>
        <h1>Poster un Tweet</h1>
        <textarea v-model="tweetText" rows="4" placeholder="Entrez votre tweet ici"></textarea>
        <button @click="postTweet">Poster</button>
    </div>
</template>

<style scoped>
textarea {
    width: 90%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    padding: 10px 20px;
    background-color: #1da1f2;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #1287cf;
}
</style>
