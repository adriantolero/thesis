<div class="modal fade" id="vw-requests-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Requests" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document" id="vw-requests-modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-list"></i> Reservation Approval
				</h3>
				<button type="button" id="close-createReview" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Search by</span>
						</div>
						<select class="custom-select col-md-2" id="search-reviewer-requests-by" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
								<option value="1">Last name</option>
								<option value="2">First name</option>
						</select>
						<input type="text" class="col-md-5 form-control ml-3" id="search-reviewer-requests" placeholder="Last name"  style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
						<div class="input-group-append">
							<button class="btn btn-success" id="search-reviewer-requests-btn" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;"><i class="fa fa-search"></i> Search</button>
						</div>
						
					</div>
				</form>
				<div id="reviewer_requests_wrapper">
					<table class="table table-hover table-bordered" id="reviewer_requests">
						<thead class="bg-dark text-white">
							<th id="rev-view">Info.</th>
							<th id="rev-name">Name</th>
							<th id="rev-date">Date Requested</th>
							<th id="rev-days-left">Time Remaining</th>
							<th id="rev-action" colspan="2">Action</th>
						</thead>
						<tbody id="reviewer_requests_data">
							
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">	
				<div id="btn-request-wrapper">								
					<button type="button" class="btn btn-success" id='addRequest' data-toggle="modal" data-target="#addRequest-modal"><i class="fa fa-user-plus"></i> Add Request</button>
					<button type="button" class="btn btn-success" id='vw-reject-request' data-toggle="modal" data-target="#vw-rej-requests-modal"><i class="fa fa-users"></i> View Rejected Request</button>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->