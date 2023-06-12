<!DOCTYPE html>
<html>

<head>
  <title>Student ID Card</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    .page {
      width: 210mm;
      /* A4 width */
      height: 297mm;
      /* A4 height */
      margin: 0 auto;
      box-sizing: border-box;
      padding: 3mm;
      page-break-after: always;
    }

    .card {
      float: left;
      width: 80mm;
      /* Adjust card width based on your preference */
      height: 46mm;
      /* Adjust card height based on your preference */
      background-color: white;
      border-radius: 5px;
      padding: 2mm;
      /* Adjust padding for card content */
      margin: 3mm;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: inline-block;
      vertical-align: top;

      position: relative;
      background-image: url('{{ URL::asset('/uploads/backgroup.jpeg') }}');
      page-break-inside: avoid;
    }

    .student-photo {
      width: 2mm;
      /* Adjust photo width based on your preference */
      height: 1mm;
      /* Adjust photo height based on your preference */
      border-radius: 5px;
      margin: 10px auto 10px;
      background-size: cover;
      background-position: center;
    }

    .card-header {
      text-align: center;
      font-size: 18px;
    }

    .student-info {
      text-align: center;
    }

    .student-info h3 {
      margin: 0 !imcportant;
      font-size: 14px;
      /* Adjust font size for name based on your preference */
      color: #333;
    }

    .student-info p {
      margin: 2px 0;
      font-size: 10px;
      /* Adjust font size for other details based on your preference */
      color: #777;
    }

    table {
      font-size: 13px;
      margin: auto;
    }

    table.mytable tr td:first-child {
      width: 70px;
      text-align: left;
      font-weight: 700;
    }

    table.mytable tr td:last-child {
      text-align: left;
      font-weight: 700;
    }

    table.mytable tr td:nth-child(2) {
      text-align: center;
      font-weight: 700;
      width: 15px;
    }

    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      /* Three equal-width columns */
      grid-gap: 5px;
      /* Gap between grid items */
    }

    @media print {

      html,
      body .student-photo {}

      @page {
        margin: 5mm 5mm 2mm 5mm;
      }

      .card {
        background-image: url('{{ URL::asset('/uploads/backgroup.jpeg') }}');
      }

      body {
        -webkit-print-color-adjust: exact;
      }
    }

    .card-header h4:first-child {
      background: blue;
      color: white;
      font-size: 22px;
      border-radius: 5px;
    }

    .card-header h4:last-child {
      font-size: 22px;
      width: 45%;
      margin: 2px auto;
      background: white;
      border: 1px solid maroon;
      border-radius: 5px;
      font-size: 22px;
    }

    .last-tr {
      background: blue;
      color: white;
      border-radius: 5px;
    }
  </style>
</head>

<body>
  <div class="page">

    <div class="grid">
      @foreach ($students as $student)
        <div class="card">
          <div class="card-header">
            <h4 style="margin:5px 5px 20px">Aric Academy</h4>
            <h4 style="margin:0px">{{ $student->name }}</h4>
            <h4>Roll : {{ $student->roll_number }}</h4>
          </div>
          <div class="student-info">
            <table class="mytable">

              <tr>
                <td>Student Id</td>
                <td>:</td>
                <td>{{ $student->student_unique_id }}</td>
              </tr>
              <tr>
                <td>Class</td>
                <td>:</td>
                <td>{{ $student->class->name }}</td>
              </tr>
              <tr>
                <td>Section</td>
                <td>:</td>
                <td>{{ $student->section->name ?? 'N/A' }}</td>
              </tr>
              <tr class="last-tr">
                <td>Mobile No.</td>
                <td>:</td>
                <td>+880{{ $student->parent_phone ?? 'N/A' }}</td>
              </tr>
            </table>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <!-- Repeat the above code for the other side of the paper -->
</body>

</html>
