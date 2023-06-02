<x-student-layout title="Fees">
    <h1>Fee list</h1>

    @php
        $student = \App\Models\Student\Student::with('gender')
            ->where('student_unique_id', intval(auth()->user()->username))
            ->first();

        $allInvoices = DB::table('fee_allocations as fa')->where('is_active',1)
                        ->where('is_all_student',1)
                        ->join('fee_types', 'fee_types.id', 'fa.fee_type_id')
                        ->join('fee_dates', 'fee_dates.fee_type_id', 'fee_types.id')
                        ->select('fee_types.fee_amount as amount','fee_dates.*', 'fa.fee_title','fa.created_at as generate_time')
                        ->get();

        $classWiseInvoices = DB::table('fee_allocations as fa')->where('is_active',1)
                            ->where('allocated_class_id',$student->class_id)
                            ->join('fee_types', 'fee_types.id', 'fa.fee_type_id')
                            ->join('fee_dates', 'fee_dates.fee_type_id', 'fee_types.id')
                            ->select('fee_types.fee_amount as amount','fee_dates.*', 'fa.fee_title','fa.created_at as generate_time')
                            ->get();

        $singleStudentInvoices = DB::table('fee_allocations as fa')->where('is_active',1)
                                ->where('allocated_type','specafic-student')
                                ->join('fee_types', 'fee_types.id', 'fa.fee_type_id')
                                ->join('fee_dates', 'fee_dates.fee_type_id', 'fee_types.id')
                                ->join('fee_allocation_students','fee_allocation_students.fee_allocation_id','fa.id')
                                ->where('fee_allocation_students.fee_allocation_student_id',$student->id)
                                ->select('fee_types.fee_amount as amount','fee_dates.*', 'fa.fee_title','fa.created_at as generate_time')
                                ->get();

        $invoices = new \Illuminate\Database\Eloquent\Collection;
        $invoices = $invoices->concat($allInvoices);
        $invoices = $invoices->concat($classWiseInvoices);
        $invoices = $invoices->concat($singleStudentInvoices);

    @endphp

    <div class="card mb-4">
        <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover table-striped" id="dataTableHover">
                <thead class="bg-primary text-light">
                    <tr>
                        <th>Serial</th>
                        <th>Create Date</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Fee Group</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <th>{{ date('d M,Y',strtotime($invoice->generate_time)) }}</th>
                            <th>{{ date('d M,Y',strtotime($invoice->start_date)) }}</th>
                            <th>{{ date('d M,Y',strtotime($invoice->end_date)) }}</th>
                            <th>{{ $invoice->fee_title }}</th>
                            <th>{{ $invoice->amount }} BDT</th>
                            <th> <span class="badge badge-danger">Due</span></th>
                            <th><a href="" class="btn btn-sm btn-success">Pay Now</a></th>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-student-layout>
