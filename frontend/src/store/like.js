import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useLikeStore = defineStore('like', () => {
    const allLike = ref(null)

    async function getLikes() {
        const response = await fetch('http://localhost:5020/api/getLikes', { method: 'GET' })

        allLike.value = await response.json()
        return response
    }

    async function getLikesById(id) {
        const response = await fetch(`http://localhost:5020/api/likesById/${id}`, { method: 'GET' })

        const allLikeByID = await response.json()
        return allLikeByID
    }

    async function addLike(like) {
        allLike.value.push(like)

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

    return { getLikes, getLikesById, removeLike, addLike, allLike }
})