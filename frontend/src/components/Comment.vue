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
        <h3>@{{ leUser.username }}</h3>
        <p>{{ comment.comment_text }}</p>
    </div>
</template>

<style scoped>
.leCommentaire {
    margin-top: 20px;
    border-top: 1px solid #ddd;
    padding-top: 15px;
}

.leCommentaire h3 {
    margin: 0;
    font-size: 16px;
}

.leCommentaire p {
    margin: 0;
    color: #333;
}
</style>
