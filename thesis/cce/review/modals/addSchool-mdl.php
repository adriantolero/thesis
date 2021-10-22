<!-- Create Schedule Modal -->
<div class="modal fade" id="addSchool-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Add Schedule" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<form>
			<div class="modal-content bg-dark text-white">
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-plus-circle"></i> Add School
					</h3>
					<button type="button" id="close-addReviewer-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">School</span>
						</div>
						<input type="text" id="addSchool" class="form-control" placeholder="School name" maxlength="50">
					</div>
					<div id="addSchool-msg" class="ml-3"></div>

					<div class="input-group mt-2">
						<div class="input-group-prepend">
							<span class="input-group-text">Address</span>
						</div>
						<input type="text" id="addSchool-address" class="form-control" placeholder="School Address" maxlength="100">
					</div>
					<div id="addSchool-address-msg" class="ml-3"></div>
				</div>
				
				<div class="modal-footer">							
					<button class="btn btn-success mr-auto" id="addSchool-submit" style="width: 100%;"><i class="fa fa-plus-circle"></i> Add</button>
				</div>
			</div>
		</form>
	</div>
</div><!-- End Create Review Schedule -->