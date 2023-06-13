<x-student-layout title="Homework">

  @php
    $student = \App\Models\Student\Student::with('gender')
        ->where('student_unique_id', intval(auth()->user()->username))
        ->first();
    
    $homework = App\Models\Homework::where('class_id', $student->class_id)
        ->when($student->section_id, function ($q) use ($student) {
            $q->where('section_id', $student->section_id);
        })
        ->when($student->group_id, function ($q) use ($student) {
            $q->where('group_id', $student->group_id);
        })
        ->get();
  @endphp

  <div class="card">
    <div class="card-header">
      <h3>Home Work</h3>
    </div>
    <div class="card-body">
      <table class="table table-striped" id="dataTableHover">
        <thead>
          <tr>
            <th>SL</th>
            <th>Class</th>
            <th>Subject</th>
            <th>Home Work Date</th>
            <th>Submission Date</th>
            <th>Document</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($homework as $key => $item)
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $item->class->name ?? 'N/A' }}</td>
              <td>{{ $item->subject->name ?? 'N/A' }}</td>
              <td>{{ $item->homework_date }}</td>
              <td>{{ $item->submission_date }}</td>
              <td class="d-flex"><a href="{{ route('backend.home_work.pdf.show', $item->file) }}"> <i
                    class="fa fa-file-pdf"></i>
                  {{ $item->file }}</a></td>
              @if ($item->is_active == true)
                <td><span class="badge bg-info text-light">Active</span></td>
              @else
                <td><span class="badge bg-danger text-light">Active</span></td>
              @endif
              <td>
                <a class="dropdown-item" href="#" data-target="#homeworksubmitmodal" data-id="{{ $item->id }}"
                  data-toggle="modal"><i class="fas fa-arrow-circle-right mr-2"></i> Submit</a>
              </td>

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="modal fade" id="homeworksubmitmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Submit Home Work</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('students.homework') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="homework_id" id="homework_id">
            <div class="mb-3">
              <label for="document">Document</label>
              <input type="file" name="document[]" multiple id="documnet" class="form-control" required>
            </div>
            <div class="mb-3">
              <input type="submit" value="Submit" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @push('js')
    <script>
      $('#homeworksubmitmodal').on('shown.bs.modal', function(e) {
        const button = e.relatedTarget;
        const id = $(button).data('id')

        console.log(id)  
        
      });
    </script>
  @endpush
</x-student-layout>
