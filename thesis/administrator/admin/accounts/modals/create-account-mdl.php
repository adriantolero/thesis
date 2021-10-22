<div class="modal fade" id="createAccount-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Account" aria-hidden="true">
	<div class="modal-dialog" role="document"><!--  data-backdrop="static" data-keyboard="false"-->
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-plus-circle"></i> Create Account
					</h3>
					<button type="button" id="close-createAccount-modal" class="close" data-dismiss="modal" aria-label="Close" style="/*color: white;*/">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">username</span>
						</div>
						<input type="text" id="create-username" class="form-control">
					</div>
					<div class="ml-3" id="create-username-msg"></div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">password</span>
						</div>
						<input type="password" id="create-password" class="form-control">
					</div>
					<div class="ml-3" id="create-password-msg"></div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Name</span>
						</div>
						<input type="text" class="form-control col-md-5" id="create-fname" placeholder="First name">
						<input type="text" class="form-control col-md-2" id="create-mi" placeholder="M.I" maxlength="2">
						<input type="text" class="form-control col-md-5" id="create-lname" placeholder="Last name">
					</div>
					<div class="ml-3" id="create-name-msg"></div>

					<center>
						<div class="form-check">
						  	<input class="form-check-input" type="checkbox" value="" id="create-showpassword">
						  	<label class="form-check-label" for="create-showpassword">
						    	Show password
						  	</label>
						</div>
					</center>

				</div>
				<div class="modal-footer">							
					<button class="btn btn-success" id="create-account-submit-btn" style="width: 100%;"><i class="fa fa-save fa-fw"></i> Submit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->