import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useRtStore = defineStore('rt', () => {
    const allRT = ref(null)

    async function getRT() {
        const response = await fetch('http://localhost:5020/api/getRetweets', { method: 'GET' })

        allRT.value = await response.json()
        return response
    }

    async function retweeted(user_id, tweet_id) {
        try {
            const response = await fetch(`http://localhost:5020/api/retweeted/${user_id}/${tweet_id}`, { method: 'GET' });
            if (await response.json() != "")
                return true;
            else
                return false;
        } catch (error) {

            return false;
        }
    }

    async function getRtById(id) {
        const response = await fetch(`http://localhost:5020/api/retweetsById/${id}`, { method: 'GET' })

        const allRtByID = await response.json()
        return allRtByID
    }

    async function addRT(retweet) {
        const response = await fetch(`http://localhost:5020/api/postRetweet`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(retweet)
        })
        return response.ok
    }

    async function removeRT(retweet) {
        const response = await fetch(`http://localhost:5020/api/retweets/${retweet.user_id}/${retweet.tweet_id}`, { method: 'DELETE' })

        return response.ok
    }

    return { getRT, getRtById, retweeted, removeRT, addRT, allRT }
})