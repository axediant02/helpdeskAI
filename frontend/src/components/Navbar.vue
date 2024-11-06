<template>
    <div>
      <nav class="navbar flex justify-center">
        <ul>
          <li><router-link to="/">Home</router-link></li>
          <li><router-link to="/about">About</router-link></li>
          <li><router-link to="/contact">Contact Us</router-link></li>
          <li><router-link to="/help">Help</router-link></li>
        </ul>
      </nav>
    </div>
  </template>
  
<script>
</script>

  <style scoped>
  .navbar {
    background-color: #333;
    overflow: hidden;
  }
  
  .navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
  }
  
  .navbar ul li {
    float: left;
  }
  
  .navbar ul li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
  }
  
  .navbar ul li a:hover {
    background-color: #575757;
  }
  </style>
  