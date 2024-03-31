<script setup>
import Comment from '../components/Comment.vue'
import { ref, defineProps } from 'vue';
import { useUserStore } from '../store/user';
import { useCommentStore } from '../store/comment';
import { useLikeStore } from '../store/like';

const props = defineProps({
    tweet: {
        required: true,
        type: Object
    }
});

const theTweet = props.tweet

const userStore = useUserStore();
const commentStore = useCommentStore();
const likeStore = useLikeStore();

const liked = ref(false);
const commentaire = ref("");

const toggleLike = () => {
    if (!liked.value) {
        likeStore.addLike({ 'user_id': getCurrentUserId(), 'tweet_id': theTweet.id });
    } else {
        likeStore.removeLike({ 'user_id': getCurrentUserId(), 'tweet_id': theTweet.id });
    }
    liked.value = !liked.value;
};

const postCommentaire = () => {
    useCommentStore.addComment({ 'comment_text': commentaire, 'user_id': getCurrentUserId, 'tweet_id': theTweet.id })
};



const getCurrentUserId = () => {
    // return sessionStorage.getItem('iduser');
    return 1;
};

const fetchUser = async () => {
    return await userStore.getUserById(theTweet.user_id);
};

const leUser = ref("");
fetchUser().then(usr => {
    leUser.value = usr
});

const fetchComments = async () => {
    return await commentStore.getCommentByIdTweet(theTweet.id);
};

const lesCom = ref([]);
fetchComments().then(comments => {
    lesCom.value = comments
});
</script>

<template>
    <div id="leTweet">
        <h3>@{{ leUser.username }}</h3>
        <div id="main">
            <p class="text">{{ tweet.tweet_text }}</p>
            <p class="date">Posté le {{ tweet.created_at }}</p>
        </div>
        <div id="interact">
            <p class="like">
                <button @click="toggleLike">{{ liked.value ? 'UnLike' : 'Like' }}</button>
            </p>
            <input type="text" v-model="commentaire" placeholder="Commentaire...">
            <button @click="postCommentaire">Poster</button>
        </div>
        <Comment v-for="comment in lesCom" :key="comment.id" :comment="comment" />
    </div>
</template>

<style scoped>
#leTweet {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
}

#leTweet h3 {
    margin: 0 0 10px 0;
    font-size: 18px;
    color: #333;
}

#main {
    margin-bottom: 10px;
}

.text {
    color: #666;
    margin: 0;
    font-size: larger;
}

#interact {
    display: flex;
    align-items: center;
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

#interact input[type="text"],
#interact button {
    margin-left: 10px;
}

.date {
    color: #666;
    margin: 0;
    text-align: right;
}
</style>
