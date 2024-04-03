import { ref } from 'vue'
import { defineStore } from 'pinia'

// Définition du store des tweets
export const useTweetStore = defineStore('tweet', () => {
    const allTweet = ref([])

    // Fonction pour récupérer tous les tweets
    async function getTweets() {
        const response = await fetch('http://localhost:5020/api/tweet', { method: 'GET' })
        allTweet.value = await response.json()
        allTweet.value.sort((a, b) => new Date(b.created_at) - new Date(a.created_at)) // Trier par date de création
        return response.ok
    }

    async function getTweetsByUserId(userId) {
        const response = await fetch(`http://localhost:5020/api/tweet/getByIdTweet/${userId}`, { method: 'GET' })
        return await response.json()
    }

    async function getTweetsById(id) {
        const response = await fetch(`http://localhost:5020/api/tweet/tweetById/${id}`, { method: 'GET' })
        return await response.json()
    }

    // Fonction pour ajouter un nouveau tweet
    async function addTweet(tweet) {
        allTweet.value.push(tweet)
        const response = await fetch(`http://localhost:5020/api/createtweet`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(tweet)
        })
        return response.ok
    }

    // Fonction pour supprimer un tweet
    async function removeTweet(tweet) {
        const tweetId = allTweet.value[tweet].id
        allTweet.value.splice(tweet, 1)
        const response = await fetch(`http://localhost:5020/api/tweets/${tweetId}`, { method: 'DELETE' })
        return response.ok
    }

    // Retourner les méthodes et la liste complète des tweets
    return { getTweets, removeTweet, addTweet,getTweetsByUserId, allTweet,getTweetsById }
})
