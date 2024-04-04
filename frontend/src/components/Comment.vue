<script setup>
import { ref, defineProps } from 'vue';
import { useUserStore } from '../store/user';
import { useFollowStore } from '../store/follow';

const followStore = useFollowStore();
const userStore = useUserStore();
var textFollow = ref("pas assigné");
const props = defineProps({
    comment: {
        required: true,
        type: Object
    }
});

const theComment = props.comment


const getCurrentUserId = () => {
    return sessionStorage.getItem('iduser');
};


const fetchUser = async () => {
    return await userStore.getUserById(theComment.user_id);
};

const leUser = ref("");
fetchUser().then(usr => {
    leUser.value = usr
});

const fetchFollow = async () => {
    const currentId = getCurrentUserId();
    if (currentId !== "") {
        if (currentId > 0) {
            return await followStore.followed(currentId, theComment.user_id)
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

const toggleFollow = () => {
    const currentId = getCurrentUserId();
    if (currentId !== "") {
        if (currentId > 0) {
            if (textFollow.value == 'follow') {
                followStore.addFollow({ 'follower_id': currentId, 'followed_id': theComment.user_id });
                textFollow.value = 'followed';
            } else {
                followStore.removeFollow({ 'follower_id': currentId, 'followed_id': theComment.user_id });
                textFollow.value = 'follow';
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
</script>

<template>
    <div class="leCommentaire">
        <div class="userinfo">
            <img :src="leUser.profile_pic" alt="profile_picture">
            <h3>@{{ leUser.username }}</h3>
            <button class="follow-button" @click="toggleFollow">{{textFollow}}</button>
        </div>
      
        <p>{{ comment.comment_text }}</p>
        <p class="date">Posté le {{ comment.created_at }}</p>
    </div>
</template>

<style scoped>
.leCommentaire {
    margin-top: 20px;
    border-top: 1px solid #ddd;
    padding-top: 15px;
    margin-left: 20px; /* Décalage par rapport au tweet principal */
    background-color: #f0f8ff; /* Couleur de fond différente pour les commentaires */
    border-left: 5px solid #1da1f2; /* Bordure à gauche pour mettre en évidence */
    padding-left: 10px; }

.userinfo {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.leCommentaire h3 {
    font-size: 15px;
    color: #1da1f2;
    margin: 0;
    margin-left: 10px; /* Décalage supplémentaire pour le nom d'utilisateur */
}

.leCommentaire p {
    margin: 0;
    color: #333; /* Couleur de texte légèrement plus sombre */
    margin-top: 10px;
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

img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: solid 1px black;
    margin-right: 10px;
}

.date {
    color: #666;
    margin: 0;
    text-align: right;
}
</style>
