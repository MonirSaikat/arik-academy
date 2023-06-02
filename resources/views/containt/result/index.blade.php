@extends('containt.layouts.forntend')
@section('main')

    {{-- <div class="rs-history sec-spacer">

    <div class="container">

        <div class="sec-title mb-50 text-center">
            <h2>WELCOME TO NDC Results</h2>      
        </div>

        <div class="row">

            <div class="col-lg-12 col-md-12">

                <div class="fixtures table-responsive">

                    
                    <table id="filterTable" class="table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="content-center text-center">Sl</th>
                                <th style="width: 40%;" class="content-center text-center">Title</th>
                                <th class="content-center text-center">Publication Date</th>
                            </tr>
                        </thead>
                        <tbody>
                                                    </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    </div> --}}
    {{-- <body>
        <h1>School Result</h1>
        <div class="container">
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
        </div>
    </body> --}}

    <div class="container col-lg-6 m-auto">
        <form>
            <h1 class="mt-5">School Result</h1>
            <fieldset class="bg-light">
                <div class="mb-3 mt-5">
                    <label for="name" class="form-label bg-green"><strong> Name</strong></label>
                    <input type="text" id="name" class="form-control" placeholder="enter your name">
                </div>
                <div class="mb-3">
                    <label for="roll" class="form-label"><strong>Roll</strong></label>
                    <input type="number" id="name" name="name" class="form-control" placeholder="enter your roll">
                </div>
                <div class="mb-3">
                    <label for="session" class="form-label"><strong>Session</strong></label>
                    <select id="session" name="session" class="form-control">
                        <option>select</option>
                        <option value="one">2020</option>
                        <option value="two">2021</option>
                        <option value="three">2022</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="class" class="form-label"><strong> Class</strong></label>
                    <select id="class" name="class" class="form-select">
                        <option>select</option>
                        <option value="one">1</option>
                        <option value="two">2</option>
                        <option value="three">3</option>
                        <option value="four">4</option>
                        <option value="five">5</option>
                        <option value="six">6</option>
                        <option value="seven">7</option>
                        <option value="eight">8</option>
                        <option value="nine">9</option>
                        <option value="ten">10</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
@endsection
