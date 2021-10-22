<div class="modal fade" id="vw-rej-requests-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Rejected Requests" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document" id="vw-rej-requests-modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-list"></i> Rejected Reservations List
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
						<select class="custom-select col-md-3" id="search-reviewer-reject-request-by" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
							<option value="1">Last name</option>
							<option value="2">First name</option>
						</select>
						<input type="text" class="col-md-5 form-control ml-3" id="search-reviewer-reject-requests" placeholder="Last name"  style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
						<div class="input-group-append">
							<button class="btn btn-success" id="search-reviewer-reject-requests-btn" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;"><i class="fa fa-search"></i> Search</button>
						</div>
					</div>
				</form>
				<table class="table table-hover table-bordered">
					<thead class="bg-dark text-white">
						<th><center>View</center></th>
						<th><center>Name</center></th>
						<!--<th><center>Date Rejected</center></th>-->
						<th colspan="2"><center>Actions</center></th>
					</thead>
					<tbody id="rejected-reviewer-lists">
						
					</tbody>
				</table>
			</div>
			<div class="modal-footer">	
				
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->