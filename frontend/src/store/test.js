import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useTestStore = defineStore('test', () => {
    const mydata = ref(null)
    async function getTest(){

        

        const response = await fetch('http://localhost:5000/api/index', {method:'GET'})

        mydata.value=await response.text()
        return response

    }

    return {getTest, mydata}
})