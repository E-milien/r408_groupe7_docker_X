import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useLoginStore = defineStore('login', () => {
    async function logUser(user) {
        const response = await fetch(`http://localhost:5020/api/login`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(user)
        })
        return await response.json()
    }

    return { logUser }
})