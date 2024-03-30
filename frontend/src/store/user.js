import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', () => {
    const allUser = ref(null)
    async function getUsers() {
        const response = await fetch('http://localhost:5020/api/user', { method: 'GET' })

        allUser.value = await response.json()
        return response
    }
    return { getUsers, allUser }
})