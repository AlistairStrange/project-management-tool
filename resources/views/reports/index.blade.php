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
                   <form class="grid grid-cols-1 lg:grid-cols-3 sm:grid-cols-2 gap-4" method="POST" action="{{ route('report-getData') }}">
                        @csrf

                        <div class="">
                            <!-- Project Selection multiple -->
                            <!-- List all project boards, but disable the ones, which are not available for the current user -->
                            <label for="projects" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Project
                            </label>

                            <select id="project-dropdown" class="select2-dropdown block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight 
                            focus:outline-none focus:bg-white focus:border-gray-500" name="projects[]" multiple="multiple">
                                <option disabled="disabled" value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>                            
                            </select>
                        </div>

                        <div class="">
                            <!-- Status Selection multiple -->
                            <label for="status" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Ticket's status
                            </label>

                            <select id="status-dropdown" class="select2-dropdown block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight 
                            focus:outline-none focus:bg-white focus:border-gray-500" name="status[]" multiple="multiple" placeholder="test">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>                            
                            </select>
                        </div>

                        <div class="">
                            <!-- Users Selection multiple -->
                            <!-- If general user -> preselect his name, others should be disabled -->
                            <label for="assignee" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Assigned to
                            </label>

                            <select id="users-dropdown" class="select2-dropdown block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight 
                            focus:outline-none focus:bg-white focus:border-gray-500" name="assignee[]" multiple="multiple" placeholder="test">
                                <option value="1">1</option>
                                <option value="1">2</option>
                                <option value="1">3</option>                            
                            </select>
                        </div>

                        <div class="">
                            <!-- Date Range Selection -->
                            <label for="deadline" class="block text-gray-500 font-bold mb-2 md:mb-2 pr-4">
                                Date range
                            </label>

                            <input class="block appearance-none w-full border border-gray-500 text-gray-400 py-1 px-3 pr-8 rounded leading-none 
                            focus:outline-none focus:bg-white focus:border-gray-700" id="date-range" name="daterange">
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
                            focus:outline-none focus:bg-white focus:border-gray-700" placeholder="Specify reporter's e-mail">
                        </div>
                        
                        <button type="submit" class="col-span-1 sm:col-end-3 lg:col-end-4 bg-teal-500 hover:bg-blue-700 text-white font-bold p-3 rounded my-1">
                            Search
                        </button>
                   </form>
               </div>
           </div>
       </div>
    </div>

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
            "startDate": new Date(),
            "endDate": "11/11/2020",
            "opens": "center",
            "drops": "auto",
            "locale": {
                "format": "DD/MM/YYYY",
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
    });
   </script>
@endsection