<script setup>
import Comment from '../components/Comment.vue'
import { ref, defineProps } from 'vue';
import { useUserStore } from '../store/user';
import { useCommentStore } from '../store/comment';
import { useLikeStore } from '../store/like';
import { useRouter } from 'vue-router';
const router = useRouter();

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
    const currentId = getCurrentUserId();
    if (currentId !== "") {
        if (currentId > 0) {
            return await likeStore.liked(currentId, theTweet.id)
        }
        else
            return false;
    }
};

fetchLike().then(like => {
    if (like) {
        textLike.value = '♥'
    }
    else
        textLike.value = '♡'
});

var nbLike = ref(0);
const fetchCountLike = async () => {
    return await likeStore.getLikesById(theTweet.id);
};

fetchCountLike().then(alllLikes => {
    nbLike.value = alllLikes.length
});

const fetchUser = async () => {
    return await userStore.getUserById(theTweet.user_id);
};

var leUser = ref("");
fetchUser().then(usr => {
    leUser.value = usr
});
console.log(leUser.value.profile_pic)


const fetchComments = async () => {
    return await commentStore.getCommentByIdTweet(theTweet.id);
};

var lesCom = ref([]);
fetchComments().then(comments => {
    lesCom.value = comments
});

const commentaire = ref("");

const toggleLike = () => {
    const currentId = getCurrentUserId();
    if (currentId !== "") {
        if (currentId > 0) {
            if (textLike.value == '♡') {
                likeStore.addLike({ 'user_id': currentId, 'tweet_id': theTweet.id });
                textLike.value = '♥';
                nbLike.value += 1;
            } else {
                likeStore.removeLike({ 'user_id': currentId, 'tweet_id': theTweet.id });
                textLike.value = '♡';
                nbLike.value -=  1;
            }
        }
        else
        {
            router.push('/login')
        }   
    }
    else {
        router.push('/login')
    }
};

const toggleReply = () => {
    // Ajoutez ici la logique pour répondre au tweet
};

const toggleRetweet = () => {
    // Ajoutez ici la logique pour retweeter le tweet
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
    lesCom.value.push(leCom)
    commentStore.addComment(leCom)
    commentaire.value = "";
};

</script>

<template>
    <div id="leTweet">
        <div class="userProfile">
            <img :src="leUser.profile_pic" alt="profile_picture">
            <h3 id="username">@{{ leUser.username }}</h3>
            <button class="follow-button"><i class="fas fa-user-plus"></i></button>

        </div>

        <div id="main">
            <p class="text">{{ tweet.tweet_text }}</p>
            <p class="date">Posté le {{ tweet.created_at }}</p>
        </div>
        <div id="interact">
            <button class="action-button" @click="toggleReply"><i class="far fa-comment"></i> Répondre</button>
            <button class="action-button" @click="toggleLike"><i :class="[textLike === '♥' ? 'fas' : 'far', 'fa-heart']"></i></button>
            <span id="likes"> {{ nbLike }}</span>
            <button class="action-button" @click="toggleRetweet"><i class="fas fa-retweet"></i> Retweeter</button>
            <input type="text" id="inputCom" v-model="commentaire" placeholder="Commentaire...">
            <button id="postCom" @click="postCommentaire">Poster</button>
        </div>
        <Comment v-for="comment in lesCom" :key="comment.id" :comment="comment" />
    </div>
</template>

<style scoped>
#leTweet {
    background-color: #ffffff;
    border: 1px solid #e1e8ed;
    border-radius: 15px;
    padding: 15px;
    margin-bottom: 15px;
}
#leTweet{
    width: 700px;
}

.userProfile {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: solid 3px black;
    margin-right: 10px;
}

#leTweet h3 {
    margin: 0;
    font-size: 18px;
    color: #1da1f2;
}

#main {
    margin-bottom: 10px;
}

.text {
    color: #14171a;
    margin: 0;
    font-size: 16px;
    line-height: 1.4;
}

#interact {
    display: flex;
    align-items: center;
}

.action-button {
    background-color: transparent;
    border: none;
    color: #1da1f2;
    margin-right: 10px;
    cursor: pointer;
    font-size: 16px;
}

.action-button:hover {
    color: #006cb7;
}

#likes {
    color: #657786;
    margin-right: 10px;
}

#inputCom {
    flex: 1;
    margin-right: 10px;
    padding: 8px;
    border: 1px solid #e1e8ed;
    border-radius: 25px;
    font-size: 16px;
}

#postCom {
    background-color: #1da1f2;
    color: #ffffff;
    border: none;
    padding: 8px 20px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 16px;
}

#postCom:hover {
    background-color: #0d91e0;
}

.date {
    color: #657786;
    margin: 0;
    font-size: 14px;
    text-align: right;
}
</style>
