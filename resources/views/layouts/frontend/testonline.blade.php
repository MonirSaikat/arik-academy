<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container" style="margin-top: 70px">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Online Student Apply</h1>
            </div>
            <div class="col-md-12 mt-3">
                <div class="card p-3 shadow">
                    <div class="card-header bg-primary text-light">
                        <h3 class="card-title"> Apply Form</h3>
                    </div>

                    <div class="card-body">
                        <h4>Student information</h4>

                        <form action="{{route('onlineapply_create')}}" method="post" enctype="multipart/form-data">
                            @csrf 
                            <div class="row">

                                <div class="col-md-6">
    
                                    <div class="form-group mb-3">
                                        <label for="student_name">Student name</label>
                                        <input type="text" required class="form-control" name="name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Date of birth</label>
                                        <input type="date" required class="form-control" name="birth_date">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Birth certificate number</label>
                                        <input type="text" required class="form-control" name="birth_certificate_no">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Blood Group</label>
                                        <select class="form-control" name="blood_group" required id="gender">
                                            <option value="" selected="">Select Group</option>    
                                            <option value="a(+ve)"> A(+ve)</option>       
                                            <option value="a(-ve)">A(-ve)</option>
                                            <option value="b(+ve)"> B(+ve)</option>
                                            <option value="b(-ve)">B(-ve)</option>    
                                            <option value="o(+ve)">O(+ve)</option>
                                            <option value="o(-ve)">O(-ve)</option>   
                                            <option value="ab(+ve)">AB(+ve)</option>    
                                            <option value="ab(-ve)">AB(-ve)</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Religion</label>
                                        <select class="form-control" name="religion" required id="gender">
                                            <option value="" selected="">Select Religion</option>    
                                            <option value="islam"> Islam</option>       
                                            <option value="hindu">Hindu</option>
                                            <option value="christian"> Christian</option>
                                            <option value="buddhism">Buddhism</option>    
                                            <option value="others">others</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group mb-3">
                                        <label for="student_name">Nationality</label>
                                        <select class="form-control" name="nationality" required id="gender">
                                            <option value="bangladeshi" selected="">Bangladeshi</option>    
                                        </select>
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="admission_class">Admission class</label>
                                        <select class="form-control" required name="addmission_class" required id="gender">
                                            <option value="" selected="">Select Class</option>    
                                            <option value="six">Six</option>       
                                            <option value="eight">Eight</option>
                                            <option value="nine"> Nine</option>
                                        </select>
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="image">Student Image</label>
                                        <input type="file" class="form-control" name="photo" required>
                                    </div>
    
                                    <h4>Family information</h4>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Father name</label>
                                        <input type="text"  class="form-control" name="fName" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Father phone number</label>
                                        <input type="text"  class="form-control" name="fNumber" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Father Email</label>
                                        <input type="email"  class="form-control" name="fMail" placeholder="Optional">
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="student_name">Mother Name</label>
                                        <input type="text"  class="form-control" name="mName">
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="student_name">Mother phone number</label>
                                        <input type="text"  class="form-control" name="mNumber" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Mother Email</label>
                                        <input type="email"  class="form-control" name="mMail" placeholder="Optional">
                                    </div>
    
                                    <h4>Address Information</h4>
                                    <h6 class="mt-4">Present address</h6>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Address</label>
                                        <textarea required name="present_address" id="present_address" class="form-control" placeholder="House/Road/Village"></textarea>
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="student_name">Post Code</label>
                                        <input type="text"  class="form-control" name="post_code" id="present_post_code">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Upazila</label>
                                        <input type="text"  class="form-control" name="upazila" id="present_upazila">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">District</label>
                                        <input type="text"  class="form-control" name="district" id="present_district">
                                    </div>
    
    
                                </div>
    
    
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="student_name">Gender</label>
                                        <select class="form-control" name="gender" required id="gender">
                                            <option value="" selected="">Select Gender</option>    
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="form-group mb-3">
                                        <label for="student_name">Email</label>
                                        <input type="email"  class="form-control" name="email" placeholder="Optional">
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="student_name">Previous school name</label>
                                        <input type="text"  class="form-control" required name="prvSchool">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Previous school roll number</label>
                                        <input type="text"  class="form-control" required name="previousRoll">
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="admission_class">Qouta</label>
                                        <select class="form-control" name="qouta"  id="gender">
                                            <option value="" selected="">Select qouta</option>    
                                            <option value="freedom_fighter">Freedom Fighter</option>       
                                            <option value="pousha">Pousha</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
    
                                    <div class="form-group mb-3" style="margin-top: 285px">
                                        <label for="student_name">Father Occupation</label>
                                        <input type="text"  class="form-control" required name="fOccupation">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Father Nid Number</label>
                                        <input type="text"  class="form-control" required name="fNid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Father Income</label>
                                        <input type="text"  class="form-control" required name="fIncome">
                                    </div>
    
    
                                    <div class="form-group mb-3">
                                        <label for="student_name">Mother Occupation</label>
                                        <input type="text"  class="form-control" required name="mOccupation">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Mother Nid Number</label>
                                        <input type="text"  class="form-control"  name="mNid">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Mother Income</label>
                                        <input type="text"  class="form-control"  name="mIncome">
                                    </div>
    
                                    <h6 class="mt-4">Parmanent address</h6> <strong>
                                        <input type="checkbox" name="same_address" id="same_address">
                                        <label for="same_address">Same Address</label>
                                    </strong>
                                    <div class="form-group mb-3" style="margin-top: 30px">
                                        <label for="student_name">Address</label>
                                        <textarea required name="permanent_address" id="permanent_address" class="form-control" placeholder="House/Road/Village"></textarea>
                                    </div>
    
                                    <div class="form-group mb-3">
                                        <label for="student_name">Post Code</label>
                                        <input type="text"  class="form-control" name="parmanent_post_code" id="permanent_post_code">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">Upazila</label>
                                        <input type="text"  class="form-control" name="parmanent_upazila" id="permanent_upazila">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="student_name">District</label>
                                        <input type="text"  class="form-control" name="parmanent_district" id="permanent_district">
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" style="width:20%" class="btn btn-success">Apply</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        
        var checkbox = document.querySelector("input[name=same_address]");

        checkbox.addEventListener( 'change', function() {
                var presentAddress = document.getElementById('present_address').value;
              
                var presentPost = document.getElementById('present_post_code').value;
                
                var presentUpazila = document.getElementById('present_upazila').value;
             
                var presentDistrict = document.getElementById('present_district').value;
               
                    

                var permanentAddress = document.getElementById('permanent_address');
                var permanentPost = document.getElementById('permanent_post_code');
                var permanentUpazila = document.getElementById('permanent_upazila');
                var permanentDistrict = document.getElementById('permanent_district');


            if(this.checked) {
                permanentAddress.value = presentAddress
                permanentPost.value = presentPost
                permanentUpazila.value = presentUpazila
                permanentDistrict.value = presentDistrict
            } else {
                permanentAddress.value = null
                permanentPost.value = null
                permanentUpazila.value = null
                permanentDistrict.value = null
            }

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
