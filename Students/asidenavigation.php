<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link">
                <span data-feather="file"></span>
                <p class="pt-4"><b class="text-black"> Logged In,</b><b class="text-success"> <?= $username ?></i></b></p>
              </a>
            </li>

            <li class="nav-item mt-3">
              <a class="nav-link" href="../Dashboard.php">
                <span data-feather="shopping-cart"></span>
                <h5 class="ml-3"> <i class="fa fa-home" aria-hidden="true"> Home</i></h5>
              </a>
            </li>

            <li class="nav-item mt-3">
              <a class="nav-link" href="../profile.php">
                <span data-feather="shopping-cart"></span>
                <h5 class="ml-3"> <i class="fa fa-user" aria-hidden="true"> Profile</i></h5>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="shopping-cart"></span>
                <h5 class="ml-3"><i class="fas fa-cog"> Settings</i></h5>
              </a>
            </li>
            
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span style="width:100%;height: 30px;border-bottom: 3px solid #007bff;">SIMS System</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="../logout.php">
                <span data-feather="shopping-cart"></span>
                <h4> <i class="fas fa-sign-out-alt"> Sign-out</i> </h4>
              </a>
            </li>
          </ul>
        </div>
      </nav>
