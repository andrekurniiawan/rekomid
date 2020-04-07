<template>
  <footer class="footer">
    <div class="pt-5 pb-5 footer bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-xs-12 about-company">
            <h2>Heading</h2>
            <p
              class="pr-5 text-white-50"
            >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam ac ante mollis quam tristique convallis</p>
            <p>
              <a href="#">
                <i class="fa fa-facebook-square mr-1"></i>
              </a>
              <a href="#">
                <i class="fa fa-linkedin-square"></i>
              </a>
            </p>
          </div>
          <div class="col-lg-4 col-xs-12 links">
            <h4 class="mt-lg-0 mt-sm-3">Links</h4>
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
      &:hover {
        color: #4180cb;
      }
    }
  }
  .location {
    i {
      font-size: 18px;
    }
  }
  .copyright p {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
  }
}
</style>