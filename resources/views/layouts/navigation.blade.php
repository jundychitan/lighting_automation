  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center navbar_header_bg">
    <div class="d-flex align-items-center justify-content-between">
	<i class="bi bi-list toggle-sidebar-btn toggle_sidebar"></i>
      <div class="logo d-flex align-items-center">
	  <!--<img src="data:image/jpeg;base64,-->
		<img src="data:image/jpeg;base64,{{$WebPageSettingsdata->image_logo}}" class="rounded" style="width:{{$WebPageSettingsdata->header_navigation_width}}px;">
        <span class="d-lg-block navbar_header_title" <?php if($data->user_type!="User"){ ?> id="navbar_header_title" style="cursor: pointer;" <?php } ?>><?php echo $WebPageSettingsdata->navigation_header_title; ?></span>
      </div>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!--<img src="{{asset('template/assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">-->
			<span class="bi bi-person-circle rounded-circle" style="color: #1b1b1b !important; font-size: 30px;"></span>			
            <span class="d-none d-md-block dropdown-toggle ps-2 navbar_white_text">{{$data->user_real_name}}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{$data->user_name}}</h6>
              <span>{{$data->user_type}}</span>
            </li>
           
		   <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" id="accountUser" style="cursor: pointer;">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
			<!--logoutModal
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"> Basic Modal </button>-->
              <a class="dropdown-item d-flex align-items-center" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar sidebar_bg">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed navbar_bg" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gear-fill navbar_icon"></i><span>Maintenance</span><i class="bi bi-chevron-down ms-auto" style="color:red !important;"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
						
            <a href="{{ route('switch') }}" class="sidebar_li_a">
              <i class=" bi bi-toggles2 navbar_icon"></i><span>Switch</span>
            </a>
			<?php
			if($data->user_type!="User"){
			?>
			<a href="{{ route('user') }}" class="sidebar_li_a">
              <i class="bi bi-person-lines-fill navbar_icon"></i><span>User</span>
            </a>
			<?php
			}
			?>
          </li>
        </ul>
      </li>
    </ul>

  </aside><!-- End Sidebar-->
  
	<!--Modal to User Profile-->
	<div class="modal fade" id="UserProfileModal" tabindex="-1">
           <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header modal-header_form">
                      <h5 class="modal-title">Account Settings</h5>
					  <div class="btn-group" role="group" aria-label="Basic outlined example">		
						<button type="button" class="btn btn-danger bi bi-x-circle navbar_icon" data-bs-dismiss="modal"></button>
					  </div>
                    </div>
                    <div class="modal-body">

					  <form class="g-2 needs-validation" id="AccountUserform">
					  
						<div class="row mb-2">
						  <label for="account_user_real_name" class="col-sm-3 col-form-label" title="Switch Name">Name:</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" name="account_user_real_name" id="account_user_real_name" value="" required>
							<span class="valid-feedback" id="account_user_real_nameError" title="Required"></span>
						  </div>
						</div>
						
						<div class="row mb-2">
						  <label for="account_user_name" class="col-sm-3 col-form-label">User Name:</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control " name="account_user_name" id="account_user_name" value="" required>
							<span class="valid-feedback" id="account_user_nameError"></span>
						  </div>
						</div>

						<div class="row mb-2">
						  <label for="account_user_password" class="col-sm-3 col-form-label">Password:</label>
						  <div class="col-sm-9">
							<input type="password" placeholder="Optional" class="form-control " name="account_user_password" id="account_user_password" value="">
							<span class="valid-feedback" id="account_user_passwordError"></span>
						  </div>
						</div>
						
						</div>
						
                    <div class="modal-footer modal-footer_form">
						
						  <button type="submit" class="btn btn-success btn-sm bi bi-save-fill navbar_icon" id="account-user"> Submit</button>
						  <!--<button type="reset" class="btn btn-primary btn-sm bi bi-backspace-fill navbar_icon" id="clear-user"> Clear Form</button>-->
						  
					</div>
					</form><!-- End Multi Columns Form -->
                  </div>
                </div>
             </div>

	<!--Modal to User Profile-->
	<div class="modal fade" id="WebPageSettingsTitleModal" tabindex="-1">
           <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header modal-header_form">
                      <h5 class="modal-title">Header Title and Logo Settings</h5>
					  <div class="btn-group" role="group" aria-label="Basic outlined example">		
						<button type="button" class="btn btn-danger bi bi-x-circle navbar_icon" data-bs-dismiss="modal"></button>
					  </div>
                    </div>
                    <div class="modal-body">

					  <form class="g-3 needs-validation" id="WebPageSettingsTitleform" enctype="multipart/form-data" action="{{route('update_web_navigation_header_title_settings_post')}}"  method="post" >
						@csrf
						
						<div class="row">
						
						<div class="col-sm-8">
						
							<div class="form-check mb-3">
							  <input class="form-check-input" type="checkbox" id="default_web_settings" name="default_web_settings" onclick="default_web_settings_action()" title="Click to Enable Editing">
							  <label class="form-check-label" for="default_web_settings">
								Default
							  </label>
							</div>
							 
						</div>
						
						<div class="col-sm-8">
							<div class="col-sm-12">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" aria-describedby="basic-addon1" name="navigation_header_title" id="navigation_header_title" required placeholder="Header Title">
								<label for="order_quantity">Header Title:</label>
								<span class="valid-feedback" id="navigation_header_titleError"></span>
							</div>
							 
						</div>
						
						
						<div class="col-sm-12">
							<div class="form-floating mb-3">
								<input type="number" class="form-control" aria-describedby="basic-addon1" name="header_navigation_width" id="header_navigation_width" required step="1" max="70" placeholder="Logo Size Header">
								<label for="order_quantity">Logo Size Header</label>
								<span class="valid-feedback" id="header_navigation_widthError"></span>
							</div>
							 
						</div>
						
						<div class="col-sm-12">
							<div class="form-floating mb-3">
								<input type="number" class="form-control" aria-describedby="basic-addon1" name="login_page_logo_width" id="login_page_logo_width" required step="1" max="100" placeholder="Logo Size Login Page">
								<label for="order_quantity">Logo Size Login Page</label>
								<span class="valid-feedback" id="order_quantityError"></span>
							</div>
							 
						</div>
						
						<div class="row mb-3">
							<div class="col-sm-12">
							<label for="image_logo" class="form-label">Upload</label>
							<input class="form-control" type="file" id="image_logo" name="image_logo" accept=".jpg, .jepg, .png">
							</div>
						
							
						</div>
						
						</div>
						
						<div class="col-sm-4">
						
								<div class="card">
									<div class="card-body">
									  <h5 class="card-title">Header Logo</h5>
									</div>
									<div class="img-holder card-img-bottom" align="center" id="image_logo_div"></div>
								</div>
								
								<div class="card">
									<div class="card-body">
									  <h5 class="card-title">Login page Logo</h5>
									</div>
									<div class="img-holder_login card-img-bottom" align="center" id="image_logo_div_login"></div>
								</div>
						
						</div>
						
						
						
						</div>
						
						</div>
						
                    <div class="modal-footer modal-footer_form">
						
						  <button type="submit" class="btn btn-success btn-sm bi bi-save-fill navbar_icon" id="header_title_settings_submit"> Submit</button>
						  <!--<button type="reset" class="btn btn-primary btn-sm bi bi-backspace-fill navbar_icon" id="clear-user"> Clear Form</button>-->
						  
					</div>
					</form><!-- End Multi Columns Form -->
                  </div>
                </div>
             </div>


