@extends('layouts.app')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')

    <div class="grid grid-flow-row">
       <div class="container mx-auto">
           <div class="px-6 py-4">               
               <div class="mx-auto overflow-hidden">
                   <form class="grid grid-cols-1 lg:grid-cols-3 sm:grid-cols-2 gap-4" method="GET" action="{{ route('report-getData') }}">
                        @csrf

                        <div class="">
                            <!-- Project Selection multiple -->
                            <!-- List all project boards, but disable the ones, which are not available for the current user -->
                            <label for="projects" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Project
                            </label>

                            <select id="project-dropdown" class="select2-dropdown block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight 
                            focus:outline-none focus:bg-white focus:border-gray-500" name="projects[]" multiple="multiple">
                                @if(isset($projects))
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ (!empty(old('projects')) && in_array($project->id, old('projects'))) ? "selected='selected'" : '' }}>
                                            {{ $project->abbreviation }}
                                        </option>
                                    @endforeach
                                @else
                                    <p>No available projects</p>
                                @endif                
                            </select>
                        </div>

                        <div class="">
                            <!-- Status Selection multiple -->
                            <label for="status" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Ticket's status
                            </label>

                            <select id="status-dropdown" class="select2-dropdown block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight 
                            focus:outline-none focus:bg-white focus:border-gray-500" name="status[]" multiple="multiple" placeholder="test">
                                @if(isset($statuses))
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ (!empty(old('status'))) && (in_array($status, old('status'))) ? "selected='selected'" : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                @else
                                    <p>No available statuses</p>
                                @endif                          
                            </select>
                        </div>

                        <div class="">
                            <!-- Users Selection multiple -->
                            <!-- If general user -> preselect his name, others should be disabled -->
                            <label for="assignee" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Assigned to
                            </label>

                            <select id="users-dropdown" class="select2-dropdown block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight 
                            focus:outline-none focus:bg-white focus:border-gray-500" name="users[]" multiple="multiple" placeholder="test">
                                @if(isset($users))
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{(!empty(old('users'))) && (in_array($user->id, old('users'))) ? "selected='selected'" : '' }}>
                                            {{ $user->email }}
                                        </option>
                                    @endforeach
                                @else
                                    <p>No available users</p>
                                @endif
                            </select>
                        </div>

                        <div class="">
                            <!-- Date Range Selection -->
                            <label for="deadline" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Date range
                            </label>

                            <input class="block appearance-none w-full border border-gray-500 text-gray-400 py-1 px-3 pr-8 rounded leading-none 
                            focus:outline-none focus:bg-white focus:border-gray-700" id="date-range" name="daterange" value="{{ old('daterange') ? old('daterange') : ""}}">
                        </div>

                        <div class="">
                            <!-- Contact - Email address -->
                            <label for="deadline" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Contact (e-mail)
                            </label>

                            <input type="email" name="contact" class="block appearance-none w-full border border-gray-500 text-gray-400 py-1 px-3 pr-8 rounded leading-none 
                            focus:outline-none focus:bg-white focus:border-gray-700" placeholder="Specify contact's e-mail">
                        </div>

                        <div class="">
                            <!-- Contact - Email address -->
                            <label for="deadline" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Reporter (e-mail)
                            </label>

                            <input type="email" name="reporter" class="block appearance-none w-full border border-gray-500 text-gray-400 py-1 px-3 pr-8 rounded leading-none 
                            focus:outline-none focus:bg-white focus:border-gray-700" placeholder="Specify reporter's e-mail" value="{{ old('reporter') ? old('reporter') : ''  }}">
                        </div>
                        
                        <button id="searchBtn" type="submit" class="col-span-1 sm:col-end-3 lg:col-end-4 bg-teal-500 hover:bg-blue-700 text-white font-bold p-3 rounded my-1">
                            Search
                        </button>

                   </form>
               </div>
           </div>
       </div>
    </div>


    @if(isset($data) && count($data) > 0)
        @include('partials._report-tickets')
    @else
        <div class="container text-center w-auto mx-auto mt-8 text-gray-600 text-xl">
            No Results match your criteria
        </div>
    @endif

    <script type="text/javascript">
        $(document).ready(function() {
            //  Select 2 dropdowns
            $('#project-dropdown').select2({
                width: '100%',
                placeholder: 'Select project(s)',
            });
            
            $('#status-dropdown').select2({
                width: '100%',
                placeholder: 'Select status',
            });

            $('#users-dropdown').select2({
                width: '100%',
                placeholder: 'Select user(s)',
            });

            // Datepicker / Date range https://www.daterangepicker.com
            $('#date-range').daterangepicker({
                "showDropdowns": true,
                "autoApply": true,
                "opens": "center",
                "drops": "auto",
                "locale": {
                    "format": "YYYY/MM/DD",
                    "separator": " - ",
                    "applyLabel": "Apply",
                    "cancelLabel": "Cancel",
                    "fromLabel": "From",
                    "toLabel": "To",
                    "customRangeLabel": "Custom",
                    "weekLabel": "W",
                    "daysOfWeek": [
                        "Su",
                        "Mo",
                        "Tu",
                        "We",
                        "Th",
                        "Fr",
                        "Sa"
                    ],
                    "monthNames": [
                        "January",
                        "February",
                        "March",
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December"
                    ],
                    "firstDay": 1
                },
            });

            @if(!old('daterange'))
                $('#date-range').val('');
                $('#date-range').attr('placeholder', 'Select your date range');
            @endif


        });
   </script>
@endsection