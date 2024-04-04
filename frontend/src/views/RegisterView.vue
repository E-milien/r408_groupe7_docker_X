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
    await userStore.addUser(newUser); 
    // const response = await userStore.logUser({ email: email.value, pwd: password.value }); 
    //     sessionStorage.setItem('iduser', response.user_id); 
    //     userStore.variableUser = true; 

    
    router.push('/');
};
</script>

<template>
<div class="signup-page">
        <div class="signup-container">
            <img src="../assets/twtter.png" alt="twitter logo">

            <h1>S'inscrire à Twitter</h1>
            <form @submit.prevent="register">
                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" v-model="firstname" required>
                    <span class="error-message" v-if="!firstnameIsValid">Veuillez entrer votre prénom</span>
                </div>
                <div class="form-group">
                    <label for="lastname">Nom de famille</label>
                    <input type="text" id="lastname" v-model="lastname" required>
                    <span class="error-message" v-if="!lastnameIsValid">Veuillez entrer votre nom de famille</span>
                </div>
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" v-model="username" required>
                    <span class="error-message" v-if="!usernameIsValid">Veuillez entrer votre nom d'utilisateur</span>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" v-model="email" required>
                    <span class="error-message" v-if="!emailIsValid">Veuillez entrer une adresse email valide</span>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" v-model="password" required>
                    <span class="error-message" v-if="!passwordIsValid">Veuillez entrer un mot de passe</span>
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
input:invalid {
    border-color: #ff0000;
}

/* Styliser les messages d'erreur */
.error-message {
    color: #ff0000;
    font-size: 12px;
    display: block;
    margin-top: 5px;
}

img{
    width: 20%;
    height: 20%;
}
h1{
    color: black;
    font-family: 'Segoe UI',  Geneva, Arial, Helvetica, sans-serif, sans-serif;
}
label{
    color: black;
}
p{
    color: grey;
}
.signup-page {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
    background-color: #f5f8fa;
}

.signup-container {
    width: 420px;
    padding: 20px;
    border: 1px solid #e1e8ed;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    margin-top: 50px;
    margin-right: 50px;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccd6dd;
    border-radius: 5px;
    width: calc(100% - 20px); 
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
    text-align: center;
}

.login-link p {
    font-size: 14px;
}

.login-link p RouterLink {
    color: #1da1f2;
    text-decoration: none;
}

.login-link p RouterLink:hover {
    text-decoration: underline;
}
</style>