import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useTweetStore = defineStore('tweet', () => {
    const allTweet = ref(null)
    async function getTweets() {
        const response = await fetch('http://localhost:5020/api/tweet', { method: 'GET' })

        allTweet.value = await response.json()
        return response.ok
    }

    async function addTweet(tweet) {
        allTweet.value.push(tweet)

        const response = await fetch(`http://localhost:5020/api/postTweet`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(tweet)
        })
        return response.ok
    }

    async function removeTweet(tweet) {
        const tweetId = allTweet.value[tweet].id
        allTweet.value.splice(tweet, 1)

        const response = await fetch(`http://localhost:5020/api/tweets/${tweetId}`, { method: 'DELETE' })

        return response.ok
    }
    return { getTweets, removeTweet, addTweet, allTweet }
})
