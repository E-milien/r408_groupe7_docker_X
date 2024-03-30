import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useTweetStore = defineStore('tweet', () => {
    const allTweet = ref(null)
    async function getTweets() {
        const response = await fetch('http://localhost:5020/api/tweet', { method: 'GET' })

        allTweet.value = await response.json()
        return response
    }
    return { getTweets, allTweet }
})
