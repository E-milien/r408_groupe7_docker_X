import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', () => {
    const allUser = ref([])
    async function getUsers() {
        const response = await fetch('http://localhost:5020/api/users', { method: 'GET' })

        allUser.value = await response.json()
        return response.ok
    }

    async function getUserById(id) {
        const response = await fetch(`http://localhost:5020/api/users/getById/${id}`, { method: 'GET' })

        const unUser = await response.json()
        return unUser
    }

    async function addUser(user) {
        allUser.value.push(user)


        const response = await fetch(`http://localhost:5020/api/register`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(user)
        })
        return response.ok
    }
    return { getUsers, getUserById,addUser, allUser }
})