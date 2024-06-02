<template>
   <nav class="navbar navbar-expand-lg bg-body-tertiary bg navbar-dark">
  <div class="container"> 
    <a class="navbar-brand" href="#"><img src="../images/lg2.jpg" style="width:50px ;" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/admin/users" active-class="active" class="nav-link" aria-current="page">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/admin/products" active-class="active" class="nav-link" aria-current="page">Games</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/admin/categories" active-class="active" class="nav-link" aria-current="page">Categories</router-link>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>