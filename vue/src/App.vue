<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
  <header>
    <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" />

    <div class="wrapper">


      <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <RouterLink to="/" class="navbar-brand">Home</RouterLink>
        
        </li>
        <li class="nav-item">
          <RouterLink to="/about" class="navbar-brand">About</RouterLink>
        </li>
        <li class="nav-item">
          <RouterLink to="/students" class="navbar-brand">Student</RouterLink>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
      

      
    </div>
  </header>

  <RouterView />
</template>

<style scoped>

</style>
