<template>
  <header class="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
      <div @click="toggleNav()">
        <button class="btn btn-dark mr-2">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="container">
        <a class="navbar-brand" href="#">
          <img
            src="img/rekomid-logo-512x512.png"
            width="30"
            height="30"
            class="d-inline-block align-top mr-1"
            alt
          />
          Rekom.id
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#">Kecantikan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Tekno</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Rumah Tangga</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Update Virus Corona</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- /header -->
</template>

<script>
export default {
    methods: {
        toggleNav () {
            this.$parent.$emit('toggleNav')
        }
    }
}
</script>

<style scoped>
@import "~/css/app.css";

.btn,
.btn:focus,
.btn:active {
  background-color: #343a40;
  border-color: #343a40;
  box-shadow: none;
}

.btn:hover {
  background-color: #23272b;
  border-color: #1d2124;
}
</style>