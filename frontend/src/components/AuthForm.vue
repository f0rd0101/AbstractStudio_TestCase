<script setup>
import { ref } from 'vue'

const mode = ref('Login')
const name = ref('')
const email = ref('')
const password = ref('')
const error = ref('')
const emit = defineEmits(['success'])

function toggleMode() {
  mode.value = mode.value === 'Login' ? 'Register' : 'Login'
}

async function submit() {
  error.value = ''
  const url = mode.value === 'Login' ? '/api/login' : '/api/register'
  const bodyData =
    mode.value === 'Login'
      ? { email: email.value, password: password.value }
      : { name: name.value, email: email.value, password: password.value }

  try {
    const res = await fetch(url, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(bodyData),
    })
    if (!res.ok) throw new Error('Ошибка авторизации')
    const data = await res.json()
    emit('success', data.accessToken)
    name.value = ''
    email.value = ''
    password.value = ''
  } catch (e) {
    error.value = e.message
  }
}
</script>

<template>
  <div>
    <h2>{{ mode }}</h2>
    <form @submit.prevent="submit">
      <input v-if="mode === 'Register'" v-model="name" placeholder="Name" required />
      <input v-model="email" type="email" placeholder="Email" required />
      <input v-model="password" type="password" placeholder="Password" required />
      <button type="submit">{{ mode }}</button>
    </form>

    <button @click="toggleMode" style="margin-top: 0.5rem">
      Switch to {{ mode === 'Login' ? 'Register' : 'Login' }}
    </button>

    <p v-if="error" style="color: red">{{ error }}</p>
  </div>
</template>
