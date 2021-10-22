<!-- Create Schedule Modal -->
<div class="modal fade" id="addMajor-modal" tabindex="-1" role="dialog" aria-labelledby="Add Major" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-user-plus"></i> Add Major
					</h3>
					<button type="button" id="close-addMajor-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-8 offset-md-2">
						
						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Major</span>
							</div>
							<input type="text" class="form-control col-md-7" id="addMajor2" maxlength="50">
						</div>
						<div id="addMajor2-msg" class="ml-3"></div>
					
					</div>
				</div>
				<div class="modal-footer">							
					<button class="btn btn-success mr-auto" id="addMajor-submit" style="width: 100%;"><i class="fa fa-plus-circle"></i> Add</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->