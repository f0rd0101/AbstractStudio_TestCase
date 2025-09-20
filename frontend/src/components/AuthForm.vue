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
      headers: { 'Content-Type': 'application/json', Accept: 'application/json' },
      body: JSON.stringify(bodyData),
    })
    if (!res.ok) throw new Error('Error while trying to authorize.')
    const data = await res.json()
    console.log(data)
    emit('success', data.data.accessToken)
    name.value = ''
    email.value = ''
    password.value = ''
  } catch (e) {
    error.value = e.message
  }
}
</script>


<template>
  <div class="auth-container">
    <h2>{{ mode }}</h2>
    <p class="hint">
      <span v-if="mode === 'Login'">All fields are required</span>
      <span v-else>All fields are required. Password must be at least 8 characters</span>
    </p>

    <form @submit.prevent="submit" class="auth-form">
      <input
        v-if="mode === 'Register'"
        v-model="name"
        placeholder="Name"
        required
      />
      <input v-model="email" type="email" placeholder="Email" required />
      <input
        v-model="password"
        type="password"
        placeholder="Password"
        required
        :minlength="mode === 'Register' ? 8 : null"
      />
      <button type="submit" class="submit-btn">{{ mode }}</button>
    </form>

    <button @click="toggleMode" class="switch-btn">
      Switch to {{ mode === 'Login' ? 'Register' : 'Login' }}
    </button>

    <p v-if="error" class="error">{{ error }}</p>
  </div>
</template>

<style scoped>
.auth-container {
  max-width: 400px;
  margin: 2rem auto;
  padding: 2rem 1.5rem;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
  text-align: center;
  font-family: "Segoe UI", Roboto, sans-serif;
}

h2 {
  margin-bottom: 0.3rem;
  color: #333;
}

.hint {
  margin-bottom: 1.2rem;
  font-size: 0.9rem;
  color: #666;
}

.auth-form {
  display: flex;
  flex-direction: column;
  gap: 0.8rem;
}

.auth-form input {
  padding: 0.7rem 0.9rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 0.95rem;
  transition: border 0.3s;
}

.auth-form input:focus {
  border-color: #007bff;
  outline: none;
}

.submit-btn {
  padding: 0.7rem;
  background: #007bff;
  color: #fff;
  font-weight: 600;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s;
}

.submit-btn:hover {
  background: #0056b3;
}

.switch-btn {
  margin-top: 0.8rem;
  padding: 0.6rem 1rem;
  background: transparent;
  border: 1px solid #007bff;
  color: #007bff;
  font-weight: 500;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s;
}

.switch-btn:hover {
  background: #007bff;
  color: #fff;
}

.error {
  margin-top: 1rem;
  color: #d9534f;
  font-weight: 500;
}
</style>

