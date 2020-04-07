<template>
  <!-- Sidebar -->
  <div class="bg-dark-blue" id="sidebar-wrapper">
    <div class="sidebar">
      <transition name="slide">
        <div v-if="isPanelOpen" class="sidebar-panel">
          <div class="list-group list-group-flush py-4">
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-dark-blue"
            >Tekno</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-dark-blue"
            >Kecantikan</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-dark-blue"
            >Kebugaran</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-dark-blue"
            >Peralatan</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-dark-blue"
            >Ibu dan Anak</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-dark-blue"
            >Pakaian Wanita</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-dark-blue"
            >Pakaian Anak</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-dark-blue"
            >Update Virus Corona</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-dark-blue"
            >Viral</a>
          </div>
        </div>
      </transition>
    </div>
  </div>
  <!-- /#sidebar-wrapper -->
</template>

<script>
export default {
    data: () => ({
            isPanelOpen: true
        }),
    mounted () {
    this.$parent.$on('toggleNav', () => {
      this.isPanelOpen = !this.isPanelOpen
    })
  }
}
</script>

<style>
body {
  overflow-x: hidden;
}

#sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  -webkit-transition: margin 0.25s ease-out;
  -moz-transition: margin 0.25s ease-out;
  -o-transition: margin 0.25s ease-out;
  transition: margin 0.25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
  width: 15rem;
}

#page-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #page-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
}
</style>

<style scoped>
@import "~/css/app.css";

.list-group-item {
  border: none;
  font-size: 120%;
  color: white;
}

.list-group-item:hover {
  color: white;
  background-color: #353a40;
}

.bg-dark-blue {
  background-color: #24272b;
}
</style>