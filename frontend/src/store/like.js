import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useLikeStore = defineStore('like', () => {
    const allLike = ref(null)

    async function getLikes() {
        const response = await fetch('http://localhost:5020/api/getLikes', { method: 'GET' })

        allLike.value = await response.json()
        return response
    }

    async function liked(user_id, tweet_id) {
        try {
            const response = await fetch(`http://localhost:5020/api/liked/${user_id}/${tweet_id}`, { method: 'GET' });
            if (await response.json() != "")
                return true;
            else
                return false;
        } catch (error) {

            return false;
        }
    }

    async function getLikesById(id) {
        const response = await fetch(`http://localhost:5020/api/likesById/${id}`, { method: 'GET' })

        const allLikeByID = await response.json()
        return allLikeByID
    }

    async function addLike(like) {
        const response = await fetch(`http://localhost:5020/api/postLike`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(like)
        })
        return response.ok
    }

    async function removeLike(like) {
        const response = await fetch(`http://localhost:5020/api/likes/${like.user_id}/${like.tweet_id}`, { method: 'DELETE' })

        return response.ok
    }

    return { getLikes, getLikesById, liked, removeLike, addLike, allLike }
})