<!-- Create Schedule Modal -->
<div class="modal fade" id="viewMajorList-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Add School" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			
			<div class="modal-header">
				<h3 class="modal-title">
					<i class="fa fa-list"></i> List of Major
				</h3>
				<button type="button" id="close-viewMajorList-modal" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<div class="row">
					
					<div class="col-md-10 offset-md-1">
						<div class="row">
							<div class="col-md-9">
								<form>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Search</span>
										</div>
										<input type="text" class="form-control	" id="searchMajor">
										<div class="input-group-append">
											<button class="btn btn-success" id="searchMajor-btn"><i class="fa fa-search fa-fw"></i></button>
										</div>	
									</div>
								</form>
							</div>
							<div class="col-md-3">
								<button class="btn btn-success ml-auto" id="addMajor-toggle"><i class="fa fa-plus-circle fa-fw"></i> Add Major</button>
							</div>
						</div>
					</div>

				</div>

				<div class="row mt-2">

					<div class="col-md-10 offset-md-1" style="max-height: 400px;overflow-y: auto;">
						<table class="table table-hover table-bordered">
							<thead class="bg-dark text-white">
								<th id="major" style="width: 30%;text-align: center;">Major</th>
								<th id="majorAction" style="width: 70%;text-align: center;" colspan="2">Action</th>
							</thead>
							<tbody id="tbodyMajorList"> 
								
							</tbody>
						</table>
					</div>

				</div>
				
			</div><!-- modal-body -->

		</div>
	</div>
</div><!-- End Create Review Schedule -->