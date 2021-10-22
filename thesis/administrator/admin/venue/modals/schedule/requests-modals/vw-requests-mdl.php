<!-- Create Schedule Modal -->
<div class="modal fade" id="viewRequests-modal" data-id tabindex="-1" role="dialog" aria-labelledby="View Requests" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-list-alt"></i> List of Requests
				</h3>
				<button type="button" id="close-addFunctionSched-modal" class="close" data-dismiss="modal" aria-label="Close">
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
										<button class="btn btn-outline-success dropdown-toggle" id="searchRequest-category" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-id=1>Search by</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" id="searchBy-desc-request" href="#">Description</a>
											<a class="dropdown-item" id="searchBy-name-request" href="#">Organizer</a>
											<a class="dropdown-item" id="searchBy-date-request" href="#">Date</a>
										</div>
										<!--<span class="input-group-text">Search</span>-->
									</div>
									<input type="text" class="form-control col-md-3" id="searchRequest" placeholder="Description" style="border-top-right-radius: 5px;border-bottom-right-radius: 5px">
									<div class="input-group-append ml-3">
										<button class="btn btn-success" id="searchRequest-btn"  style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;"><i class="fa fa-search"></i> Search</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div><!-- row -->

				<div class="row">
					<div class="col-md-12" id="schedule-table-wrapper">
						<table class="table table-hover table-bordered" id="tableSched-request">
							<thead class="bg-dark text-white">
								<th id="requestRoom">Room</th>
								<th id="requestDescription">Description</th>
								<th id="requestStart">Arrival(Date & Time)</th>
								<th id="requestEnd">Departure(Date & Time)</th>
								<th id="requestRequisitioner">Organizer</th>
								<th id="requestDateReserved">Date requested</th>
								<th id="requestTimeLeft">Time remaining</th>
								<th id="requestActions" colspan="3">Actions</th>
							</thead>
							<tbody id="tbodySched-request">
								
							</tbody>
						</table>
					</div>
				</div>

				<div class="row mt-4">
					<div class="col-md-8 offset-md-2">
						<center>
							<button type="button" class="btn btn-success" id="addRequest-toggle-modal" data-toggle="modal" data-target="#addRequest-modal"><i class="fa fa-plus-circle"></i> Add Request</button>
							<button type="button" class="btn btn-success" id="viewReject-toggle-modal" data-toggle="modal" data-target="#viewReject-modal"><i class="fa fa-search"></i> View Rejected Request</button>
						</center>
					</div>	
				</div>

			</div><!-- modal-body -->
		</div>
	</div>
</div><!-- End Create Review Schedule -->