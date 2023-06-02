<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mark sheet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

  

        .page {
            width: 275mm;
            height: 210mm;
            padding: 20px 20px;
            /* border:1px solid black; */
            position: relative;
        }
        #footer{
            /* position: absolute; */
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 2.5rem; 
            display: flex;
            justify-content: space-between;
            bottom: 0;
            left: 0;
            padding:0px 10px;
        }
        #footer p{
            
            display: inline-block;
            border-top: 1px solid black;
            padding-top: 5px;
            font-size: 13px;
            font-weight: bold;

        }

        .school_title {
            font-size: 20px;
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 5px;
            margin-top: 10px;
        }

        .school_title span {
            font-size: 18px;
            font-weight: 400;
            text-transform: capitalize;
        }

        #page_header {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
        }

        .page_header p {
            font-size: 18px;
        }
        .school_title p{
            font-size: 12px;
        }
        table{
            font-size: 13px;
            border-collapse: collapse;
        }
         table th{
            padding:4px;
        }
         table td{
            padding:4px;
        }

        .footer_one{
            display: flex;
        }
        .final_gpa{
            text-align: center;
            font-weight: bold;
        }

        @page {
                size: A4;
                margin: 20px;
                 page-break-before:always;
            }

        @media print {
        html, body .page{
            width: 297mm;
            height: 210mm;
            padding: 20px 20px;
            page-break-before:always;
            overflow: hidden;
        }}
    </style>
</head>

<body>
    <div class="page">
        @php
            $subjects = subjects($details);
        @endphp
        <table border="1">
            <tr>
                <th>Student Name</th>
                <th>Student Roll</th>
                @foreach ($subjects as $subject)
                    <th>{{ $subject->name }}</th>
                @endforeach
                <th>GPA</th>
            </tr>
            @foreach ($students as $key=>$student)
                @php
                    $marks = mark($student->id);
                    // dd($marks);
                    $total_gpa = 0;
                    $total_subject = 0;
                    $student_fail = false;
                @endphp
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->roll_number }}</td>
                    @foreach ($marks as $mark)

                        @php
                            // if ($key == 96) {
                            //     dd($marks);
                            // }
                            if ($mark->type != '2' && $mark->type != '3') {
                                $total_gpa += $mark->gpa;
                                $total_subject++;
                                if ($mark->gpa == 0) {
                                    $student_fail = true;
                                }
                            }
                            if ($mark->type == '2') {
                                $total_gpa = $total_gpa + ($mark->gpa > 2 ? $mark->gpa - 2 : 0);
                            }
                            $mark_invalid = true;
                        @endphp
                        @foreach ($subjects as $sub)
                            @if ($sub->subject_code == $mark->subject_code)
                                <td>{{ $mark->gpa }} , {{ $mark->grade }}</td>
                            @php
                                $mark_invalid = false;
                            @endphp
                            @endif
                        @endforeach
                        @if ($mark_invalid)
                            <td></td>
                        @endif
                    @endforeach
                    <td>
                        @if ($student_fail)
                            0.00
                        @elseif ($total_gpa / $total_subject > 5)
                            5.00
                        @else
                            {{ number_format($total_gpa / $total_subject,2) }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>   
</body>

</html>