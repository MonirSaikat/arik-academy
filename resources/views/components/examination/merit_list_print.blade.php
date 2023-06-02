<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merit List</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

  

        .page {
            width: 275mm;
            padding: 20px 20px;
            margin:auto;
            /* border:1px solid black; */
            position: relative;
        }
        #footer{
            /* position: absolute; */
            position: absolute;
            bottom: 0;
            width: 210mm;
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
            width:100%;
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
                margin: 20px auto;
                 page-break-before:always;
            }

        @media print {
            html, body .page{
                width: 210mm;
                margin:auto;
                padding: 20px 20px;
                page-break-before:always;
                overflow: hidden;
            }
        }
    </style>
</head>

<body>
    <div class="page">
        <table border="1">
            <tr>
                <th>Sl No</th>
                <th>Student Name</th>
                <th>Student Roll</th>
                <th>GPA</th>
                <th>Total Mark</th>
                <th>Position</th>
            </tr>
            @php
                $key = 1
            @endphp
            @foreach ($final_result as $student)
                <tr>
                    <td>{{ $key++ }}</td>
                    <td>{{ $student['name'] }}</td>
                    <td>{{ $student['roll'] }}</td>
                    <td>{{ $student['gpa'] == 0 ? 'F':$student['gpa'] }}</td>
                    <td>{{ $student['total_mark'] }}</td>
                    <td>{{ getOrdinalNumber($loop->iteration) }}</td>
                </tr>
            @endforeach
        </table>
    </div>   
</body>

</html>