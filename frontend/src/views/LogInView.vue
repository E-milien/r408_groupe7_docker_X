<script setup>
import { useRouter } from 'vue-router';
import { useLoginStore } from '../store/login';
import { ref } from 'vue';
import { RouterLink } from 'vue-router'


const router = useRouter();

const loginStore = useLoginStore();

const username = ref('');
const password = ref('');

const login = async () => {
  const credentials = {
    email: username.value,
    pwd: password.value
  };

  console.log('Tentative de connexion avec :', credentials);

  try {
    const reponse = await loginStore.logUser(credentials);
    loginStore.variableUser = true
    console.log(reponse)
    sessionStorage.setItem('iduser', reponse.user_id)
    router.push('/');
  } catch (error) {
    console.error('Erreur de connexion :', error);
  }
};

</script>


<template>

  <div class="login-page">
    <div class="login-container">
      <img src="../assets/twtter.png" alt="twitter logo">
      <h1>Connectez‑vous à Twitter</h1>
      <form @submit.prevent="login">
        <div class="form-group">
          <label for="username">E-mail</label>
          <input type="text" id="username" v-model="username" required>
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="pwd" v-model="password" required>
        </div>
        <button type="submit">Se connecter</button>
      </form>
      <div class="signup-link">
        <p><span>Vous n'avez pas de compte ?</span>
          <RouterLink to="/register">Inscrivez-vous ici</RouterLink>
        </p>
      </div>
    </div>
  </div>
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

img {
  width: 20%;
  height: 20%;
  margin-left: 40%;
}

h1 {
  color: black;
  font-family: 'Segoe UI', Geneva, Arial, Helvetica, sans-serif, sans-serif;
}

label {
  color: black;
}

p {
  color: grey;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f5f8fa;
}

.login-page {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80vh;
}

.login-container {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 40px;
  width: 400px;
  align-items: center;

}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 20px;
}

label {
  font-size: 16px;
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

button[type="submit"] {
  background-color: #1da1f2;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  width: 100%;
}

button[type="submit"]:hover {
  background-color: #0d8bf2;
}

.signup-link {
  text-align: center;
}

.signup-link p {
  font-size: 14px;
}

.signup-link a {
  color: #1da1f2;
  text-decoration: none;
}

.signup-link a:hover {
  text-decoration: underline;
}
</style>
