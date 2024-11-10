<template>
  <div>
    <header>
      <img alt="Vue logo" class="logo" src="./assets/logo.svg" width="125" height="125" />
      <div class="wrapper">
        <h1>{{ message }}</h1>
        <button @click="fetchData">Fetch Data</button>
        <code>
          <pre>{{ data }}</pre>
        </code>
        <ul v-if="data">
          <li v-for="item in data" :key="item.id">
            ID: {{ item.id }}, Email: {{ item.email }}, Gender: {{ item.gender }}
          </li>
        </ul>
      </div>
    </header>
    <main>
      <TheWelcome />
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import TheWelcome from './components/TheWelcome.vue';
import axios from 'axios';

// Konfigurasi Axios
const api = axios.create({
  baseURL: 'http://localhost:8080', // Ubah jika perlu
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Interceptor untuk menangani kesalahan
api.interceptors.response.use(
  response => response,
  error => {
    console.error('API error:', error);
    return Promise.reject(error);
  }
);

// Data dan metode untuk komponen
const message = 'Hello from app.vue!';
const data = ref([]); // Awalnya data adalah array kosong
const fetchData = async () => {
  try {
    const response = await api.get('/blogs'); // Endpoint yang benar
    console.log('Response data:', response.data);
    data.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  }
};
</script>

<style scoped>
header {
  line-height: 1.5;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }
}
</style>
