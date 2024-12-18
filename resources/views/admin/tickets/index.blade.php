@extends('layouts.admin')

@section('title', 'Manage Tickets')

@section('content')
    <h1>Manage All Tickets</h1>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <!-- Number of Tickets by Status -->
        @foreach($ticketsByStatus as $status)
            <div class="col-md-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $status->status }}</h5>
                        <p class="card-text">
                            {{ $status->count }} Tickets
                            ({{ number_format($statusPercentages[$status->status], 2) }}%)
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Average Response Time Card -->
        <div class="col-md-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h5 class="card-title">Average Time to Close</h5>
                    <p class="card-text">{{ number_format($averageTimeToClose, 2) }} minutes</p>
                </div>
            </div>
        </div>
    </div>

    <h2>Open Tickets</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Created At</th>
                <th>ID</th>
                <th>Customer</th>
                <th>Title</th>
                <th>Description</th>
                <th>Agent</th>
                <th>Status</th>
                <th>Update Status</th>
                <th>Assign Agent</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets->where('status', '!=', 'Closed') as $ticket)
                <tr>
                    <td>{{ $ticket->created_at }}</td>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->description }}</td>
                    <td>{{ $ticket->agent ? $ticket->agent->name : 'Unassigned' }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>
                        <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" required>
                                @foreach (App\Models\Ticket::getStatusOptions() as $status)
                                    <option value="{{ $status }}" {{ $ticket->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.tickets.assign', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="agent_id" required>
                                <option value="">Select Agent</option>
                                @foreach ($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ $ticket->agent_id == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Assign</button>
                        </form>
                    </td>
                    <td>
                        <!-- Delete Ticket Button -->
                        <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ticket?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10">No open tickets available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h2>Closed Tickets</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Created At</th>
                <th>Closed At</th>
                <th>ID</th>
                <th>Customer</th>
                <th>Title</th>
                <th>Description</th>
                <th>Agent</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets->where('status', 'Closed') as $ticket)
                <tr>
                    <td>{{ $ticket->created_at }}</td>
                    <td>{{ $ticket->closed_at }}</td>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->description }}</td>
                    <td>{{ $ticket->agent ? $ticket->agent->name : 'Unassigned' }}</td>
                    <td>
                        <!-- Delete Ticket Button -->
                        <form action="{{ route('admin.tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ticket?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No closed tickets available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
