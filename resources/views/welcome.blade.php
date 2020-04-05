<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


        <!-- Styles -->
        <style>
            table {
              font-family: arial, sans-serif;
              border-collapse: collapse;
              width: 100%;
            }

            td, th {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
            }

            tr:nth-child(even) {
              background-color: #dddddd;
            }
            </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                 <form action="/data" method="GET">
                    <select name="surveyid" id="surveyid">
                        <option value="SV_37pd3qDU44DMeBT"> Test - Post-demande 2020 - V2 </option>
                        <option value="SV_8rguWQaistQvxzL"> Test - Post-MEP 2020 - V2 </option>
                        <option value="SV_9S0JkHvfd2MDOfz"> PROD - Post-demande 2020 </option>
                        <option value="SV_cTQ1nBOqwKT6zIx"> Test - Post-signature 2020 - V2 </option>
                        <option value="SV_dgRvTv9etk2tYwJ"> Test - Post-réclamation 2020 - V2 </option>
                    </select>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>

                 <table>
                    <tr>
                        <th>id</th>
                        <th>contactId</th>
                        <th>contactLookupId</th>
                        <th>email</th>
                        <th>contact_id_survey</th>
                        <th>firstName</th>
                        <th>lastName</th>
                        <th>phone__c</th>
                        <th>mobile__c</th>
                        <th>sendDate</th>
                        <th>response_id</th>
                        <th>surveyId</th>
                        <th>sent</th>
                        <th>failed</th>
                        <th>started</th>
                        <th>bounced</th>
                        <th>opened</th>
                        <th>skipped</th>
                        <th>finished</th>
                        <th>complaints</th>
                        <th>blocked</th>
                        <th>created_at</th>

                    </tr>
                    @foreach ($survey as $surveys)
                     <tr>
                      <td>{{ $surveys->id }}</td>
                      <td>{{ $surveys->contactId}}</td>
                      <td>{{ $surveys->contactLookupId }}</td>
                      <td>{{ $surveys->email }}</td>
                      <td>{{ $surveys->contact_id_survey }}</td>
                      <td>{{ $surveys->firstName }}</td>
                      <td>{{ $surveys->lastName }}</td>
                      <td>{{ $surveys->phone__c }}</td>
                      <td>{{ $surveys->mobile__c }}</td>
                      <td>{{ $surveys->sendDate }}</td>
                      <td>{{ $surveys->response_id }}</td>
                      <td>{{ $surveys->surveyId }}</td>
                      <td>{{ $surveys->sent }}</td>
                      <td>{{ $surveys->failed }}</td>
                      <td>{{ $surveys->started }}</td>
                      <td>{{ $surveys->bounced }}</td>
                      <td>{{ $surveys->opened }}</td>
                      <td>{{ $surveys->skipped }}</td>
                      <td>{{ $surveys->finished }}</td>
                      <td>{{ $surveys->complaints }}</td>
                      <td>{{ $surveys->blocked }}</td>
                      <td>{{ $surveys->created_at }}</td>
                    </tr>


                     @endforeach

                  </table>
<center>
{!! $survey->links() !!}
</center>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>


