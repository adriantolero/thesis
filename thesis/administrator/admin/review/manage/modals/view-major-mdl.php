<!-- Create Schedule Modal -->
<div class="modal fade" id="viewMajor-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Add School" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-graduation-cap"></i> View Major
					</h3>
					<button type="button" id="close-viewMajor-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-10 offset-md-1">
						<form>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Major</span>
								</div>
								<input type="text" id="viewMajor" class="form-control" maxlength="50" disabled>
							</div>
							<div id="viewMajor-msg" class="ml-3"></div>
						</form>
					</div>	
				</div>
				<div class="modal-footer">							
					<button class="btn btn-success mr-auto edit" id="viewMajor-btn" style="width: 100%;"><i class="fa fa-edit fa-fw"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->