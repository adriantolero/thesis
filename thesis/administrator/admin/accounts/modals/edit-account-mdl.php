<!-- Create Schedule Modal -->
<div class="modal fade" id="editAccount-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Create Account" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-edit fa-fw"></i> Edit Account
					</h3>
					<button type="button" id="close-editAccount-modal" class="close" data-dismiss="modal" aria-label="Close" style="/*color: white;*/">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">username</span>
						</div>
						<input type="text" id="edit-username" class="form-control" disabled>
					</div>
					<div class="ml-3" id="edit-username-msg"></div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">password</span>
						</div>
						<input type="password" id="edit-password" class="form-control" disabled>
					</div>
					<div class="ml-3" id="edit-password-msg"></div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Name</span>
						</div>
						<input type="text" class="form-control col-md-5" id="edit-fname" placeholder="First name" disabled>
						<input type="text" class="form-control col-md-2" id="edit-mi" placeholder="M.I" maxlength="2" disabled>
						<input type="text" class="form-control col-md-5" id="edit-lname" placeholder="Last name" disabled>
					</div>
					<div class="ml-3" id="edit-name-msg"></div>

					<center>
						<div class="form-check">
						  	<input class="form-check-input" type="checkbox" value="" id="edit-showpassword" disabled>
						  	<label class="form-check-label" for="edit-showpassword">
						    	Show password
						  	</label>
						</div>
					</center>

				</div>
				<div class="modal-footer">							
					<button class="btn btn-success edit" id="edit-account-submit-btn" style="width: 100%;"><i class="fa fa-edit fa-fw"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->