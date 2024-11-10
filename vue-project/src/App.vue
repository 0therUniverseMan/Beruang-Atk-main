<template>
  <div>
    <h3 class="logo">Data Blogs</h3>
    <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Nama Depan</th>
          <th>Nama Belakang</th>
          <th>Email</th>
          <th>Gender</th>
          <th>Nama Mobil</th>
          <th>Tahun Mobil</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(blog, index) in blogs" :key="blog.id">
          <td>{{ index + 1 }}</td>
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
export default {
  data() {
    return {
      blogs: [] // Menyimpan data blogs dari API
    };
  },
  methods: {
    fetchBlogs() {
      fetch('http://localhost:8080/blogs') // ganti dengan URL API Anda
        .then(response => response.json())
        .then(data => {
          if (data.message === "success banget") {
            this.blogs = data.blogs; // Menyimpan data blogs ke dalam array blogs
          } else {
            console.error("Failed to fetch blogs");
          }
        })
        .catch(error => {
          console.error("Error:", error);
        });
    }
  },
  mounted() {
    this.fetchBlogs(); // Panggil fetchBlogs saat komponen di-mount
  }
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
  text-align: left;
}
</style>
