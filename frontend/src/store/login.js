import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useLoginStore = defineStore('login', () => {
    if(sessionStorage.getItem('iduser')==""&&sessionStorage.getItem('iduser')==null)
        var variableUser = ref(false)
    else
        var variableUser = ref(false)

    async function logUser(user) {
        const response = await fetch(`http://localhost:5020/api/login`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(user)
        })
        return await response.json()
    }
    async function logOut(){
        sessionStorage.setItme('iduser',"")
        variableUser.value = false
    }
    return { logUser, variableUser, logOut }
})