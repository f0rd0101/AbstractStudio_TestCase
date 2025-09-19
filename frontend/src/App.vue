<template>
  <div style="max-width:600px;margin:2rem auto;font-family:sans-serif">
    <h1>Info Table</h1>

    <div v-if="!token">
      <auth-form @success="setToken" />
    </div>

    <div v-else>
      <info-view :token="token" />
      <button @click="logout" style="margin-top:1rem">Logout</button>
    </div>
  </div>
</template>

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
