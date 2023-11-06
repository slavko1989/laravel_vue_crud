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
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter your name" v-model="model.student.name">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" placeholder="Enter your email" v-model="model.student.email">
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="text" class="form-control" id="phone" placeholder="Enter your phone" v-model="model.student.phone">
        </div>

        <div class="mb-3">
          <label for="course" class="form-label">Course</label>
          <input type="text" class="form-control" id="course" placeholder="Enter your course" v-model="model.student.course">
        </div>

        <div class="mb-3">
          <button type="button" @click="saveStudent()" class="form-control btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'studentCreate',
  data() {
    return {
      errorList: '',
      model: {
        student: {
          name: '',
          email: '',
          phone: '',
          course: '',
        },
      },
    };
  },
  methods: {
    saveStudent() {
      var mythis = this;
      axios.post('http://localhost:8000/api/students', this.model.student)
        .then((res) => {
          console.log(res.data);
          alert(res.data.message);
          this.model.student = {
            name: '',
            email: '',
            phone: '',
            course: '',
          };
          this.errorList = '';
        })
        .catch(function (error) {
          if (error.response) {
            if (error.response.status === 422) {
              mythis.errorList = error.response.data.errors;
            }
          } else if (error.request) {
            console.log(error.request);
          } else {
            console.log('Error', error.message);
          }
        });
    },
  },
};
</script>