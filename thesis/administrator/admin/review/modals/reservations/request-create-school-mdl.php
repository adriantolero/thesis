<!-- Create Schedule Modal -->
<div class="modal fade" id="request-addSchool-modal" tabindex="-1" role="dialog" aria-labelledby="Add School" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-university"></i> Add School
					</h3>
					<button type="button" id="close-addSchool-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-10 offset-md-1">
						
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">School</span>
							</div>
							<input type="text" id="request-addSchool" class="form-control" maxlength="50">
						</div>
						<div id="request-addSchool-msg" class="ml-3"></div>

						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Address</span>
							</div>
							<input type="text" id="request-addSchoolAddress" class="form-control" maxlength="100">
						</div>
						<div id="request-addSchoolAddress-msg" class="ml-3"></div>

						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text">School type</span>
							</div>
							<select class="custom-select" id="request-addSchoolType">
								<option value="1">VSU</option>
								<option value="0">Non-VSU</option>
							</select>
						</div>
						
					</div>	
				</div>
				<div class="modal-footer">							
					<button class="btn btn-success mr-auto" id="request-addSchool-btn" style="width: 100%;"><i class="fa fa-plus-circle"></i> Add</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->