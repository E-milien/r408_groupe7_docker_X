<script setup>
import Comment from '../components/Comment.vue'
import { ref, defineProps } from 'vue';
import { useUserStore } from '../store/user';
import { useCommentStore } from '../store/comment';
import { useRtStore } from '../store/retweet';
import { useFollowStore } from '../store/follow';
import { useLikeStore } from '../store/like';
import { useRouter } from 'vue-router';
const router = useRouter();

const userStore = useUserStore();
const commentStore = useCommentStore();
const followStore = useFollowStore();
const rtStore = useRtStore();
const likeStore = useLikeStore();
var textLike = ref("pas assigné");
var textRt = ref("pas assigné");
var textFollow = ref("pas assigné");
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
        textLike.value = 'liked'
    }
    else
        textLike.value = 'like'
});

const fetchRT = async () => {
    const currentId = getCurrentUserId();
    if (currentId !== "") {
        if (currentId > 0) {
            return await rtStore.retweeted(currentId, theTweet.id)
        }
        else
            return false;
    }
};

fetchRT().then(rt => {
    if (rt) {
        textRt.value = 'retweeted'
    }
    else
        textRt.value = 'retweet'
});

const fetchFollow = async () => {
    const currentId = getCurrentUserId();
    if (currentId !== "") {
        if (currentId > 0) {
            return await followStore.followed(currentId, theTweet.user_id)
        }
        else
            return false;
    }
};

fetchFollow().then(follow => {
    if (follow) {
        textFollow.value = 'followed'
    }
    else
        textFollow.value = 'follow'
});

var nbLike = ref(0);
const fetchCountLike = async () => {
    return await likeStore.getLikesById(theTweet.id);
};

fetchCountLike().then(alllLikes => {
    nbLike.value = alllLikes.length
});

var nbRT = ref(0);
const fetchCountRT = async () => {
    return await rtStore.getRtById(theTweet.id);
};

fetchCountRT().then(alllRTs => {
    nbRT.value = alllRTs.length
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
    const currentId = getCurrentUserId();
    if (currentId !== "") {
        if (currentId > 0) {
            if (textLike.value == 'like') {
                likeStore.addLike({ 'user_id': currentId, 'tweet_id': theTweet.id });
                textLike.value = 'liked';
                nbLike.value += 1;
            } else {
                likeStore.removeLike({ 'user_id': currentId, 'tweet_id': theTweet.id });
                textLike.value = 'like';
                nbLike.value -= 1;
            }
        }
        else {
            router.push('/login')
        }
    }
    else {
        router.push('/login')
    }
};


const showCommentInput = ref(false);
const showComments = ref(false); // Ajoutez une variable pour gérer l'affichage des commentaires



const toggleReply = () => {
    showCommentInput.value = !showCommentInput.value;
    showComments.value = !showComments.value; // Assurez-vous que les commentaires sont masqués lorsque vous répondez

};

const toggleRetweet = () => {
    const currentId = getCurrentUserId();
    if (currentId !== "") {
        if (currentId > 0) {
            if (textRt.value == 'retweet') {
                rtStore.addRT({ 'user_id': currentId, 'tweet_id': theTweet.id });
                textRt.value = 'retweeted';
                nbRT.value += 1;
            } else {
                rtStore.removeRT({ 'user_id': currentId, 'tweet_id': theTweet.id });
                textRt.value = 'retweet';
                nbRT.value -= 1;
            }
        }
        else {
            router.push('/login')
        }
    }
    else {
        router.push('/login')
    }
};

const toggleFollow = () => {
    const currentId = getCurrentUserId();
    if (currentId !== "") {
        if (currentId > 0) {
            if (textFollow.value == 'follow') {
                followStore.addFollow({ 'follower_id': currentId, 'followed_id': theTweet.user_id });
                textFollow.value = 'followed';
            } else {
                followStore.removeFollow({ 'follower_id': currentId, 'followed_id': theTweet.user_id });
                textFollow.value = 'follow';
            }
            document.querySelector('.follow-button').classList.toggle('clicked');

        }
        else {
            router.push('/login')
        }
    }
    else {
        router.push('/login')
    }
};

const redirigerVersCompte = (user) => {
    console.log('iduser', user.id)
    sessionStorage.setItem('idForAccount', user.id)
    console.log('localstorage', sessionStorage.getItem('idForAccount'))
    router.push('/accountOther');
}

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
            <img v-if="leUser && leUser.profile_pic" id="profile_pic" :src="leUser.profile_pic" alt="profile_picture" @click="redirigerVersCompte(leUser)">
        <img v-else id="profile_pic" src="../assets/pp/default.png" alt="profile_picture"  @click="redirigerVersCompte(leUser)">
            <h3 id="username" @click="redirigerVersCompte(leUser)">@{{ leUser.username }}</h3>
            <button v-if="parseInt(leUser.id) !== parseInt(getCurrentUserId())" class="follow-button"
                @click="toggleFollow">{{ textFollow
                }}</button>
        </div>

        <div id="main">
            <p class="text">{{ tweet.tweet_text }}</p>
            <p class="date">Posté le {{ tweet.created_at }}</p>
        </div>
        <div id="interact">
            <button class="action-button" @click="toggleReply"> {{ lesCom.length }} <i
                    :class="[showCommentInput ? 'active-reply-icon' : '', 'far fa-comment']"></i> Répondre </button>
            <button class="action-button" @click="toggleLike"><i
                    :class="[textLike === 'liked' ? 'fas' : 'far', 'fa-heart', textLike === 'liked' ? 'active-icon' : '']"></i></button>
            <span id="likes"> {{ nbLike }}</span>


            <img id="rt" :src="textRt === 'retweeted' ? 'src/assets/rt2.png' : 'src/assets/rt1.png'"
                @click="toggleRetweet" alt="Retweet" class="retweet-icon">

            <span id="rts"> {{ nbRT }}</span>
            <input type="text" id="inputCom" v-model="commentaire" placeholder="Commentaire..." v-if="showCommentInput">
            <button id="postCom" @click="postCommentaire" v-if="showCommentInput">Poster</button>
        </div>
        <div v-if="showComments">
            <Comment v-for="comment in lesCom" :key="comment.id" :comment="comment" />
        </div>
    </div>
</template>

<style scoped>
.action-button-retweet {
    color: #1da1f2;
    /* Couleur du texte */
}

#leTweet {
    background-color: rgb(231, 231, 231);
    border: 1px solid #e1e8ed;
    border-radius: 15px;
    padding: 15px;
    margin-bottom: 15px;
}

.active-icon {
    color: #1da1f2;
}

.active-reply-icon {
    color: #1da1f2;
}

#rt {
    width: 17px;
    height: 17px;
    cursor: pointer;
}

#leTweet {
    width: 90%;
}

#username {
    cursor: pointer;
}

.userProfile {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.follow-button {
    margin-left: 7px;
}

#profile_pic {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: solid 2px #1da1f2;
    margin-right: 10px;
    cursor: pointer;
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
    color: black;
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

#rts {
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

.follow-button {
    background-color: transparent;
    border: 1px solid #1da1f2;
    color: #1da1f2;
    border-radius: 9999px;
    padding: 8px 16px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
    margin-left: auto;
}
</style>
