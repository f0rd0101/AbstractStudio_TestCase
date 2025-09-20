<template>
  <div>
    <form @submit.prevent="addRecord" style="margin-bottom: 1rem">
      <input v-model="name" placeholder="Name" required />
      <input v-model="email" type="email" placeholder="Email" required />
      <button type="submit">Add</button>
    </form>

    <table border="1" cellpadding="5">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in rows" :key="row.id">
          <td>{{ row.id }}</td>
          <td>{{ row.name }}</td>
          <td>{{ row.email }}</td>
        </tr>
      </tbody>
    </table>

    <p v-if="error" style="color: red">{{ error }}</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const props = defineProps({
  token: { type: String, required: true },
})

const rows = ref([])
const name = ref('')
const email = ref('')
const error = ref('')

async function loadData() {
  try {
    const res = await fetch('/api/info', {
      headers: { Authorization: `Bearer ${props.token}` },
    })
    if (!res.ok) throw new Error('Ошибка загрузки')
    rows.value = await res.json()
  } catch (e) {
    error.value = e.message
  }
}

async function addRecord() {
  try {
    const res = await fetch('/api/info', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${props.token}`,
      },
      body: JSON.stringify({ name: name.value, email: email.value }),
    })
    if (!res.ok) throw new Error('Ошибка добавления')
    name.value = ''
    email.value = ''
    await loadData()
  } catch (e) {
    error.value = e.message
  }
}

onMounted(loadData)
</script>
