<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Font-->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/opensans-font.css')}}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css')}}"> --}}
    <!-- datepicker -->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/jquery-ui.min.css')}}"> --}}
    <!-- Main Style Css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}" />
</head>

<body>
    <div class="page-content">
        <div class="wizard-heading">Registration</div>
        <div class="wizard-v6-content">
            <div class="wizard-form">
                {{-- <form class="form-register" id="form-register" action="#" method="post"> --}}
                    <form action="{{ route('onlineapply') }}" method="post"  enctype="multipart/form-data">
                        @csrf
                    <div id="form-total">
                        <!-- SECTION 1 -->
                        <h2>
                            {{-- <p class="step-icon"><span>1</span></p>
			            	<span class="step-text">Personal Info</span> --}}
                        </h2>
                        <section>
                            <div class="inner">
                                <div class="form-heading">
                                    <h3>Studen Information</h3>
                                
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="name" name="name"
                                                required>
                                            <span class="label">Student Name</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" class="form-control" id="last_name"
                                                name="birth_certificate_no" required>
                                            <span class="label">Birth Cirificate No</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="date" class="form-control" id="birth_date" name="birth_date"
                                                required>
                                            {{-- <span class="label">Phone Number</span> --}}
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="email" name="email" id="email" class="form-control"
                                                required>
                                            <span class="label">E-Mail</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="nationality"
                                                name="nationality" required>
                                            <span class="label">Nationality</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" name="religion" id="religion" class="form-control"
                                                required>
                                            <span class="label">Religion</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            {{-- <input type="text" class="form-control" id="nationality" name="nationality" required> --}}
                                            <select name="gender" id="gender">
                                                {{-- <option>Gender</option> --}}
                                                <option value="male">male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <span class="label">Gender</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" name="prvSchool" id="prvSchool" class="form-control"
                                                required>
                                            <span class="label">Enter Previous School Name</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-heading">
                                    <h3>Parents Information</h3>
                                    
                                </div>
                               
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="fName"
                                                name="fName" required>
                                            <span class="label">Enter Father's Name</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" name="fNid" id="fNid" class="form-control"
                                                required>
                                            <span class="label">Enter Father Nid Number</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="fOccupation"
                                                name="fOccupation" required>
                                            <span class="label">Father Occapution</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" name="fIncome" id="fIncome" class="form-control"
                                                required>
                                            <span class="label">Father Annual Income</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="email" class="form-control" id="fMail"
                                                name="fMail" required>
                                            <span class="label">Father Email</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" name="fNumber" id="fNumber" class="form-control"
                                                required>
                                            <span class="label">Father mobile Number</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="mName"
                                                name="mName" required>
                                            <span class="label">Mother Name</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" name="mNid" id="mNid" class="form-control"
                                                required>
                                            <span class="label">Mother Nid Number</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="mOccupation"
                                                name="mOccupation" required>
                                            <span class="label">Mother Occapution</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" name="mIncome" id="mIncome" class="form-control"
                                                required>
                                            <span class="label">Mother Annual Income</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="email" class="form-control" id="mMail"
                                                name="mMail" required>
                                            <span class="label">Mother Email</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" name="mNumber" id="mNumber" class="form-control"
                                                required>
                                            <span class="label">Mother Mobile Number</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-heading">
                                    <h3>Address</h3>
                                    
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="present_address"
                                                name="present_address" required>
                                            <span class="label">Presenr Address</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" name="post_code" id="post_code" class="form-control"
                                                required>
                                            <span class="label">Post Code</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="thana"
                                                name="thana" required>
                                            <span class="label">Thana</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" name="district" id="district" class="form-control"
                                                required>
                                            <span class="label">District</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-heading">
                                    <h3>Other Information</h3>   
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" class="form-control" id="addmission_class"
                                                name="addmission_class" required>
                                            <span class="label">Admission Class</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" name="payment_method" id="payment_method" class="form-control"
                                                required>
                                            <span class="label">Payment Method</span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="number" class="form-control" id="addmission_lottery_number"
                                                name="addmission_lottery_number" required>
                                            <span class="label">Admission Lottery ID</span>
                                        </label>
                                    </div>
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="date" name="pay_date" id="pay_date" class="form-control"
                                                required>
                                            <span class="label">Payment Date</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-holder">
                                        <label class="form-row-inner">
                                            <input type="text" class="form-control" id="qouta"
                                                name="qouta" required>
                                            <span class="label">Qouta</span>
                                        </label>
                                    </div>
                                    {{-- <div class="form-row">
                                        <div class="form-holder">
                                            <label class="form-row-inner">
                                                <input type="file" class="form-control" id="photo"
                                                    name="photo" required>
                                                <span class="label">Photo</span>
                                            </label>
                                        </div>
                                    </div> --}}
                               
                               
                            </div>
                        </section>
                        {{-- <!-- SECTION 2 -->
			            <h2>
			            	<p class="step-icon"><span>2</span></p>
			            	<span class="step-text">Booking</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="form-heading">
			                		<h3>Booking Infomation</h3>
			                		<span>2/3</span>
			                	</div>
		                		<div class="form-images">
		                			<img src="images/wizard_v6.jpg" alt="wizard_v6">
		                		</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label for="room" class="special-label-1">Choose a Room </label>
										<select name="room" id="room" class="form-control">
											<option value="Daily Design Metting - Metting Room No.1" selected>Daily Design Metting - Metting Room No.1</option>
											<option value="Single">Single</option>
											<option value="Double">Double</option>
										</select>
										<span class="select-btn">
											<i class="zmdi zmdi-chevron-down"></i>
										</span>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label for="day" class="special-label-1">Organization Day</label>
										<input type="text" name="day" class="day" id="day" placeholder="15 / 08 / 2018">
									</div>
									<div class="form-holder">
										<label for="time" class="special-label-1">Time Open </label>
										<select name="time" id="time" class="form-control">
											<option value="8:00am - 10.00am" selected>8:00am - 10.00am</option>
											<option value="9:00am - 21:00pm">9:00am - 21:00pm</option>
											<option value="10:00am - 22:00pm">10:00am - 22:00pm</option>
											<option value="12:00am - 24:00pm">12:00am - 24:00pm</option>
										</select>
										<span class="select-btn">
											<i class="zmdi zmdi-chevron-down"></i>
										</span>
									</div>
								</div>
							</div>
			            </section>
			            <!-- SECTION 3 -->
			            <h2>
			            	<p class="step-icon"><span>3</span></p>
			            	<span class="step-text">Confirm</span>
			            </h2>
			            <section>
			                <div class="inner">
			                	<div class="form-heading">
			                		<h3>Comfirm Details</h3>
			                		<span>3/3</span>
			                	</div>
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr class="space-row">
												<th>Full Name:</th>
												<td id="fullname-val"></td>
											</tr>
											<tr class="space-row">
												<th>Room:</th>
												<td id="room-val"></td>
											</tr>
											<tr class="space-row">
												<th>Day:</th>
												<td id="day-val"></td>
											</tr>
											<tr class="space-row">
												<th>Time:</th>
												<td id="time-val"></td>
											</tr>
											<tr class="space-row">
												<th>Price:</th>
												<td id="price-val">40.00$</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
			            </section> --}}
                      
                            <button type="submit"><strong>SIGN UP</strong></button>
			          
                     
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>
</body>

</html>
