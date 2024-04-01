<script setup>
import { useRouter } from 'vue-router';
import { useUserStore } from '../store/user';
import { ref } from 'vue';
import { RouterLink } from 'vue-router'


const router = useRouter();

const username = ref('');
const password = ref('');

const login = () => {

    console.log('Connexion avec :', username.value, password.value);
    //sessionStorage.setItem('iduser', 'valeur');
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

<style scoped></style>
