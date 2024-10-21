@extends('layouts.layout')  
@section('content')  

<main id="main" class="main">	
    <section class="section">
	
          <div class="card">
		  
			  <div class="card card-12-btm">
			  
				<div class="card-header" style="text-align:center;">
                             
				  
				  <div class="row">
					
						  <div class="col-sm-12">
						  
						  <h5 class="card-title bi bi-person-lines-fill">&nbsp;{{ $title }}</h5>    
						  <!--OPTIONS HERE-->
							<div class="d-flex justify-content-end" id="user_option"></div>
						  </div>
						  
						  
						</div>
				  
				  </div>
				</div>			  
		 
            <div class="card-body">
				
				<div class="p-d3">
									<div class="table-responsive">
										<table class="table table-bordered dataTable" id="userList" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>#</th>
													<th nowrap>Real Name</th>
													<th nowrap>User Name</th>
													<th>User Type</th>
													<th>Date Created</th>
													<th>Date Updated</th>	
													<th>Action</th>
												</tr>
											</thead>				
											
											<tbody>
												
											</tbody>
											
											<tfoot>
												<tr>
													<th>#</th>
													<th nowrap>Real Name</th>
													<th nowrap>User Name</th>
													<th>User Type</th>
													<th>Date Created</th>
													<th>Date Updated</th>
													<th>Action</th>
												</tr>
											</tfoot>	
										</table>
									</div>		
				</div>									
                   
            </div>
          </div>

<!--Switch Notice-->
	<div id="switch_notice_off" style="display: none;">
		<div class="switch_notice_background" align="center">
			<!--OFF-->
			<div class="switch_off_content" style="display: block;">
				<strong id="sw_off">[Switch Name] OFF</strong>
			</div>
		</div>
	</div>

	<div id="switch_notice_on" style="display: none;">
		<div class="switch_notice_background" align="center">
			<!--OFF-->
			<div class="switch_on_content" style="display: block;">
				<strong id="sw_on">[Switch Name] ON</strong>
			</div>
		</div>
	</div>	
	
	<!-- Switch Delete Modal-->
    <div class="modal fade" id="UserDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header header_modal_bg">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
 					<div class="btn-sm btn-warning btn-circle bi bi-exclamation-circle btn_icon_modal"></div>
                </div>
                <div class="modal-body warning_modal_bg" id="modal-body">
				Are you sure you want to Delete this User?</div>
				<div style="margin:10px;">
				User Real Name: <span id="user_real_name_info_confirm"></span><br>
				Username: <span id="user_name_info_confirm"></span><br>
				User Type: <span id="user_type_info_confirm"></span><br>
				</div>
                <div class="modal-footer footer_modal_bg">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-x-circle navbar_icon"></i> Cancel</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="deleteUserConfirmed" value=""><i class="bi bi-trash3 navbar_icon"></i> Delete</button>
                  
                </div>
            </div>
        </div>
    </div>	

	<!-- Switch Delete Modal-->
    <div class="modal fade" id="UserDeleteModalConfirmed" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header header_modal_bg">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
 					<div class="btn-sm btn-warning btn-circle bi bi-exclamation-circle btn_icon_modal"></div>
                </div>
                <div class="modal-body warning_modal_bg" id="modal-body">Successfully Deleted!</div>
				<div style="margin:10px;">
				User Real Name: <span id="user_real_name_info_confirmed"></span><br>
				Username: <span id="user_name_info_confirmed"></span><br>
				User Type: <span id="user_type_info_confirmed"></span><br>
				</div>
                <div class="modal-footer footer_modal_bg">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-x-circle navbar_icon"></i> Close</button>
					     
                </div>
            </div>
        </div>
    </div>

	
	<!--Modal to Create User-->
	<div class="modal fade" id="CreateUserModal" tabindex="-1">
           <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header modal-header_form">
                      <h5 class="modal-title">Create User</h5>
					  <div class="btn-group" role="group" aria-label="Basic outlined example">		
						<button type="button" class="btn btn-danger bi bi-x-circle navbar_icon" data-bs-dismiss="modal"></button>
					  </div>
                    </div>
                    <div class="modal-body">

					  <form class="g-2 needs-validation" id="CreateUserform">
					  
						<div class="row mb-2">
						  <label for="user_real_name" class="col-sm-3 col-form-label" title="Switch Name">Name:</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" name="user_real_name" id="user_real_name" value="" required>
							<span class="valid-feedback" id="user_real_nameError" title="Required"></span>
						  </div>
						</div>
						
						<div class="row mb-2">
						  <label for="user_name" class="col-sm-3 col-form-label">User Name:</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control " name="user_name" id="user_name" value="" required>
							<span class="valid-feedback" id="user_nameError"></span>
						  </div>
						</div>

						<div class="row mb-2">
						  <label for="user_password" class="col-sm-3 col-form-label">Password:</label>
						  <div class="col-sm-9">
							<input type="password" class="form-control " name="user_password" id="user_password" value="" required>
							<span class="valid-feedback" id="user_passwordError"></span>
						  </div>
						</div>
					
						<div class="row mb-2">
						  <label for="user_type" class="col-sm-3 col-form-label">User Type:</label>
						  <div class="col-sm-9">
								<select class="form-select form-control" required="" name="user_type" id="user_type">
								<option selected="" disabled="" value="">Choose...</option>
								<option value="Admin">Admin</option>
								<option value="User">User</option>
								</select>
							<span class="valid-feedback" id="user_typeError"></span>
						  </div>
						</div>	
						
						</div>
						
                    <div class="modal-footer modal-footer_form">
						
						  <button type="submit" class="btn btn-success btn-sm bi bi-save-fill navbar_icon" id="save-user"> Submit</button>
						  <button type="reset" class="btn btn-primary btn-sm bi bi-backspace-fill navbar_icon" id="clear-user"> Clear Form</button>
						  
					</div>
					</form><!-- End Multi Columns Form -->
                  </div>
                </div>
                  </div>
	
	<!--Modal to Create User-->
	<div class="modal fade" id="UpdateUserModal" tabindex="-1">
           <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header modal-header_form">
                      <h5 class="modal-title">Update User</h5>
					  <div class="btn-group" role="group" aria-label="Basic outlined example">		
						<button type="button" class="btn btn-danger bi bi-x-circle navbar_icon" data-bs-dismiss="modal"></button>
					  </div>
                    </div>
                    <div class="modal-body">

					  <form class="g-2 needs-validation" id="UpdateUserform">
					  
						<div class="row mb-2">
						  <label for="update_user_real_name" class="col-sm-3 col-form-label" title="Switch Name">Name:</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" name="update_user_real_name" id="update_user_real_name" value="" required>
							<span class="valid-feedback" id="update_user_real_nameError" title="Required"></span>
						  </div>
						</div>
						
						<div class="row mb-2">
						  <label for="update_user_name" class="col-sm-3 col-form-label">User Name:</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control " name="update_user_name" id="update_user_name" value="" required>
							<span class="valid-feedback" id="update_user_nameError"></span>
						  </div>
						</div>

						<div class="row mb-2">
						  <label for="update_user_password" class="col-sm-3 col-form-label">Password:</label>
						  <div class="col-sm-9">
							<input type="password" placeholder="Optional" class="form-control " name="update_user_password" id="update_user_password" value="">
							<span class="valid-feedback" id="update_user_passwordError"></span>
						  </div>
						</div>
					
						<div class="row mb-2">
						  <label for="update_user_type" class="col-sm-3 col-form-label">User Type:</label>
						  <div class="col-sm-9">
								<select class="form-select form-control" required="" name="update_user_type" id="update_user_type">
								<option selected="" disabled="" value="">Choose...</option>
								<option value="Admin">Admin</option>
								<option value="User">User</option>
								</select>
							<span class="valid-feedback" id="update_user_typeError"></span>
						  </div>
						</div>	
						
						</div>
						
                    <div class="modal-footer modal-footer_form">
						
						  <button type="submit" class="btn btn-success btn-sm bi bi-save-fill navbar_icon" id="update-user"> Submit</button>
						  <!--<button type="reset" class="btn btn-primary btn-sm bi bi-backspace-fill navbar_icon" id="clear-user"> Clear Form</button>-->
						  
					</div>
					</form><!-- End Multi Columns Form -->
                  </div>
                </div>
                  </div>
	
	<!--Modal for Switch Information-->
	<div class="modal fade" id="InfoSwitchModal" tabindex="-1">
           <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header modal-header_form">
                      <h5 class="modal-title">Switch Information</h5>
					  <div class="btn-group" role="group" aria-label="Basic outlined example">		
						<button type="button" class="btn btn-danger bi bi-x-circle navbar_icon" data-bs-dismiss="modal"></button>
					  </div>
                    </div>
                    <div class="modal-body">

						<ol class="list-group list-group-numbered">
						<li class="list-group-item d-flex justify-content-between align-items-start">
						  <div class="ms-2 me-auto">
							<div class="fw-bold">Switch Name</div>
							<div id="info_switch_name"></div>
						  </div>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
						  <div class="ms-2 me-auto">
							<div class="fw-bold">Time</div>
							<div id="info_switch_schedule"></div>
						  </div>
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
						  <div class="ms-2 me-auto">
							<div class="fw-bold">Module ID</div>
							<div id="info_switch_module_id"></div>
						  </div>
						  
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
						  <div class="ms-2 me-auto">
							<div class="fw-bold">Relay Number</div>
							<div id="info_switch_relay_no"></div>
						  </div>
						  
						</li>
						<li class="list-group-item d-flex justify-content-between align-items-start">
						  <div class="ms-2 me-auto">
							<div class="fw-bold">Panel Name</div>
							<div id="info_switch_panel_name"></div>
						  </div>
						  
						</li>
						</ol>
						
                  </div>
                </div>
                </div>
    </section>
</main>


@endsection

