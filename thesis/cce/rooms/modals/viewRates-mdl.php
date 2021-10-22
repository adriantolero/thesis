<!-- Create Schedule Modal -->
<div class="modal fade" id="viewRates-modal" data-id tabindex="-1" role="dialog" aria-labelledby="Add Request" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content bg-dark text-white">
			<form>
				<div class="modal-header" style="text-align: center;">
					<h3 class="modal-title">Rates</h3>
					<button type="button" id="close-viewRates-modal" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="card" style="height: 400px;overflow-y: auto;">
								<table class="table table-hover table-bordered"> 
									<thead>
										<th style="text-align: center;width: 16.67%">Category</th>
										<th style="text-align: center;width: 16.67%">Description</th>
										<th style="text-align: center;width: 16.67%">Aircon</th>
										<th style="text-align: center;width: 16.67%">First Hour Rate</th>
										<th style="text-align: center;width: 16.67%">Succeeding Hour Rate</th>
									</thead>
									<tbody id="tbodyRates">
										
									</tbody>
								</table>
							</div>
						</div>
					</div>			
				</div>
			</form>
		</div>
	</div>
</div><!-- End Create Review Schedule -->