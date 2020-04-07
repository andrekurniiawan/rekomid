<template>
  <footer class="footer">
    <div class="pt-5 pb-5 footer bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-xs-12 about-company">
            <a class="navbar-brand my-2" href="#">
              <img
                src="img/rekomid-logo-512x512.png"
                width="30"
                height="30"
                class="d-inline-block align-top mx-2"
                alt
              />
              Rekom.id
            </a>
            <p
              class="pr-5 text-white-50"
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac ante mollis quam tristique convallis</p>
          </div>
          <div class="col-lg-3 col-xs-12 links">
            <ul class="m-0 p-0">
              <li>
                <a href="#">Lorem ipsum</a>
              </li>
              <li>
                <a href="#">Nam mauris velit</a>
              </li>
              <li>
                <a href="#">Etiam vitae mauris</a>
              </li>
              <li>
                <a href="#">Fusce scelerisque</a>
              </li>
              <li>
                <a href="#">Sed faucibus</a>
              </li>
              <li>
                <a href="#">Mauris efficitur nulla</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 col-xs-12 links">
            <ul class="m-0 p-0">
              <li>
                <a href="#">Lorem ipsum</a>
              </li>
              <li>
                <a href="#">Nam mauris velit</a>
              </li>
              <li>
                <a href="#">Etiam vitae mauris</a>
              </li>
              <li>
                <a href="#">Fusce scelerisque</a>
              </li>
              <li>
                <a href="#">Sed faucibus</a>
              </li>
              <li>
                <a href="#">Mauris efficitur nulla</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col copyright">
            <p class>
              <small class="text-white-50">© 2019. All Rights Reserved.</small>
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- /footer -->
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
@import "~/css/app.css";

.footer {
  color: white;

  .links {
    ul {
      list-style-type: none;
    }
    li a {
      color: white;
      transition: color 0.2s;
      &:hover {
        text-decoration: none;
        color: #4180cb;
      }
    }
  }
  .about-company {
    i {
      font-size: 25px;
    }
    a {
      color: white;
      transition: color 0.2s;
    }
  }
  .copyright p {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
  }
}
</style>