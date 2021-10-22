<!-- Create Schedule Modal -->
<div class="modal fade" id="viewReject-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Rejected Requests" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-list-alt"></i> List of Rejected Requests
				</h3>
				<button type="button" id="close-viewReject-modal" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-12 mt-4">
						<form>
							<div class="col-md-12">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<button class="btn btn-outline-success dropdown-toggle" id="searchReject-category" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id=1>Search by</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" id="searchBy-desc-reject" href="#">Description</a>
											<a class="dropdown-item" id="searchBy-name-reject" href="#">Organizer</a>
											<a class="dropdown-item" id="searchBy-date-reject" href="#">Date</a>
										</div>
										<!--<span class="input-group-text">Search</span>-->
									</div>
									<input type="text" class="form-control col-md-3" id="searchReject" placeholder="Description" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px">
									<div class="input-group-append ml-3">
										<button class="btn btn-success" id="searchReject-btn"  style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;"><i class="fa fa-search"></i> Search</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div><!-- row -->

				<div class="row">
					<div class="col-md-12" id="schedule-table-wrapper">
						<table class="table table-hover table-bordered" id="tableSched-reject">
							<thead class="bg-dark text-white">
								<th id="rejectRoom">Room</th>
								<th id="rejectDescription">Description</th>
								<th id="rejectStart">Arrival(Date & Time)</th>
								<th id="rejectEnd">Departure(Date & Time)</th>
								<th id="rejectRequisitioner">Organizer</th>
								<th id="rejectDateReserved">Date requested</th>
								<th id="rejectActions" colspan="2">Actions</th>
							</thead>
							<tbody id="tbodySched-reject">
								
							</tbody>
						</table>
					</div>
				</div>
			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- End Create Review Schedule -->