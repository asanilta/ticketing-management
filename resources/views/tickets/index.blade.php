@extends('layouts.app')

@section('title', 'My Tickets')

@section('content')
<h1>My Tickets</h1>
<p></p>
<a href="{{ route('tickets.create') }}" class="btn btn-primary mb-4">Create New Ticket</a>
<p></p>
<ul class="nav nav-tabs" id="ticketTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="open-tab" data-bs-toggle="tab" href="#open" role="tab" aria-controls="open" aria-selected="true">Open</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="closed-tab" data-bs-toggle="tab" href="#closed" role="tab" aria-controls="closed" aria-selected="false">Closed</a>
    </li>

</ul>
    <p></p>

    <!-- Tab Content -->
    <div class="tab-content" id="ticketTabsContent">
        <!-- Open Tickets Tab -->
        <div class="tab-pane fade show active" id="open" role="tabpanel" aria-labelledby="open-tab">
            <div class="row">
                @forelse ($tickets->where('status', '!=', 'Closed') as $ticket)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <p class="badge 
                                    @if($ticket->status == 'Opened') 
                                        bg-primary 
                                    @elseif($ticket->status == 'In Progress') 
                                        bg-warning 
                                    @elseif($ticket->status == 'On Hold') 
                                        bg-secondary 
                                    @else 
                                        bg-secondary 
                                    @endif">
                                    {{ $ticket->status }}
                                </p>
                                <h5 class="card-title">#{{ $ticket->id }}: {{ $ticket->title }}</h5>
                                <p class="card-text"><small class="text-muted">{{ $ticket->created_at->format('d M Y h:i') }}</small></p>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{{ $ticket->description }}</p>
                                <p class="card-text"><strong>Assigned Agent:</strong> {{ $ticket->agent ? $ticket->agent->name : 'Unassigned' }}</p>
                                <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="Closed">
                                    <button type="submit" class="btn btn-danger btn-sm">Close Ticket</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center w-100">No open tickets.</p>
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
                                <p class="card-text">{{ $ticket->description }}</p>
                                <p class="card-text"><strong>Assigned Agent:</strong> {{ $ticket->agent ? $ticket->agent->name : 'Unassigned' }}</p>
                                <p class="card-text"><strong>Closed at:</strong> {{ $ticket->closed_at->format('d M Y h:i') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center w-100">No closed tickets.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
