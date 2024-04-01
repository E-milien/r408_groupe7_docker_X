<script setup>
import { useRouter } from 'vue-router';
import { useUserStore } from '../store/user'
import { ref } from 'vue';
import { RouterLink,RouterView } from 'vue-router'



const userStore = useUserStore();

const router = useRouter();

const firstname = ref('');
const lastname = ref('');
const username = ref('');
const email = ref('');
const password = ref('');

const register = async () => {
    const newUser = {
        firstname: firstname.value,
        lastname: lastname.value,
        username: username.value,
        email: email.value,
        pwd: password.value
    };
    console.log('Nouvel utilisateur :', newUser);
    await userStore.addUser(newUser); // Appel de la méthode addUser du magasin
    router.push('/');
};
</script>

<template>

    <div class="signup-page">
        <div class="signup-container">
            <h1>S'inscrire à Twitter</h1>
            <form @submit.prevent="register">
                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" v-model="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Nom de famille</label>
                    <input type="text" id="lastname" v-model="lastname" required>
                </div>
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" v-model="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" v-model="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" v-model="password" required>
                </div>
                <button type="submit">S'inscrire</button>
            </form>
            <div class="login-link">
                <p>Vous avez déjà un compte ? <RouterLink to="/login">Connectez-vous ici</RouterLink>
                </p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.signup-page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.signup-container {
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

.login-link {
    margin-top: 20px;
}

.login-link p {
    text-align: center;
}

.login-link p RouterLink {
    color: #1da1f2;
}
</style>