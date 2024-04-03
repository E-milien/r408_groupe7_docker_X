<script setup>
import { ref, defineProps } from 'vue';
import { useUserStore } from '../store/user';

const props = defineProps({
    comment: {
        required: true,
        type: Object
    }
});

const theComment = props.comment

const userStore = useUserStore();

const fetchUser = async () => {
    return await userStore.getUserById(theComment.user_id);
};

const leUser = ref("");
fetchUser().then(usr => {
    leUser.value = usr
});
</script>

<template>
    <div class="leCommentaire">
        <div class="userinfo">
            <img :src="leUser.profile_pic" alt="profile_picture">
        <h3>@{{ leUser.username }}</h3>
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
}
.userinfo{
    display: flex;

}
.leCommentaire h3 {
    font-size: 15px;
    color: #1da1f2;
    margin-top: 5px;

}

.leCommentaire p {
    margin: 0;
    color: grey;
    margin-top: 20px;
}


img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: solid 3px black;
    margin-right: 10px;
}

.date {
    color: #666;
    margin: 0;
    text-align: right;
}
</style>
