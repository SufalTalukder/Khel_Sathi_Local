@extends( 'layouts\player_layout_dashboard' )
@section('content')


<div class="container-fluid pagecontentbody">
				<div class="pagebody removebg-color">
					<div class="row">
						<div class="col-12">
							<div class="pageheader" id="menu-margin">
								<h4 class="mb-0"> Pay Registration Fee
									
								<a href="{{route('playerdashboard')}}" class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to Dashboard</a> </h4>
							</div>
							<div class="bhoechie-tab-container">
								<div class="form-scroll">
									<div class="nano-content">
										<div class="card">
											
											<div class="card-body">
												<div class="row justify-content-center">
													<div class="col-md-2 d-grid">
														<a data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1" class="btn btn-outline-danger rounded-pill"><i class="fas fa-money-check"></i> Online Payment</a>
													</div>
													
													<div class="col-md-2 d-grid">
														<a  type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2" class="btn  btn-outline-info rounded-pill"><i class="fa">₹</i> Ofline Payment</a>
													</div>
													
													
													<div class="col-md-2 d-grid">
														<a href="" class="btn btn-outline-dark rounded-pill"><i class="fas fa-download"></i> Download Pay Slip</a>
													</div>
													
													
												</div>
												
												
												
												
												
												
												<div class="collapse multi-collapse" id="multiCollapseExample1">
													<!-- Nav tabs -->
													<ul class="nav nav-pills registration nav-fill" id="myTab" role="tablist">
														<li class="nav-item" role="presentation">
															<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-credit-card"></i> Credit Card</button>
														</li>
														<li class="nav-item" role="presentation">
															<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="fas fa-credit-card"></i> Debit Card</button>
														</li>
														<li class="nav-item" role="presentation">
															<button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false"><i class="fas fa-mobile-alt mr-2"></i> Net Banking</button>
														</li>
													</ul>
													
													<!-- Tab panes -->
													<div class="tab-content">
														<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
															<div class="form-group">
																<label for="username">
																	<h6>Card Owner</h6>
																</label>
																<input type="text" name="username" placeholder="Card Owner Name" required class="form-control ">
															</div>
															<div class="form-group">
																<label for="cardNumber">
																	<h6>Card number</h6>
																</label>
																<div class="input-group">
																	<input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
																	<div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
																</div>
															</div>
															<div class="row">
																<div class="col-sm-8">
																	<div class="form-group">
																		<label> Expiration Date </label>
																		<div class="input-group">
																			<input type="number" placeholder="MM" name="" class="form-control" required>
																			<input type="number" placeholder="YY" name="" class="form-control" required>
																		</div>
																	</div>
																</div>
																<div class="col-sm-4">
																	<div class="form-group mb-4">
																		<label data-toggle="tooltip" title="Three digit CV code on the back of your card" style="
																		margin-top: 3px;
																		"> CVV <i class="fa fa-question-circle d-inline"></i> </label>
																		<input type="text" required class="form-control"/>
																	</div>
																</div>
															</div>
															<div class="card-footer" style="background: transparent;padding: 0;">
																<a type="button" onclick="" class="subscribe btn btn-outline-danger w-100 rounded-pill"> Confirm Payment </a>
															</div>
														</div>
														<div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
															<div class="form-group">
																<label for="username"> Card Owner </label>
																<input type="text" name="username" placeholder="Card Owner Name" required class="form-control ">
															</div>
															<div class="form-group">
																<label for="cardNumber"> Card number </label>
																<div class="input-group">
																	<input type="text" name="cardNumber" placeholder="Valid card number" class="form-control " required>
																	<div class="input-group-append"> <span class="input-group-text text-muted"> <i class="fab fa-cc-visa mx-1"></i> <i class="fab fa-cc-mastercard mx-1"></i> <i class="fab fa-cc-amex mx-1"></i> </span> </div>
																</div>
															</div>
															<div class="row">
																<div class="col-sm-8">
																	<div class="form-group">
																		<label> Expiration Date </label>
																		<div class="input-group">
																			<input type="number" placeholder="MM" name="" class="form-control" required>
																			<input type="number" placeholder="YY" name="" class="form-control" required>
																		</div>
																	</div>
																</div>
																<div class="col-sm-4">
																	<div class="form-group mb-4">
																		<label data-toggle="tooltip" title="Three digit CV code on the back of your card"> CVV <i class="fa fa-question-circle d-inline"></i> </label>
																		<input type="text" required class="form-control">
																	</div>
																</div>
															</div>
															<div class="card-footer" style="background: transparent;padding: 0;">
																<a type="button" onclick=""   class="subscribe btn btn-outline-info w-100 rounded-pill shadow-sm"> Confirm Payment </a>
																
															</div>
														</div>
														<div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
															<div class="form-group mb-3">
																<label> Select your Bank </label>
																<br>
																<select class="form-control" id="ccmonth">
																	<option value="" selected disabled>--Please select your Bank--</option>
																	<option>Bank 1</option>
																	<option>Bank 2</option>
																	<option>Bank 3</option>
																	<option>Bank 4</option>
																	<option>Bank 5</option>
																	<option>Bank 6</option>
																	<option>Bank 7</option>
																	<option>Bank 8</option>
																	<option>Bank 9</option>
																	<option>Bank 10</option>
																</select>
															</div>
															<div class="form-group">
																<a type="button" onclick="" class="btn-outline-primary btn w-100 rounded-pill "><i class="fas fa-mobile-alt mr-2"></i> Proceed Payment</a>
															</div>
															<p class="text-muted"><small>Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </small></p>
														</div>
													</div>
												</div>
												<div class="collapse multi-collapse" id="multiCollapseExample2">
													<h3>Pay Registration Fee <span class="text-success"><i class="fa">₹</i>200</span></h3>
													
													<select class="form-select form-control" aria-label="Default select example">
														<option selected>select</option>
														<option value="1">Challan</option>
														<option value="2">DD</option>
													</select>
													
													<div class="mb-3">
														<label for="formFile" class="form-label">Upload Challan</label>
														<input class="form-control" type="file" id="formFile">
													</div>
													<div class="mb-3">
														<label for="exampleFormControlInput1" class="form-label">Challan No.</label>
														<input type="number" class="form-control" id="exampleFormControlInput1">
													</div>
													<div class="mb-3">
														<label for="formFile" class="form-label">Upload DD</label>
														<input class="form-control" type="file" id="formFile">
													</div>
													<div class="mb-3">
														<label for="exampleFormControlInput1" class="form-label">DD No.</label>
														<input type="number" class="form-control" id="exampleFormControlInput1">
													</div>
													<div class="mb-3">
														<a type="button" onclick="" class="btn btn-outline-primary w-100 rounded-pill "><i class="fas fa-tick mr-2"></i> Submit</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
@endsection
@push('custom-scripts')
