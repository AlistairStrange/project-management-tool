<table id="filter-results" class="mt-8 mx-auto table-auto divide-y divide-gray-300 text-gray-600">
    <thead>
        <tr class="divide-x divide-gray-300">
            <th class="px-4 py-2">Ticket #</th>
            <th class="px-4 py-2">Subject</th>
            <th class="px-4 py-2">SP</th>
            <th class="px-4 py-2">Assignee</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Deadline</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $ticket)
            <tr class="divide-x divide-gray-300 hover:bg-gray-200">
                <td class="px-4 py-2">
                    {{ $ticket->projectBoard->abbreviation }}-{{ $ticket->id }}
                </td>

                <td class="px-4 py-2">
                    <a href="{{ route('ticket.show', $ticket->id) }}" class="underline text-teal-400 hover:text-teal-600">
                        {{ $ticket->subject }}
                    </a>
                </td>

                <td class="px-4 py-2">
                    {{ $ticket->story_points }}
                </td>

                <td class="px-4 py-2">
                    <a href="{{ route('user.show', $ticket->user->id) }}" class="underline text-teal-400 hover:text-teal-600">
                        {{ $ticket->user->name }}
                    </a>
                </td>

                <td class="px-4 py-2">
                    {{ $ticket->status }}
                </td>

                <td class="px-4 py-2">
                    {{ $ticket->deadline }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="container mx-auto mt-8">
    {{ $data->withQueryString()->links() }}
</div>

