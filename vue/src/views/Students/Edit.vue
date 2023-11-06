
<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h4>Edit Students</h4>
      </div>
      <div class="card-body">
        <ul v-if="Object.keys(errorList).length > 0">
          <li v-for="(error, index) in errorList" :key="index">
            {{ error[0] }}
          </li>
        </ul>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Name</label>
          <input type="text" class="form-control" placeholder="Enter your name" v-model="model.student.name">
        </div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Email</label>
          <input type="text" class="form-control"  placeholder="text your email" v-model="model.student.email">
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Phone</label>
          <input type="text" class="form-control"  placeholder="text your name" v-model="model.student.phone">
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Course</label>
          <input type="text" class="form-control"  placeholder="text your name" v-model="model.student.course">
        </div>
        <!-- Ostala polja za unos podataka -->
        <div class="mb-3">
          <button type="button" @click="updateStudent()" class="form-control btn btn-primary">Update</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'studentEdit',
  data() {
    return {
      studentId: '',
      errorList: {},
      model: {
        student: {
          name: '',
          email: '',
          phone: '',
          course: ''
        }
      }
    }
  },
  mounted() {
    this.studentId = this.$route.params.id;
    this.getStudentData(this.studentId);
  },
  methods: {
    getStudentData(studentId) {
      axios.get(`http://localhost:8000/api/students/${studentId}/edit`)
        .then(res => {
          this.model.student = res.data.student;
        })
        .catch(error => {
          console.error('Error fetching student data:', error);
        });
    },
    updateStudent() {
      var mythis = this;
      axios.put(`http://localhost:8000/api/students/${this.studentId}/edit`, this.model.student)
        .then(res => {
          console.log(res.data);
          alert(res.data.message);
          this.errorList = {};
        })
        .catch(error => {
          if (error.response) {
            if (error.response.status === 422) {
              mythis.errorList = error.response.data.errors;
            }
          } else if (error.request) {
            console.error(error.request);
          } else {
            console.error('Error', error.message);
          }
        });
    },
  }
}
</script>