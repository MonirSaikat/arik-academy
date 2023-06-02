<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link href="admission.css" rel="stylesheet" />



</head>
<body>

    <div class="container main-container pt-1">
        <section class="site-content mt-3">
            <div class="row">
              <div class="col-sm-12">
                <!-- Start Welcome or About Text -->
                <div class="card rounded-0 theme-border theme-shadow">
                  <div class="card-header theme-border-color rounded-0 theme-bg">
                    Application Form
                </div>
      
                <div class="card-body text-justify">  
                  <form action="https://dpilot.edu.bd/index.php/admission/store" method="POST" class="" data-aire-component="form" enctype="multipart/form-data" id="fm" data-aire-id="0" novalidate="novalidate">
      
                  <input type="hidden" name="_token" value="8dWdOk5cU6FirFj5cZFMr2QVjtWKdxOhgMDSwMhN">
              
              
          <fieldset>
                      <legend class="theme-color">Student Information:</legend>
      
                      <div class="row">
                          
                             
                                  
                          <div class="col-lg-6">
                              
                              <div class="mb-6" data-aire-component="group" data-aire-for="name">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="name">
          Student's Full Name *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="name" name="name" placeholder="Full Name" data-aire-for="name">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="name">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="birth">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="birth">
          Date Of Birth *
      </label>
      
          
          
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="birth_date">
                  </ul>
          
              
      </div>
      
      
      <div class="">
                      
        <input type="date" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="birth_date" name="birth_date" data-aire-for="birth_certificate">

            
            </div>
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="birth_certificate">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="birth_certificate">
          Birth Certificate No. *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="birth_certificate_no" name="birth_certificate_no" data-aire-for="birth_certificate">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="birth_certificate">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="gender">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="gender">
          Gender *
      </label>
      
          
          <div class="">
                      
              <select class="form-control text-gray-900" data-aire-component="select" id="gender" name="gender" data-aire-for="gender">
          
              
                  
              <option value="" selected="">
                  Select Gender
              </option>
          
                  
              <option value="male">
                  Male
              </option>
          
                  
              <option value="female">
                  Female
              </option>
          
                  
              <option value="others">
                  Others
              </option>
          
          
      </select>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="gender">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="blood">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="blood">
          Blood Group 
      </label>
      
          
          <div class="">
                      
              <select class="form-control text-gray-900" data-aire-component="select" id="blood_group" name="blood_group" data-aire-for="blood">
          
              
                  
              <option value="" selected="">
                  Select Blood Group
              </option>
          
                  
              <option value="a(+ve)">
                  A(+ve)
              </option>
          
                  
              <option value="a(-ve)">
                  A(-ve)
              </option>
          
                  
              <option value="b(+ve)">
                  B(+ve)
              </option>
          
                  
              <option value="b(-ve)">
                  B(-ve)
              </option>
          
                  
              <option value="o(+ve)">
                  O(+ve)
              </option>
          
                  
              <option value="o(-ve)">
                  O(-ve)
              </option>
          
                  
              <option value="ab(+ve)">
                  AB(+ve)
              </option>
          
                  
              <option value="ab(-ve)">
                  AB(-ve)
              </option>
          
          
      </select>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="blood">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="religion">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="religion">
          Religion
      </label>
      
          
          <div class="">
                      
              <select class="form-control text-gray-900" data-aire-component="select" id="religion" name="religion" data-aire-for="religion">
          
              
                  
              <option value="Islam">
                  Islam
              </option>
          
                  
              <option value="Hindu">
                  Hindu
              </option>
          
                  
              <option value="Christian">
                  Christian
              </option>
          
                  
              <option value="Buddhism">
                  Buddhism
              </option>
          
                  
              <option value="Others">
                  Others
              </option>
          
          
      </select>
      <div class="mb-6" data-aire-component="group" data-aire-for="email">
        <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="email">
        Email
    </label>
      </div>
      <div class="">
                      
        <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="email" name="email" data-aire-for="previousRoll">

            
            </div>
            <div class="mb-6" data-aire-component="group" data-aire-for="email">
                <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="email">
                Nationality
            </label>
              </div>
              <div class="">
                              
                <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="nationality" name="nationality" data-aire-for="previousRoll">
        
                    
                    </div>
                          
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="religion">
                  </ul>
          
              
      </div>
      
      
    
                          </div>

                        

                          <div class="col-lg-6">
      
                              <div class="col-lg-12 mx-auto">
                                  <div class="row mb-2 mr-3 ml-2">
                                      <img id="previewHolder" alt="Student Image" src="https://dpilot.edu.bd/public/uplodefile/defult/user.png" class="border mx-auto" height="220" width="200">
                                  </div>
                                  <p id="error1" style="display:none; color:#FF0000;" class="alert alert-danger">
                                      Invalid Image Format! Image Format Must Be JPG, JPEG, PNG.
                                  </p>
                                  <p id="error2" style="display:none; color:#FF0000;" class="alert alert-danger">
                                      Image maximum File Size Limit is 300 kb.
                                  </p>
      
                                  <p id="error3" style="display:none; color:#FF0000;" class="alert alert-danger text-center">
                                      Please upload exact size Image <br>( maximum width 300px and maximum height 350px )
                                      
                                  </p>
                                      <input type="hidden" id="pass">
                                  <div class="mb-6" data-aire-component="group" data-aire-for="image">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="image">
          Student's Image *
      </label>
      
          
          <div class="">
                      
              <input type="file" class="block w-full leading-normal bg-white border rounded-sm p-2 text-base text-gray-900" data-aire-component="input" id="photo" name="photo" data-aire-for="image">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="image">
                  </ul>
          
              
      </div>
      
                                  <label class="text-info text-center col-12">Image maximum width 300px and maximum height 350px</label>
                              </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="previousInstretute">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="previousInstretute">
          Previous Institute Name *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="prvSchool" name="prvSchool" data-aire-for="previousInstretute">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="previousInstretute">
                  </ul>
          
              
      </div>
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="previousRoll">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="previousRoll">
          Previous Institute Class Roll No. *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="previousRoll" name="previousRoll" data-aire-for="previousRoll">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="previousRoll">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6 form-check" data-aire-component="group" data-aire-for="hasQouta">
          
          
          <div class="">
                      
              
          <input type="checkbox" value="1" class="pr-2" data-aire-component="checkbox" name="qota" id="qouta" data-aire-for="hasQouta">
          <label class="flex items-baseline" data-aire-component="label" data-aire-validation-key="checkbox_label" data-aire-for="hasQouta" for="qouta">Have Quata</label>
      </label>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="hasQouta">
                  </ul>
          
              
      </div>
      
                              
        <div class="mb-6" data-aire-component="group" data-aire-for="qoutaName">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="qoutaName">
          Qouta
      </label>
      
          
          <div class="">
                      
              <select class="form-control text-gray-900"  name="qouta" disabled="" data-aire-for="qoutaName">
          
              
                  
              <option value="" selected="">
                  Select Qouta
              </option>
          
                  
              <option value="Freedom Fighter">
                  Freedom Fighter
              </option>
          
                  
              <option value="Disabled">
                  Disabled
              </option>
          
                  
              <option value="Pousha">
                  Pousha
              </option>
          
                  
              <option value="Others">
                  Others
              </option>
          
          
      </select>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="qoutaName">
                  </ul>
          
              
      </div>
      
                          </div>
                      </div>
                  </fieldset>
      
      
      <div class="card-body text-justify">
                  <fieldset>
                      <legend class="theme-color">Family Information:</legend>
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="mb-6" data-aire-component="group" data-aire-for="father_name">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="father_name">
          Father's Name *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="fName" name="fName" data-aire-for="father_name">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="father_name">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="father_phone">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="father_phone">
          Father's Phone No. *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="fNumber" name="fNumber" data-aire-for="father_phone">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="father_phone">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="father_email">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="father_email">
          Father's Email 
      </label>
      
          
          <div class="">
                      
              <input type="email" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="fMail" name="fMail" data-aire-for="father_email">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="father_email">
                  </ul>
          
              
      </div>
      
      
                          </div>
                          <div class="col-lg-6">
                              <div class="mb-6" data-aire-component="group" data-aire-for="father_profession">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="father_profession">
          Father's Occupation *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="fOccupation" name="fOccupation" data-aire-for="father_profession">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="father_profession">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="father_nid">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="father_nid">
          Father's NID No *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="fNid" name="fNid" data-aire-for="father_nid">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="father_nid">
                  </ul>
          
              
      </div>
      <div class="mb-6" data-aire-component="group" data-aire-for="father_income">
        <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="father_income">
        Father Income
    </label>
      </div>
      <div class="">
                      
        <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="fIncome" name="fIncome" data-aire-for="previousRoll">

            
            </div>
      
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="mb-6" data-aire-component="group" data-aire-for="mother_name">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="mother_name">
          Mother's Name  *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="mName" name="mName" data-aire-for="mother_name">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="mother_name">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="mother_phone">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="mother_phone">
          Mother's Phone No. 
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="mNumber" name="mNumber" data-aire-for="mother_phone">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="mother_phone">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="mother_email">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="mother_email">
          Mother's Email 
      </label>
      
          
          <div class="">
                      
              <input type="email" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="mMail" name="mMail" data-aire-for="mother_email">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="mother_email">
                  </ul>
          
              
      </div>
      
                          </div>
                          <div class="col-lg-6">
                              <div class="mb-6" data-aire-component="group" data-aire-for="mother_profession">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="mother_profession">
          Mother's Occupation *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="mOccupation" name="mOccupation" data-aire-for="mother_profession">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="mother_profession">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="mother_nid">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="mother_nid">
          NID No. *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="mNid" name="mNid" data-aire-for="mother_nid">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="mother_nid">
                  </ul>
           
      </div>
      
      
         
      


      <div class="mb-6" data-aire-component="group" data-aire-for="mother_income">
        <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="mother_income">
        Mother Income
    </label>
      </div>
      <div class="">
                      
        <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="mIncome" name="mIncome" data-aire-for="previousRoll">

            
            </div>








      
      
      
                          </div>
                      </div>
                  </fieldset>
      
      
                  <fieldset>
                      <legend class="theme-color">Address Information:</legend>
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="row border-bottom m-2">
                                  <h5 class=""><p class="text-info">Present Address</p></h5> 
                              </div>
                              <div class="mb-6" data-aire-component="group" data-aire-for="present_address">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="present_address">
          Present Address *
      </label>
      
          
          <div class="">
                      
              <textarea class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="textarea" id="present_address" name="present_address" placeholder="House/Rode: , Village/Area/Word: , Post Office: " data-aire-for="present_address"></textarea>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="present_address">
                  </ul>
          
              
      </div>
      
    
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="present_post_code">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="present_post_code">
          Post Code *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="post_code" name="post_code" data-aire-for="present_post_code">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="present_post_code">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="present_district">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="present_district">
          District *
      </label>
      
          
          <div class="">
                      
              <input class="form-control text-gray-900" data-aire-component="select" id="district" name="district" data-aire-for="present_district">
          
              
          
          </input>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="present_district">
                  </ul>
          
              
      </div>
      
                              
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="present_thana">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="present_thana">
          Upazila *
      </label>
      
          
          <div class="">
                      
              <input class="form-control text-gray-900" id="upazila" name="upazila" data-aire-for="present_thana">
      
          </input>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="present_thana">
                  </ul>
          
              
      </div>
      
                              
                              
                          </div>
                          <div class="col-lg-6">
                              <div class="row border-bottom m-2">
                                  <h5 class=""><p class="text-info">Permanent Address</p></h5>
                                  <div class="mb-6 form-check" data-aire-component="group" data-aire-for="same_as_present">
          
          
          <div class="">
                      
              <label class="flex items-baseline" data-aire-component="label" data-aire-validation-key="checkbox_label" data-aire-for="same_as_present" for="same_as_present">
          <input type="checkbox" value="1" class="pr-2" data-aire-component="checkbox" id="same_as_present" name="same_as_present" data-aire-for="same_as_present">
          <span class="ml-2 flex-1" data-aire-component="wrapper" data-aire-validation-key="checkbox_wrapper" data-aire-for="same_as_present">
              Same As Present Address
          </span>
      </label>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="same_as_present">
                  </ul>
          
              
      </div>
      
                              </div>
                              <div class="mb-6" data-aire-component="group" data-aire-for="permananent_address">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="permananent_address">
          Permanent Address *
      </label>
      
          
          <div class="">
                      
              <textarea class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="textarea" id="permananent_address" name="permananent_address" placeholder="House/Rode: , Village/Area/Word: , Post Office: " data-aire-for="permananent_address"></textarea>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="permananent_address">
                  </ul>
          
              
      </div>
      
      
                              
                              <div class="mb-6" data-aire-component="group" data-aire-for="permananent_post_code">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="permananent_post_code">
          Post Code *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="permananent_post_code" name="permananent_post_code" data-aire-for="permananent_post_code">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="permananent_post_code">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="permananent_district">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="permananent_district">
          District *
      </label>
      
          
          <div class="">
                      
              <input class="form-control text-gray-900" data-aire-component="select" id="permananent_district" name="permananent_district" data-aire-for="permananent_district">
          
              
                  
              
          </input>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="permananent_district">
                  </ul>
          
              
      </div>
      
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="permananent_thana">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="permananent_thana">
          Upazila *
      </label>
      
          
          <div class="">
                      
              <input class="form-control text-gray-900" data-aire-component="select" id="permananent_upazila" name="permananent_upazila" data-aire-for="permananent_thana">
       
          
          </input>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="permananent_thana">
                  </ul>
          
              
      </div>
      
                              
                          </div>
                      </div>
      
      
      
                  </fieldset>
      
                  <fieldset>

      
                      <fieldset id="LocalGurdian" style="display: none;">
                      <legend class="theme-color">Local Gurdian's Information:</legend>
                      <div class="row">
                          <div class="col-lg-6">
                              <div class="mb-6" data-aire-component="group" data-aire-for="localGurdian_name">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="localGurdian_name">
          Name *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="localGurdian_name" name="localGurdian_name" data-aire-for="localGurdian_name">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="localGurdian_name">
                  </ul>
          
              
      </div>
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="localGurdian_relation">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="localGurdian_relation">
          Relation *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="localGurdian_relation" name="localGurdian_relation" data-aire-for="localGurdian_relation">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="localGurdian_relation">
                  </ul>
          
              
      </div>
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="localGurdian_phone">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="localGurdian_phone">
          Phone No *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="localGurdian_phone" name="localGurdian_phone" data-aire-for="localGurdian_phone">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="localGurdian_phone">
                  </ul>
          
              
      </div>
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="localGurdian_email">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="localGurdian_email">
          Email *
      </label>
      
          
          <div class="">
                      
              <input type="email" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="localGurdian_email" name="localGurdian_email" data-aire-for="localGurdian_email">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="localGurdian_email">
                  </ul>
          
              
      </div>
      
      
                              
                              
      
                          </div>
                          <div class="col-lg-6">
                              
                              <div class="mb-6" data-aire-component="group" data-aire-for="localGurdian_address">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="localGurdian_address">
          Address *
      </label>
      
          
          <div class="">
                      
              <textarea class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="textarea" id="localGurdian_address" name="localGurdian_address" rows="4" placeholder="House/Rode: , Village/Area/Word: , Post Office: , Post Code: " data-aire-for="localGurdian_address"></textarea>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="localGurdian_address">
                  </ul>
          
              
      </div>
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="localGurdian_postCode">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="localGurdian_postCode">
          Post Code *
      </label>
      
          
          <div class="">
                      
              <input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="localGurdian_postCode" name="localGurdian_postCode" data-aire-for="localGurdian_postCode">
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="localGurdian_postCode">
                  </ul>
          
              
      </div>
      
  
      
                               
                              <div class="mb-6" data-aire-component="group" data-aire-for="localGurdian_district">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="localGurdian_district">
          District *
      </label>
      
          
          <div class="">
                      
              <select class="form-control text-gray-900" data-aire-component="select" id="localGurdian_district" name="localGurdian_district" data-aire-for="localGurdian_district">

                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="localGurdian_district">
                  </ul>
          
              
      </div>
      
                              <div class="mb-6" data-aire-component="group" data-aire-for="localGurdian_thana">
          <label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="localGurdian_thana">
          Upazila *
      </label>
      
          
          <div class="">
                      
              <input class="form-control text-gray-900" data-aire-component="select" id="localGurdian_thana" name="localGurdian_thana" data-aire-for="localGurdian_thana">
            </input>
      
                  
                  </div>
          
          <ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="localGurdian_thana">
                  </ul>
          
              
      </div>
      
                              
                          </div>
                      </div>
                      </fieldset>
                  </fieldset>
           
      </form>
      <fieldset>
        <legend class="theme-color">Others Information:</legend>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-6" data-aire-component="group" data-aire-for="datepay">
<label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="datepay">
Payment Date
</label>


<div class="">
        
<input type="date" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="pay_date" name="pay_date" data-aire-for="father_name">

    
    </div>

<ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="father_name">
    </ul>


</div>


                <div class="mb-6" data-aire-component="group" data-aire-for="admission_class">
<label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="admission_class">
Admission Class
</label>


<div class="">
        
<input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="admission_class" name="admission_class" data-aire-for="father_phone">

    
    </div>

<ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="admission_class">
    </ul>


</div>

           </div>
            <div class="col-lg-6">
                <div class="mb-6" data-aire-component="group" data-aire-for="pay_date">
<label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="payment">
Payment Method
</label>


<div class="">
        
<input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="payment_method" name="payment_method" data-aire-for="father_profession">

    
    </div>

<ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="father_profession">
    </ul>


</div>


                <div class="mb-6" data-aire-component="group" data-aire-for="Addmission_ln">
<label class="inline-block mb-2 font-semibold cursor-pointer text-base" data-aire-component="label" for="Addmission_ln">
Addmission Lottery Number
</label>


<div class="">
        
<input type="text" class="form-control p-2 text-base rounded-sm text-gray-900" data-aire-component="input" id="addmission_lottery_number" name="addmission_lottery_number" data-aire-for="father_nid">

    
    </div>

<ul class="list-reset mt-2 mb-3 hidden" data-aire-component="errors" data-aire-validation-key="group_errors" data-aire-for="">
    </ul>


</div>

   </fieldset>
      </div>
              </div>
          </div>

         
          <!-- End Welcome or About Text -->
      </div>
      </div>
      </section>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>