@extends('containt.layouts.forntend')
@section('main')
    {{-- <div id="rs-team-2" class="rs-team-2 team-page sec-spacer">
    <div class="container">
        <div class="faculty_container">
            <div class="sec-title mb-50 text-center">
                <h1>School Staff</h1>
            </div>
            <div class="row justify-content-md-center">
                @foreach ($workers as $key => $worker)
                <div class="card" style="width: 15rem;">
                    <img src="{{asset('uploads/workers/'.$worker->photo)}}" width="300px" height="300px">
                    <div class="card-body">
                      <h5 class="card-title text-center">Name:{{ $worker->name }}</h5>
                    </div>
                  </div>
                  @endforeach
            </div>
        </div>
    </div>
 </div> --}}

    <style>
        html {
            box-sizing: border-box;
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        .column {
            float: right;
            width: 33.3%;
            margin-bottom: 16px;
            padding: 0 8px;
        }

        @media screen and (max-width: 650px) {
            .column {
                width: 100%;
                display: block;
            }
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .container {
            padding: 0 16px;
        }

        .container::after,
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .title {
            color: grey;
        }

        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
        }

        .button:hover {
            background-color: #555;
        }
    </style>
    </head>

    <body>
        <h1>School Staff</h1>
        <div class="container mt-5">
            <div class="row">
                @foreach ($workers as $key => $worker)
                    <div class="column">
                        <div class="card">
                            <img src="{{ asset('uploads/workers/' . $worker->photo) }}" width="150px">
                            <div class="container text-center">
                                <h2>Name:{{ $worker->name }}</h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>

    </html>
@endsection
