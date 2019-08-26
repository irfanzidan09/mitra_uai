<header>
<div class="headerpanel">

      <div class="logopanel">
        <h2><a href="index.html">UAI</a></h2>
      </div><!-- logopanel -->

      <div class="headerbar">

        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>

        <div class="searchpanel">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
            </span>
          </div><!-- input-group -->
        </div>

        <div class="header-right">
          <ul class="headermenu">
            <li>
              
            </li>
            <li>
              <div class="btn-group">
                <button type="button" class="btn btn-logged" data-toggle="dropdown">
                  <img src="images/photos/loggeduser.png" alt="">
                  <?php echo $this->session->userdata('nama'); ?>
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right">
                  <li><a href="profile.html"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                  <li><a href="<?php echo base_url().'/login/logout_keuangan' ?>"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                </ul>
              </div>
            </li>
            
          </ul>
        </div><!-- header-right -->
      </div><!-- headerbar -->
    </div>
  </header>