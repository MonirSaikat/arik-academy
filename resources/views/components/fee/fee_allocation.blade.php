@extends('layouts.backend.main')
@section('title','Fee Group')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        Fee Allocation
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Fee Allocation</li>
      </ol>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">

            <div class="card mb-4 p-4">
                <form action="{{ route('backend.fee.allocation.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="fee_title">Fee Title *</label>
                        <input type="text" name="fee_title" class="form-control" id="fee_title" required>
                    </div>
                    <div class="form-group">
                        <label for="fee_group_title_id">Fee Group *</label>
                        <select name="fee_group_title_id" title="select group title" onchange="getFeeType(this.value)" data-live-search="true" class="form-control selectpicker" id="fee_group_title_id">
                            @foreach ($fee_groups as $group)
                                <option value="{{ $group->id }}">{{ $group->group_title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fee_type_id">Fee Type *</label>
                        <select name="fee_type_id" title="select fee type" onchange="getFeeTypeInfo(this.value)" data-live-search="true" class="form-control selectpicker" id="fee_type_id">

                        </select>
                    </div>

                    <ul class="form-group mt-2 mb-2 bg-dark text-light" id="fee_type_info">
                    </ul>

                    <div class="form-group">
                        <label for="fee_code">Allocated To *</label>

                        <div class="form-group ml-5">
                            <input class="form-check-input mr-2" type="radio" name="allocated_type" value="all-student" id="all-student">
                            <label for="all-student" class="ml-2">All Student</label>
                        </div>

                        <div class="form-group ml-5">
                            <input class="form-check-input mr-2" type="radio" name="allocated_type" value="class" id="class">
                            <label for="class" class="ml-2">Class</label>
                        </div>

                        <div class="form-group ml-5">
                            <input class="form-check-input mr-2" type="radio" name="allocated_type" value="group" id="group">
                            <label for="group" class="ml-2">Group</label>
                        </div>

                        <div class="form-group ml-5">
                            <input class="form-check-input mr-2" type="radio" name="allocated_type" value="specafic-student" id="specafic-student">
                            <label for="specafic-student" class="ml-2">Specafic Student</label>
                        </div>


                    </div>

                    <div class="form-group card bg-success" id="allocated_section">
                        <div class="card-header bg-dark text-light">
                            <strong>Allocated section</strong>
                        </div>

                        <div class="allocated_class_div p-3">
                            <label for="allocated_class_id">Class</label>

                            <select name="allocated_only_class_id" title="select class" data-live-search="true" class="form-control selectpicker" id="allocated_class_id">
                                @foreach ($classes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="allocated_group_div text-light p-3">
                            <div class="form-group">
                                <label for="allocated_class_id">Class</label>
                                <select name="allocated_class_id" title="select class" data-live-search="true" onchange="getAllocatedGroup(this.value)" class="form-control selectpicker" id="allocated_class_id">
                                    @foreach ($classes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="allocated_group_id">Group</label>
                                <select name="allocated_group_id" title="select group"  data-live-search="true" class="form-control selectpicker" id="allocated_group_id">

                                </select>
                            </div>

                        </div>

                        <div class="allocated_student_div">
                            <h5 class="text-light text-center mt-2">Search student by unique id</h5>
                            <div class="form-group d-flex ju">
                                <input type="input" class="form-control col-md-6 mx-auto mr-3" name="search_student">
                                <span class="btn btn-danger text-left" id="student_search_btn">Search</span>
                            </div>
                            <table class="table mt-2 table-bordered text-light mb-5">
                                <thead>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Roll</th>
                                    <th>Remove</th>
                                </thead>
                                <tbody id="search_student_tbody">

                                </tbody>
                            </table>

                        </div>


                    </div>


                    <div class="form-group">
                        <label for="fee_code">When the invoice generate *</label>

                        <div class="form-group ml-5">
                            <input class="form-check-input mr-2" type="radio" name="is_active" value="1" id="now_active">
                            <label for="now_active" class="ml-2">Now</label>
                        </div>

                        <div class="form-group ml-5">
                            <input class="form-check-input mr-2" type="radio" name="is_active" value="0" id="fee_type_date">
                            <label for="fee_type_date" class="ml-2">At the fee type date</label>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-success mt-2">Save</button>
                </form>
            </div>


          </div>
    </div>
</div>









@endsection

@push('js')

    <script>

        $('.allocated_class_div').hide();
        $('.allocated_group_div').hide();
        $('.allocated_student_div').hide();


        function getFeeType(id)
        {

            url = `allocation/get-fee-type/${id}`;
            $.get(url,function (data){
                if(data)
                {
                    $('#fee_type_id').html('')
                    data.map((item)=> {
                        $('#fee_type_id').append(`<option value="${item.id}">${item.fee_type_title}</option>`);
                    });
                    $('#fee_type_id').selectpicker("refresh");

                }
            });

        }

        function getFeeTypeInfo(id)
        {
            $('#fee_type_info').html('');
            url = `allocation/get-fee-info/${id}`;
            $.get(url,function(data){
                $('#fee_type_info').html(`
                    <li>Fee Type : ${data.fee_type_title}</li>
                    <li>Description : ${data.fee_description}</li>
                    <li>Amount : ${data.fee_amount}</li>
                `);
            });
        }

        $('input[name=allocated_type]').on('change',function(){

            let val = $(this).val();


            if(val === 'class'){
                $('.allocated_class_div').show();
                $('.allocated_group_div').hide();
                $('.allocated_student_div').hide();

            }else if(val === 'group'){

                $('.allocated_class_div').hide();
                $('.allocated_group_div').show();
                $('.allocated_student_div').hide();


            }else if(val === 'specafic-student'){

                $('.allocated_class_div').hide();
                $('.allocated_group_div').hide();
                $('.allocated_student_div').show();
            }else{
                $('.allocated_class_div').hide();
                $('.allocated_group_div').hide();
                $('.allocated_student_div').hide();
            }
        });

        function getAllocatedGroup(id)
        {
            let url = `class/group/${id}`

            $.get(url,function(data){
                $('#allocated_group_id').html('');
                $('#allocated_group_id').val(null);
                data.map((item)=> {
                    $('#allocated_group_id').append(`<option value="${item.group.id}">${item.group.name}</option>`);
                })
                $('#allocated_group_id').selectpicker('refresh');


            });
        }

        let arr = [];

        function tableCreate(myArr)
        {
            let row = ''
            console.log(myArr);
            myArr.map((item,index)=> {
                console.log(item)
                    row += `<input type="hidden" name="allocated_student_id[]" value="${item.id}" >
                            <tr>
                                <td>${item.uid}</td>
                                <td>${item.name}</td>
                                <td>${item.class}</td>
                                <td>${item.roll}</td>
                                <td><i class="btn btn-sm btn-danger fa-trash" onclick="deleteStudent(${item.uid})"></i></td>
                            </tr>`
                        })
            $('#search_student_tbody').html(row);
        }


        function deleteStudent(id)
        {
            console.log(id);
            filterArr = arr.filter((item,index) => id != item.uid)
            arr = filterArr;
            tableCreate(filterArr);
        }


        $('#student_search_btn').on('click',function(){
            let id = $('input[name=search_student]').val();
            if(id == ''){
                alert('please fill search number');
                return false;
            }else{
                let url = `student/search/${id}`;

                $.get(url,function(data){


                    if(data){
                        console.log(data);
                        let obj = {
                            id : data.id,
                            uid : data.student_unique_id,
                            roll : data.roll_number,
                            name : data.name,
                            class : data.class.name
                        }

                        arr.push(obj);
                        tableCreate(arr);


                    }else{

                        if(arr.length == 0){
                            return false;
                        }else{

                        }
                    }

                    $('input[name=search_student]').val(null);

                })
            }
        })
    </script>
@endpush
