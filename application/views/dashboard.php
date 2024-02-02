<div class="row">
	<div class="col-sm-12 mb-4 mb-xl-0">
		<h4 class="font-weight-bold text-dark">Hi, welcome back!</h4>
		<p class="font-weight-normal mb-2 text-muted">APRIL 1, 2019</p>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-xl-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Customers</h4>
				<h4 class="text-dark font-weight-bold mb-2">43,981</h4>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Orders</h4>
				<h4 class="text-dark font-weight-bold mb-2">55,543</h4>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Orders</h4>
				<h4 class="text-dark font-weight-bold mb-2">55,543</h4>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-xl-3 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Orders</h4>
				<h4 class="text-dark font-weight-bold mb-2">55,543</h4>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3">
	<div class="col-xl-3 flex-column d-flex grid-margin stretch-card">
		<div class="row flex-grow">
			<div class="col-sm-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Customers</h4>
						<h4 class="text-dark font-weight-bold mb-2">43,981</h4>
					</div>
				</div>
			</div>
			<div class="col-sm-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Customers</h4>
						<h4 class="text-dark font-weight-bold mb-2">43,981</h4>
					</div>
				</div>
			</div>
			<div class="col-sm-12 stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Orders</h4>
						<h4 class="text-dark font-weight-bold mb-2">55,543</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-9 d-flex grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Transaksi Marketstore Tahun <?= date('Y') ?></h4>
				<div class="row">
					<div class="col-lg-5">
						<p>Total penghasilan transaksi tiap bulan. Total penghasilan sampai saat ini ada di samping:</p>
					</div>
					<div class="col-lg-7">
						<div class="chart-legends d-lg-block d-none" id="chart-legends"></div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<canvas id="web-transaksi-metrics-satacked" class="mt-3"></canvas>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-between mb-3">
					<h4 class="card-title">Market Trends</h4>
					<div class="dropdown">
						<button class="btn btn-sm dropdown-toggle text-dark pt-0 pr-0" type="button"
							id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false">
							This week
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
							<h6 class="dropdown-header">This week</h6>
							<h6 class="dropdown-header">This month</h6>
						</div>
					</div>
				</div>
				<div id="chart-legends-market-trend" class="chart-legends mt-1">
				</div>
				<div class="row mt-2 mb-2">
					<div class="col-6">
						<div class="text-small"><span class="text-success">18.2%</span> higher
						</div>
					</div>
					<div class="col-6">
						<div class="text-small"><span class="text-danger">0.7%</span> higher </div>
					</div>
				</div>
				<div class="marketTrends mt-4">
					<canvas id="marketTrendssatacked"></canvas>
				</div>

			</div>
		</div>
	</div>
	<div class="col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Traffic Sources</h4>
				<div class="row">
					<div class="col-sm-12">
						<div class="d-flex justify-content-between mt-2 text-dark mb-2">
							<div><span class="font-weight-bold">4453</span> Leads</div>
							<div>Goal: 2000</div>
						</div>
						<div class="progress progress-md grouped mb-2">
							<div class="progress-bar  bg-danger" role="progressbar" style="width: 30%"
								aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							<div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="50"
								aria-valuemin="0" aria-valuemax="100"></div>
							<div class="progress-bar  bg-primary" role="progressbar" style="width: 10%"
								aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
							<div class="progress-bar bg-warning" role="progressbar" style="width: 10%"
								aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
							<div class="progress-bar bg-success" role="progressbar" style="width: 5%" aria-valuenow="50"
								aria-valuemin="0" aria-valuemax="100"></div>
							<div class="progress-bar bg-light" role="progressbar" style="width: 25%" aria-valuenow="50"
								aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="traffic-source-legend">
							<div class="d-flex justify-content-between mb-1 mt-2">
								<div class="font-weight-bold">SOURCE</div>
								<div class="font-weight-bold">TOTAL</div>
							</div>
							<div class="d-flex justify-content-between legend-label">
								<div><span class="bg-danger"></span>Google Search</div>
								<div>30%</div>
							</div>
							<div class="d-flex justify-content-between legend-label">
								<div><span class="bg-info"></span>Social Media</div>
								<div>20%</div>
							</div>
							<div class="d-flex justify-content-between legend-label">
								<div><span class="bg-primary"></span>Referrals</div>
								<div>10%</div>
							</div>
							<div class="d-flex justify-content-between legend-label">
								<div><span class="bg-warning"></span>Organic Traffic</div>
								<div>10%</div>
							</div>
							<div class="d-flex justify-content-between legend-label">
								<div><span class="bg-success"></span>Google Search</div>
								<div>5%</div>
							</div>
							<div class="d-flex justify-content-between legend-label">
								<div><span class="bg-light"></span>Email Marketing</div>
								<div>25%</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-4 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title mb-3">Recent Activity</h4>
				<div class="row">
					<div class="col-sm-12">
						<div class="text-dark">
							<div class="d-flex pb-3 border-bottom justify-content-between">
								<div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
								<div class="font-weight-bold mr-sm-4">
									<div>Deposit has updated to Paid</div>
									<div class="text-muted font-weight-normal mt-1">32 Minutes Ago
									</div>
								</div>
								<div>
									<h6 class="font-weight-bold text-info ml-sm-2">$325</h6>
								</div>
							</div>
							<div class="d-flex pb-3 pt-3 border-bottom justify-content-between">
								<div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
								<div class="font-weight-bold mr-sm-4">
									<div>Your Withdrawal Proceeded</div>
									<div class="text-muted font-weight-normal mt-1">45 Minutes Ago
									</div>
								</div>
								<div>
									<h6 class="font-weight-bold text-info ml-sm-2">$4987</h6>
								</div>
							</div>
							<div class="d-flex pb-3 pt-3 border-bottom justify-content-between">
								<div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
								<div class="font-weight-bold mr-sm-4">
									<div>Deposit has updated to Paid </div>
									<div class="text-muted font-weight-normal mt-1">1 Days Ago</div>
								</div>
								<div>
									<h6 class="font-weight-bold text-info ml-sm-2">$5391</h6>
								</div>
							</div>
							<div class="d-flex pt-3 justify-content-between">
								<div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
								<div class="font-weight-bold mr-sm-4">
									<div>Deposit has updated to Paid</div>
									<div class="text-muted font-weight-normal mt-1">3 weeks Ago
									</div>
								</div>
								<div>
									<h6 class="font-weight-bold text-info ml-sm-2">$264</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-9 grid-margin-lg-0 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Top Sellers</h4>
				<div class="table-responsive mt-3">
					<table class="table table-header-bg">
						<thead>
							<tr>
								<th>
									Country
								</th>
								<th>
									Revenue
								</th>
								<th>
									Vs Last Month
								</th>
								<th>
									Goal Reached
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<i class="flag-icon flag-icon-us mr-2" title="us" id="us"></i>
									United States
								</td>
								<td>
									$911,200
								</td>
								<td>
									<div class="text-success"><i class="icon-arrow-up mr-2"></i>+60%
									</div>
								</td>
								<td>
									<div class="row">
										<div class="col-sm-10">
											<div class="progress">
												<div class="progress-bar bg-info" role="progressbar" style="width: 25%"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-sm-2">
											25%
										</div>
									</div>
								</td>

							</tr>
							<tr>
								<td>
									<i class="flag-icon flag-icon-at mr-2" title="us" id="at"></i>
									Austria
								</td>
								<td>
									$821,600
								</td>
								<td>
									<div class="text-danger"><i class="icon-arrow-down mr-2"></i>-40%</div>
								</td>
								<td>
									<div class="row">
										<div class="col-sm-10">
											<div class="progress">
												<div class="progress-bar bg-info" role="progressbar" style="width: 50%"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-sm-2">
											50%
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<i class="flag-icon flag-icon-fr mr-2" title="us" id="fr"></i>
									France
								</td>
								<td>
									$323,700
								</td>
								<td>
									<div class="text-success"><i class="icon-arrow-up mr-2"></i>+40%
									</div>
								</td>
								<td>
									<div class="row">
										<div class="col-sm-10">
											<div class="progress">
												<div class="progress-bar bg-info" role="progressbar" style="width: 10%"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-sm-2">
											10%
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="py-1">
									<i class="flag-icon flag-icon-de mr-2" title="us" id="de"></i>
									Germany
								</td>
								<td>
									$833,205
								</td>
								<td>
									<div class="text-danger"><i class="icon-arrow-down mr-2"></i>-80%</div>
								</td>
								<td>
									<div class="row">
										<div class="col-sm-10">
											<div class="progress">
												<div class="progress-bar bg-info" role="progressbar" style="width: 70%"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-sm-2">
											70%
										</div>
									</div>
								</td>
							</tr>
							<tr>
								<td class="pb-0">
									<i class="flag-icon flag-icon-ae mr-2" title="ae" id="ae"></i>
									united arab emirates
								</td>
								<td class="pb-0">
									$232,243
								</td>
								<td class="pb-0">
									<div class="text-success"><i class="icon-arrow-up mr-2"></i>+80%
									</div>
								</td>
								<td class="pb-0">
									<div class="row">
										<div class="col-sm-10">
											<div class="progress">
												<div class="progress-bar bg-info" role="progressbar" style="width: 60%"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="col-sm-2">
											0%
										</div>
									</div>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-3 grid-margin-lg-0 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title mb-3">Overall rating</h4>
				<div class="d-flex">
					<div>
						<h4 class="text-dark font-weight-bold mb-2 mr-2">4.3</h4>
					</div>
					<div>
						<select id="over-all-rating" name="rating" autocomplete="off">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div>
				<p class="mb-4">Based on 186 reviews</p>
				<div class="row">
					<div class="col-sm-2 pr-0">
						<div class="d-flex">
							<div>
								<div class="text-dark font-weight-bold mb-2 mr-2">5</div>
							</div>
							<div>
								<i class="fa fa-star text-warning"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-9 pl-2">
						<div class="row">
							<div class="col-sm-10">
								<div class="progress progress-lg mt-1">
									<div class="progress-bar bg-warning" role="progressbar" style="width: 80%"
										aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col-sm-2 p-lg-0">
								80%
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-2 pr-0">
						<div class="d-flex">
							<div>
								<div class="text-dark font-weight-bold mb-2 mr-2">4</div>
							</div>
							<div>
								<i class="fa fa-star text-warning"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-9 pl-2">
						<div class="row">
							<div class="col-sm-10">
								<div class="progress progress-lg mt-1">
									<div class="progress-bar bg-warning" role="progressbar" style="width: 45%"
										aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col-sm-2 p-lg-0">
								45%
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-2 pr-0">
						<div class="d-flex">
							<div>
								<div class="text-dark font-weight-bold mb-2 mr-2">3</div>
							</div>
							<div>
								<i class="fa fa-star text-warning"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-9 pl-2">
						<div class="row">
							<div class="col-sm-10">
								<div class="progress progress-lg mt-1">
									<div class="progress-bar bg-warning" role="progressbar" style="width: 30%"
										aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col-sm-2 p-lg-0">
								30%
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-2 pr-0">
						<div class="d-flex">
							<div>
								<div class="text-dark font-weight-bold mb-2 mr-2">2</div>
							</div>
							<div>
								<i class="fa fa-star text-warning"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-9 pl-2">
						<div class="row">
							<div class="col-sm-10">
								<div class="progress progress-lg mt-1">
									<div class="progress-bar bg-warning" role="progressbar" style="width: 8%"
										aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col-sm-2 p-lg-0">
								8%
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-sm-2 pr-0">
						<div class="d-flex">
							<div>
								<div class="text-dark font-weight-bold mb-2 mr-2">5</div>
							</div>
							<div>
								<i class="fa fa-star text-warning"></i>
							</div>
						</div>
					</div>
					<div class="col-sm-9 pl-2">
						<div class="row">
							<div class="col-sm-10">
								<div class="progress progress-lg mt-1">
									<div class="progress-bar bg-warning" role="progressbar" style="width: 1%"
										aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col-sm-2 p-lg-0">
								1%
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<p class="mb-2 mt-3 mb-3 text-dark font-weight-bold">Rating by category</p>
						<div class="d-flex">
							<div>
								<div class="text-dark font-weight-bold mb-2 mr-2">4.3</div>
							</div>
							<div class="mr-2">
								<i class="fa fa-star text-warning"></i>
							</div>
							<div>
								<p>Work/Management</p>
							</div>
						</div>
						<div class="d-flex">
							<div>
								<div class="text-dark font-weight-bold mb-2 mr-2">3.5</div>
							</div>
							<div class="mr-2">
								<i class="fa fa-star text-warning"></i>
							</div>
							<div>
								<p>Salary/Culture</p>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
