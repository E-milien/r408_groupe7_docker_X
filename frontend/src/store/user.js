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

        return await response.json()
    }

    async function addUser(user) {
        allUser.value.push(user)


        const response = await fetch(`http://localhost:5020/api/registerNew`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(user)
        })
        return response.ok
    }

    async function logUser(credentials) {
        const response = await fetch(`http://localhost:5020/api/login`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(credentials)
        })
        return response.json()
    }
    return { getUsers, getUserById, addUser, logUser, allUser }
})