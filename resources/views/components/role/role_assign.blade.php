@extends('layouts.backend.main')
@section('title','Role assign')
@section('content')


<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        {{ $role->name }} <span style="font-size: 17px; margin-left:30px"> <input type="checkbox" id="all_permission"> <label for="all_permission">All Permission</label> </span>
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('backend.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('backend.role.index')}}">Role</a></li>
        <li class="breadcrumb-item active" aria-current="page">Assign</li>
      </ol>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <form action="{{ route('backend.role.assign.store',$role->id) }}" method="post">
            @csrf
            <div class="responsive-table">
                <table class="table table-bordered">
                    <thead>
                        <th>Check</th>
                        <th>Group</th>
                        <th>Permissions</th>
                    </thead>
                    <tbody>
                        @foreach ($groups as $key=>$group)
                            <tr>
                                <td><input type="checkbox" name="group_checkbox[]" value="{{ $group->id }}" class="group_checkbox"> </td>
                                <td>{{ $group->name }}</td>
                                <td>
                                    @foreach ($group->permission($group->id) as $permission)
                                        <span class="mr-3 {{ $group->id }}">
                                            <input type="checkbox" name="permissions[]" {{ $permission->permissionCheck($role->id,$permission->id) ? 'checked' : '' }} value="{{ $permission->id }}" id="{{ $permission->name }}">
                                            <label for="{{ $permission->name }}">{{ explode('-',$permission->name)[1] }}</label>
                                        </span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center">
                <button class="btn btn-success mt-3">Assign</button>
            </div>
        </form>
    </div>
</div>








@endsection

@push('js')
    <script>
        $('.group_checkbox').on('input',function(){
            $class = $(this).val();
            $('.'+$class).find('input[type=checkbox]').each(function () {
                this.checked = !this.checked ;
           });
        })

        $("#all_permission").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
