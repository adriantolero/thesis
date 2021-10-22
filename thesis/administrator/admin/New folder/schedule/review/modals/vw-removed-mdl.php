<div class="modal fade" id="vw-removed-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Removed" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document" id="vw-removed-modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-list"></i> List of removed reviewers
				</h3>
				<button type="button" id="close-removedReviewer" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Search by</span>
						</div>
						<select class="custom-select col-md-2" id="search-removed-reviewer-by" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;">
								<option value="1">Last name</option>
								<option value="2">First name</option>
						</select>
						<input type="text" class="col-md-5 form-control ml-3" id="search-removed-reviewer" placeholder="Last name"  style="border-top-left-radius: 5px;border-bottom-left-radius: 5px;">
						<div class="input-group-append">
							<button class="btn btn-success" id="search-removed-reviewer-btn" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;"><i class="fa fa-search"></i> Search</button>
						</div>
						
					</div>
				</form>
				<div id="removed_reviewer_wrapper">
					<table class="table table-hover table-bordered" id="removed_reviewers">
						<thead class="bg-dark text-white">
							<th id="rem-rev-view">Info.</th>
							<th id="rem-rev-name">Name</th>
							<th id="rem-rev-date">Date Removed</th>
							<th id="rem-rev-action" colspan="2">Action</th>
						</thead>
						<tbody id="removed_reviewer_data">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Create Review Schedule -->