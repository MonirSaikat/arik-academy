<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <style>
    /* Define styles for printing */
    @media print {
      /* Hide elements that should not be printed */
      .no-print {
        display: none;
      }
      @page {
        margin-top: 10mm; /* Reset default page margin */
      }
      
    }
    
    .grid {
      display: grid;
      grid-template-columns: 1fr 1fr; /* Three equal-width columns */
      grid-gap: 20px; /* Gap between grid items */
    }

    .grid-item {
      background-color: white;
      border: 1px solid black;
      border-radius:10px;
      margin-top:15px;
      padding: 20px;
      text-align: center;
      font-family: Lato;
      page-break-inside: avoid; 
    }
  </style>
</head>

<body>
  <button class="no-print" onclick="window.print()">Print</button>
 
   
   <div class="grid">
   @foreach($students as $student)
    <div class="grid-item">
        <h2 style="margin:2px">{{ $exam->name ?? '' }}</h2>
        <h3 style="margin:2px">{{ $student->name }}</h3>
        <p style="margin: 5px 0;">Roll: {{ $student->roll_number }}</p>
        <p style="margin: 5px 0;">Class: {{ $student->class->name ?? '' }}</p> 
        @if($student->section_id)
        <p style="margin: 5px 0;">Section: {{ $student->section->name ?? '' }}</p>
        @else
        <p style="margin: 5px 0;">Group: {{ $student->group->name ?? '' }}</p>
        @endif
    </div>
    @endforeach
</div>
  
</body>

</html>
