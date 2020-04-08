<template>
  <div class="d-flex" id="wrapper">
    <Sidebar></Sidebar>
    <div id="page-wrapper">
      <Header></Header>
      <Content></Content>
      <Footer></Footer>
    </div>
    <!-- /#page-wrapper -->
  </div>
</template>

<script>
import Header from "./guest-parts/Header.vue";
import Content from "./guest-parts/Content.vue";
import Sidebar from "./guest-parts/Sidebar.vue";
import Footer from "./guest-parts/Footer.vue";

export default {
    name: 'Guest',
    components: {
      Header, Content, Sidebar, Footer
    }
}
</script>

<style scoped>
@import "~/css/app.css";

body {
  overflow-x: hidden;
}

#page-wrapper {
  min-width: 100vw;
}

@media (min-width: 768px) {
  #page-wrapper {
    min-width: 0;
    width: 100%;
  }
}
</style>