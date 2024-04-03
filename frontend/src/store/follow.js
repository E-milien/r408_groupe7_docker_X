import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useFollowStore = defineStore('follow', () => {
    const allFollow = ref(null)

    async function getFollows() {
        const response = await fetch('http://localhost:5020/api/getFollows', { method: 'GET' })

        allFollow.value = await response.json()
        return response
    }

    async function followed(follower, followed) {
        try {
            const response = await fetch(`http://localhost:5020/api/followed/${follower}/${followed}`, { method: 'GET' });
            if (await response.json() != "")
                return true;
            else
                return false;
        } catch (error) {

            return false;
        }
    }

    async function getFollowById(id) {
        const response = await fetch(`http://localhost:5020/api/followsById/${id}`, { method: 'GET' })

        const allFollowByID = await response.json()
        return allFollowByID
    }

    async function addFollow(follow) {
        const response = await fetch(`http://localhost:5020/api/postFollow`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(follow)
        })
        return response.ok
    }

    async function removeFollow(follow) {
        const response = await fetch(`http://localhost:5020/api/followers/${follow.follower_id}/${follow.followed_id}`, { method: 'DELETE' })

        return response.ok
    }

    return { getFollows, getFollowById, followed, removeFollow, addFollow, allFollow }
})