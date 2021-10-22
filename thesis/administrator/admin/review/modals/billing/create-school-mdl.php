<div class="modal fade in" id="create-school-modal" tabindex="-1" role="dialog" aria-labelledby="Create School" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<div class="modal-header bg-dark text-white">
				<h3 class="modal-title">
					Create School
				</h3>
				<button type="button" id="close-createSchool" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i> Name of school</span>
						</div>
						<input type="text" id="create-school" class="form-control">
					</div>
					<div class="ml-3 mb-2" id="create-school-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i> Address</span>
						</div>
						<input type="text" id="create-address" class="form-control">
					</div>
					<div class="ml-3 mb-2" id="create-address-msg">* Required</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-pencil-alt fa-fw"></i> School type</span>
						</div>
						<select type="text" id="create-school-type" class="form-control">
							<option value="0">Non-VSU</option>
							<option value="1">VSU</option>
						</select>
					</div>
					<div style="position: relative;padding-top: 3px;padding-bottom: 3px;height: 3em;width: 100%;">
						<button class="btn btn-success" id="save"><i class="fa fa-save"></i> Save</button>
					</div>
				</form>
			</div><!-- modal-body-->
		</div>
	</div>
</div><!-- End Create Review Schedule -->