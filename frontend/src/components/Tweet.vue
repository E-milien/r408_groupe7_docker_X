<script setup>
import { ref } from 'vue';


const props = defineProps({
    tweet: {
        required: true,
        type: Object
    }
});

const liked = ref(false);

const toggleLike = () => {
    liked.value = !liked.value;
};
</script>

<template>
    <div>
        <h3>{{ tweet.user_id }}</h3>
        <p class="text">{{ tweet.tweet_text }}</p>
        <p class="like">
            <button @click="toggleLike">{{ liked ? 'UnLike' : 'Like' }}</button>
        </p>
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
