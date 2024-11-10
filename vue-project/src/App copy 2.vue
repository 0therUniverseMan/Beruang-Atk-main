<template>
  <div>
    <h3 class="logo">Daftar Blog</h3>
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Depan</th>
          <th>Nama Belakang</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Mobil</th>
          <th>Tahun Mobil</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(blog, indeks) in blogs" :key="blog.id">
          <td>{{ indeks + 1 }}</td>
          <td>{{ blog.first_name }}</td>
          <td>{{ blog.last_name }}</td>
          <td>{{ blog.email }}</td>
          <td>{{ blog.gender }}</td>
          <td>{{ blog.name_car }}</td>
          <td>{{ blog.car_model_year }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      blogs: [], // untuk menyimpan data yang diambil dari API
    };
  },
  methods: {
    loadBlogs() {
      axios
        .get('http://localhost:8080/blogs')
        .then((response) => {
          // Memastikan bahwa response memiliki struktur yang sesuai
          this.blogs = response.data.blogs; // Mengambil array `blogs` dari response
          console.log(response.data.message); // Bisa juga menampilkan pesan sukses jika perlu
        })
        .catch((error) => {
          console.error('Error:', error);
        });
    },
  },
  mounted() {
    // Memanggil method `loadBlogs` ketika komponen selesai dirender
    this.loadBlogs();
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}

th,
td {
  border: 1px solid #ddd;
  padding: 8px;
}

th {
  background-color: #f2f2f2;
}

.logo {
  margin-bottom: 20px;
  text-align: center;
}
</style>
