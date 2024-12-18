@extends('layouts.app')

@section('title', 'Assigned Tickets')

@section('content')
    <h1>Assigned Tickets</h1>

    <ul class="nav nav-tabs" id="ticketTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="opened-tab" data-bs-toggle="tab" href="#opened" role="tab" aria-controls="opened" aria-selected="true">Opened</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="in-progress-tab" data-bs-toggle="tab" href="#in-progress" role="tab" aria-controls="in-progress" aria-selected="false">In Progress</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="on-hold-tab" data-bs-toggle="tab" href="#on-hold" role="tab" aria-controls="on-hold" aria-selected="false">On Hold</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="closed-tab" data-bs-toggle="tab" href="#closed" role="tab" aria-controls="closed" aria-selected="false">Closed</a>
        </li>
    </ul>
    <p></p>

    <!-- Tab Content -->
    <div class="tab-content" id="ticketTabsContent">
        <!-- Opened Tickets Tab -->
        <div class="tab-pane fade show active" id="opened" role="tabpanel" aria-labelledby="opened-tab">
            <div class="row">
                @forelse ($tickets->where('status', 'Opened') as $ticket)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">#{{ $ticket->id }}: {{ $ticket->title }}</h5>
                                <p class="card-text"><small class="text-muted">{{ $ticket->created_at->format('d M Y h:i') }}</small></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Customer: {{ $ticket->user->name }}</p>
                                <p class="card-text">{{ $ticket->description }}</p>
                                <form action="{{ route('agent.tickets.update', $ticket->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="status">Update Status:</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="On Hold" {{ $ticket->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                            <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm mt-2">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center w-100">No tickets here.</p>
                @endforelse
            </div>
        </div>

        <!-- In Progress Tickets Tab -->
        <div class="tab-pane fade" id="in-progress" role="tabpanel" aria-labelledby="in-progress-tab">
            <div class="row">
                @forelse ($tickets->where('status', 'In Progress') as $ticket)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">#{{ $ticket->id }}: {{ $ticket->title }}</h5>
                                <p class="card-text"><small class="text-muted">{{ $ticket->created_at->format('d M Y h:i') }}</small></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Customer: {{ $ticket->user->name }}</p>
                                <p class="card-text">{{ $ticket->description }}</p>
                                <form action="{{ route('agent.tickets.update', $ticket->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="status">Update Status:</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="Opened" {{ $ticket->status == 'Opened' ? 'selected' : '' }}>Opened</option>
                                            <option value="On Hold" {{ $ticket->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                            <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm mt-2">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center w-100">No tickets here.</p>
                @endforelse
            </div>
        </div>

        <!-- On Hold Tickets Tab -->
        <div class="tab-pane fade" id="on-hold" role="tabpanel" aria-labelledby="on-hold-tab">
            <div class="row">
                @forelse ($tickets->where('status', 'On Hold') as $ticket)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">#{{ $ticket->id }}: {{ $ticket->title }}</h5>
                                <p class="card-text"><small class="text-muted">{{ $ticket->created_at->format('d M Y h:i') }}</small></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Customer: {{ $ticket->user->name }}</p>
                                <p class="card-text">{{ $ticket->description }}</p>
                                <form action="{{ route('agent.tickets.update', $ticket->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="status">Update Status:</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="Opened" {{ $ticket->status == 'Opened' ? 'selected' : '' }}>Opened</option>
                                            <option value="In Progress" {{ $ticket->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="Closed" {{ $ticket->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm mt-2">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center w-100">No tickets here.</p>
                @endforelse
            </div>
        </div>

        <!-- Closed Tickets Tab -->
        <div class="tab-pane fade" id="closed" role="tabpanel" aria-labelledby="closed-tab">
            <div class="row">
                @forelse ($tickets->where('status', 'Closed') as $ticket)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">#{{ $ticket->id }}: {{ $ticket->title }}</h5>
                                <p class="card-text"><small class="text-muted">{{ $ticket->created_at->format('d M Y h:i') }}</small></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Customer: {{ $ticket->user->name }}</p>
                                <p class="card-text">{{ $ticket->description }}</p>
                                <p class="card-text"><strong>Closed at:</strong> {{ $ticket->closed_at->format('d M Y h:i') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center w-100">No tickets here.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
