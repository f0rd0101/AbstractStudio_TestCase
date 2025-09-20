<script setup>
import { ref } from 'vue'
import AuthForm from './components/AuthForm.vue'
import InfoView from './components/InfoView.vue'

const token = ref(localStorage.getItem('api_token') || '')

function setToken(newToken) {
  token.value = newToken
  localStorage.setItem('api_token', newToken)
}

function logout() {
  token.value = ''
  localStorage.removeItem('api_token')
}
</script>


<template>
  <div class="container">
    <h1>Info Table</h1>

    <div v-if="!token" class="auth-block">
      <auth-form @success="setToken" />
    </div>

    <div v-else class="info-block">
      <info-view :token="token" />
      <button @click="logout" class="logout-btn">Logout</button>
    </div>
  </div>
</template>

<style scoped>
.container {
  max-width: 600px;
  margin: 2rem auto;
  padding: 1.5rem 2rem;
  font-family: "Segoe UI", Roboto, sans-serif;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
  transition: transform 0.2s ease;
}

.container:hover {
  transform: translateY(-2px);
}

h1 {
  text-align: center;
  margin-bottom: 1.5rem;
  font-size: 1.6rem;
  color: #333;
}

.auth-block,
.info-block {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.logout-btn {
  margin-top: 1rem;
  padding: 0.6rem 1.2rem;
  border: none;
  background: #ff4d4f;
  color: white;
  font-weight: 600;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s;
}

.logout-btn:hover {
  background: #d9363e;
}
</style>


