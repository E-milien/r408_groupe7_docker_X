<script setup>
import { useRouter } from 'vue-router';

const router = useRouter();

const username = ref('');
const password = ref('');

const login = () => {

    console.log('Connexion avec :', username.value, password.value);

    router.push('/');
};
</script>

<template>
    <div class="login-page">
        <div class="login-container">
            <h1>Se connecter à Twitter</h1>
            <form @submit.prevent="login">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" v-model="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" v-model="password" required>
                </div>
                <button type="submit">Se connecter</button>
            </form>
            <div class="signup-link">
                <p>Vous n'avez pas de compte ? <RouterLink to="/register">Inscrivez-vous ici</RouterLink>
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.login-page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    width: 400px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #1da1f2;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0b7bc6;
}

.signup-link {
    margin-top: 20px;
}

.signup-link p {
    text-align: center;
}

.signup-link p RouterLink {
    color: #1da1f2;
}
</style>
