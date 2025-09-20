
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
    if (!res.ok) throw new Error('Loading error')
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
    if (!res.ok) throw new Error('Adding Error.')
    name.value = ''
    email.value = ''
    await loadData()
  } catch (e) {
    error.value = e.message
  }
}

onMounted(loadData)
</script>




<template>
  <div class="container">
    <h2>All fields are required!</h2>
    <form @submit.prevent="addRecord" class="form">
      <input v-model="name" placeholder="Name" required />
      <input v-model="email" type="email" placeholder="Email" required />
      <button type="submit">Add</button>
    </form>

    <table class="table">
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

    <p v-if="error" class="error">{{ error }}</p>
  </div>
</template>

<style scoped>
.container {
  max-width: 600px;
  margin: 2rem auto;
  padding: 1.5rem;
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
  font-family: "Segoe UI", Roboto, sans-serif;
}

h2 {
  text-align: center;
  margin-bottom: 1.2rem;
  color: #333;
}

.form {
  display: flex;
  gap: 0.5rem;
  margin-bottom: 1rem;
}

.form input {
  flex: 1;
  padding: 0.6rem 0.8rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  transition: border 0.3s;
}

.form input:focus {
  border-color: #007bff;
  outline: none;
}

.form button {
  padding: 0.6rem 1rem;
  border: none;
  background: #007bff;
  color: white;
  font-weight: 600;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s;
}

.form button:hover {
  background: #0056b3;
}

.table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 1rem;
  border-radius: 8px;
  overflow: hidden;
}

.table th {
  background: #f8f9fa;
  text-align: left;
  padding: 0.75rem;
  color: #555;
}

.table td {
  padding: 0.75rem;
  border-top: 1px solid #eee;
}

.table tr:nth-child(even) {
  background: #fafafa;
}

.error {
  margin-top: 1rem;
  color: #d9534f;
  text-align: center;
  font-weight: 500;
}
</style>

