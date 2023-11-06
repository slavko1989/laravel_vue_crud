<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>
        Students
        <RouterLink to="students/create" class="btn btn-primary float-end">
        Add Student
      </RouterLink>
        </h4>
      </div>

      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Course</th>
              <th>Created at</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody v-if="students && students.length > 0">
            <tr v-for="(student,index) in this.students" :key="index">
              <td>{{ student.id }}</td>
              <td>{{ student.name }}</td>
              <td>{{ student.email }}</td>
              <td>{{ student.phone }}</td>
              <td>{{ student.course }}</td>
              <td>{{ student.created_at }}</td>
              <td>
                  <RouterLink :to="{path: '/students/'+student.id+'/edit' }" class="btn btn-success">Edit</RouterLink>
                  <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger">Delete</button>
               </td>
            </tr>
          </tbody>
          <tbody v-else>
          <tr><td colspan="7">Loading..</td></tr>
        </tbody>
        </table>
      </div>
      
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      students: []
    }
  },
  mounted() {
    this.fetchStudents();
  },
  methods: {
    fetchStudents() {
      axios.get('http://localhost:8000/api/students')
        .then(response => this.students = response.data)
        .catch(error => console.log(error))
    },

    deleteStudent(studentId) {
      if (confirm('Are you sure???')) {
        axios.delete(`http://localhost:8000/api/students/${studentId}/delete`)
          .then(res => {
            alert(res.data.message);
            // Uklonite studenta iz liste nakon brisanja
            this.students = this.students.filter(student => student.id !== studentId);
          })
          .catch(error => {
            console.log(error);
            alert('An error occurred while deleting the student.');
          });
      }
    }
  }
}
 
</script>