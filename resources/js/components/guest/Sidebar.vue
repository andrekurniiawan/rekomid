<template>
  <!-- Sidebar -->
  <div class="bg-custom" id="sidebar-wrapper">
    <div class="sidebar">
      <transition name="slide">
        <div v-if="isPanelOpen" class="sidebar-panel">
          <div class="list-group list-group-flush py-4">
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-custom"
            >Tekno</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-custom"
            >Kecantikan</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-custom"
            >Kebugaran</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-custom"
            >Peralatan</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-custom"
            >Ibu dan Anak</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-custom"
            >Pakaian Wanita</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-custom"
            >Pakaian Anak</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-custom"
            >Update Virus Corona</a>
            <a
              href="#"
              class="list-group-item list-group-item-light list-group-item-action bg-custom"
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
            isPanelOpen: false
        }),
    mounted () {
    this.$parent.$on('toggleNav', () => {
      this.isPanelOpen = !this.isPanelOpen
    })
  }
}
</script>

<style scoped>
#sidebar-wrapper {
  min-height: 100vh;
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

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
}

.list-group-item {
  border: none;
  font-size: 120%;
  color: white;
}

.list-group-item:hover {
  color: white !important;
  background-color: #353a40 !important;
}

.bg-custom {
  background-color: #24272b;
}

.slide-enter-active,
.slide-leave-active {
  transition: transform 0.2s ease;
}

.slide-enter,
.slide-leave-to {
  transform: translateX(-100%);
  transition: all 150ms ease-in 0s;
}
</style>