<div class="modal fade" id="viewRate-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Rate" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-search fa-fw"></i> View Rate
					</h3>
					<button type="button" id="close-viewRate-modal" class="close" data-dismiss="modal" aria-label="Close" style="/*color: white;*/">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<span class="input-group-text">First Hour Rate</span>
						</div>
						<input type="text" id="firstHour" class="form-control" placeholder="0" disabled>
					</div>
					<div class="ml-3" id="firstHour-msg"></div>

					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Succeeding Hour Rate</span>
						</div>
						<input type="text" id="succeedingHour" class="form-control" placeholder="0" disabled>
					</div>
					<div class="ml-3" id="succeedingHour-msg"></div>

				</div>
				<div class="modal-footer">							
					<button class="btn btn-success edit" id="editRate-btn" style="width: 100%;"><i class="fa fa-edit fa-fw"></i> Edit</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->