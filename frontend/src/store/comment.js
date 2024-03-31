import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useCommentStore = defineStore('comment', () => {
    const allComment = ref(null)

    async function getComment() {
        const response = await fetch('http://localhost:5020/api/comments', { method: 'GET' })

        allComment.value = await response.json()
        return response.ok
    }

    async function getCommentById(id) {
        const response = await fetch(`http://localhost:5020/api/comments/getById/${id}`, { method: 'GET' })

        const allCommentById = await response.json()
        return allCommentById
    }

    async function getCommentByIdTweet(id) {
        const response = await fetch(`http://localhost:5020/api/comments/getByIdTweet/${id}`, { method: 'GET' })

        const allCommentById = await response.json()
        return allCommentById
    }

    async function addComment(comment) {
        allComment.value.push(comment)

        const response = await fetch(`http://localhost:5020/api/postComment`, {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(comment)
        })
        return response.ok
    }
    return { getComment, getCommentById, getCommentByIdTweet, addComment, allComment }
})