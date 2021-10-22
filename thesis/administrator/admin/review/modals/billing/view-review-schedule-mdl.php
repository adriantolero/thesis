<div class="modal fade in" id="vw-review-sched-modal" tabindex="-1" role="dialog" aria-labelledby="View Review Schedule" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					Review Schedule
				</h3>
				<button type="button" id="close-createReview" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										Search
									</span>
								</div>
								<input type="text" id="searchReview" class="form-control">
								<div class="input-group-append">
									<button  class="btn btn-success" id="searchReview-btn"><i class="fa fa-search"></i> Search</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<table class="table table-hover table-bordered mt-2">
							<thead>
								<tr class="bg-dark text-white">
									<th id="reviewDescription" style="text-align: center;">Description</th>
									<th id="reviewYear" style="text-align: center;">Year</th>
									<th id="reviewAction" style="text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody id="reviewList-tbl">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->