<!-- Create Schedule Modal -->
<div class="modal fade" id="view-addCourse-modal" tabindex="-1" role="dialog" aria-labelledby="Add Course" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header">
					<h3 class="modal-title">
						<i class="fa fa-user-plus"></i> Add Course
					</h3>
					<button type="button" id="close-view-addCourse-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-md-8 offset-md-2">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">Course</span>
							</div>
							<input type="text" class="form-control" id="view-addCourse" maxlength="50">
						</div>
						<div id="view-addCourse-msg" class="ml-3"></div>
						<!--
						<div class="input-group mt-2">
							<div class="input-group-prepend">
								<span class="input-group-text">Major</span>
							</div>
							<input type="text" class="form-control" id="addMajor1" maxlength="50">
						</div>
						<div id="addMajor1-msg" class="ml-3"></div>		
					-->
					</div>
				</div>
				<div class="modal-footer">							
					<button class="btn btn-success mr-auto" id="view-addCourse-btn" style="width: 100%;"><i class="fa fa-plus-circle"></i> Add</button>
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->