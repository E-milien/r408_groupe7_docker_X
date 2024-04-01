<script setup>
import Comment from '../components/Comment.vue'
import { ref, defineProps } from 'vue';
import { useUserStore } from '../store/user';
import { useCommentStore } from '../store/comment';
import { useLikeStore } from '../store/like';

const userStore = useUserStore();
const commentStore = useCommentStore();
const likeStore = useLikeStore();
var textLike = ref("pas assigné");
const props = defineProps({
    tweet: {
        required: true,
        type: Object
    }
});
const theTweet = props.tweet



const getCurrentUserId = () => {
    return sessionStorage.getItem('iduser');
};

const fetchLike = async () => {
    return await likeStore.liked(getCurrentUserId(), theTweet.id);
};

fetchLike().then(like => {
    if (like) {
        textLike.value = '♡'
    }
    else
        textLike.value = '♥'
});
var nbLike = ref(0);
const fetchCountLike = async () => {
    return await likeStore.getLikesById(theTweet.id);
};

fetchCountLike().then(alllLikes => {
    nbLike = alllLikes.length
});

const fetchUser = async () => {
    return await userStore.getUserById(theTweet.user_id);
};

var leUser = ref("");
fetchUser().then(usr => {
    leUser.value = usr
});

const fetchComments = async () => {
    return await commentStore.getCommentByIdTweet(theTweet.id);
};

var lesCom = ref([]);
fetchComments().then(comments => {
    lesCom.value = comments
});

const commentaire = ref("");

const toggleLike = () => {

    if (textLike.value == '♥') {
        likeStore.addLike({ 'user_id': getCurrentUserId(), 'tweet_id': theTweet.id });
        textLike.value = '♡';
        nbLike.value = nbLike.value + 1;
    } else {
        likeStore.removeLike({ 'user_id': getCurrentUserId(), 'tweet_id': theTweet.id });
        textLike.value = '♥';
        nbLike.value = nbLike.value - 1;
    }
};

const postCommentaire = () => {
    const date = new Date();
    const year = date.getFullYear();
    const month = ('0' + (date.getMonth() + 1)).slice(-2);
    const day = ('0' + date.getDate()).slice(-2);
    const hours = ('0' + date.getHours()).slice(-2);
    const minutes = ('0' + date.getMinutes()).slice(-2);
    const seconds = ('0' + date.getSeconds()).slice(-2);
    const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

    const leCom = { 'comment_text': commentaire.value, 'user_id': getCurrentUserId(), 'tweet_id': theTweet.id, 'created_at': formattedDate }
    console.log(leCom)
    lesCom.value.push(leCom)
    commentStore.addComment(leCom)
    commentaire.value = "";
};
</script>

<template>

    <div id="leTweet">
        <h3>@{{ leUser.username }}</h3>
        <div id="main">
            <p class="text">{{ tweet.tweet_text }}</p>
            <p class="date">Posté le {{ tweet.created_at }}</p>
        </div>
        <div id="interact">
            <p id="likes"> {{ nbLike }}♥</p>
            <button id="button-like" @click="toggleLike">{{ textLike }}</button>
            <input type="text" id="inputCom" v-model="commentaire" placeholder="Commentaire...">
            <button id="postCom" @click="postCommentaire">Poster</button>
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
    margin: 10px;
    margin-bottom: 20px;
    margin: 5px;
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

#likes {
    margin-right: 10px;
}

#button-like {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
}

#button-like:hover {
    background-color: #0056b3;
}

#inputCom {
    flex: 1;
    margin-right: 10px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

#postCom {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

#postCom:hover {
    background-color: #218838;
}

#likes {
    color: #333;
}


.date {
    color: #666;
    margin: 0;
    text-align: right;
}
</style>
