<script setup>
import { ref } from 'vue';
import { useUserStore } from '../store/user'
import { useCommentStore } from '../store/comment'
import { useLikeStore } from '../store/like'

const userStore = useUserStore();
const commentStore = useCommentStore();
const likeStore = useLikeStore();


const props = defineProps({
    tweet: {
        required: true,
        type: Object
    }
});

const liked = ref(false);

const toggleLike = () => {
    if (!liked.value) {
        likeStore.addLike({ 'user_id': 1, 'tweet_id': tweet.id }) //a cahnger la valeur 1 mettre la varaible de session
    } else {
        likeStore.addLike({ 'user_id': 1, 'tweet_id': tweet.id }) //a cahnger la valeur 1 mettre la varaible de session
    }
    liked.value = !liked.value;
};
</script>

<template>
    <div>
        <h3>{{ userStore.getUserById(tweet.user_id) }}</h3>
        <p class="text">{{ tweet.tweet_text }}</p>
        <p class="like">
            <button @click="toggleLike">{{ liked ? 'UnLike' : 'Like' }}</button>
        </p>
        <div v-for="comment in commentStore.getCommentByIdTweet(tweet.id)">
            <h3>{{ userStore.getUserById(comment.user_id) }}</h3>
            <p>{{ comment.comment_text }}</p>
        </div>
        <div>
            <input type="text" placeholder="Commentaire...">
            <button @click="">Poster</button>
        </div>
    </div>
</template>

<style scoped>
div {
    margin-bottom: 20px;
    padding: 20px;
    background-color: #f7f7f7;
    border-radius: 5px;
}

h3 {
    margin: 0;
    color: #333;
}

.text {
    color: #666;
}

.like {
    margin-top: 10px;
}

.like button {
    padding: 8px 20px;
    background-color: #1da1f2;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.like button:hover {
    background-color: #0b7bc6;
}
</style>
