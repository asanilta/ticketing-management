<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $tickets = $request->user()->tickets()->orderByDesc('created_at')->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create'); // Ticket creation form
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'opened',
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    // 2 & 3. Admin assigns tickets and manages all tickets
    public function adminIndex()
    {
        $tickets = Ticket::orderByDesc('created_at')->get(); // Admin can view all tickets
        $agents = User::role('agent')->get();
            // Number of tickets by status
        $ticketsByStatus = Ticket::selectRaw('status, COUNT(*) as count')
        ->groupBy('status')
        ->get();
        $totalTickets = Ticket::count();
        $statusPercentages = [];
        foreach ($ticketsByStatus as $ticketStatus) {
            $statusPercentages[$ticketStatus->status] = $totalTickets > 0 
                ? ($ticketStatus->count / $totalTickets) * 100 
                : 0;
        }
        $averageTimeToClose = Ticket::whereNotNull('closed_at')
        ->selectRaw('AVG(TIMESTAMPDIFF(SECOND, created_at, closed_at)) / 60 as avg_response_time')
        ->first()
        ->avg_response_time;
        return view('admin.tickets.index', compact('tickets', 'agents', 'ticketsByStatus', 'statusPercentages', 'averageTimeToClose'));
        }

    public function assign(Request $request, Ticket $ticket)
    {
        $request->validate([
            'agent_id' => 'required|exists:users,id',
        ]);
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket assigned successfully.');
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => ['required', 'in:In Progress,On Hold,Closed'], // Validate allowed statuses
        ]);
    
        $user = $request->user();
    
        if ($user->id === $ticket->user_id) {
            if ($request->input('status') === 'Closed') {
                $ticket->status = 'Closed';
                $ticket->closed_at = now();
                $ticket->save();
                return back()->with('success', 'Ticket closed successfully.');
            } else {
                return back()->withErrors(['status' => 'You are only allowed to close your tickets.']);
            }
        } elseif ($user->hasRole('admin') || ($user->hasRole('agent') && ($user->id === $ticket->agent_id))) {
            $ticket->status = $request->input('status');
            if ($ticket->status == 'Closed') {
                $ticket->closed_at = now();
            }
            $ticket->save();
        
            return back()->with('success', 'Ticket status updated successfully.');
        }
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('admin.tickets.index')->with('success', 'Ticket deleted successfully.');
    }

    // 4. Agents manage tickets assigned to them
    public function agentIndex(Request $request)
    {
        $tickets = Ticket::where('agent_id', $request->user()->id)->orderByDesc('created_at')->get();
        return view('agent.tickets.index', compact('tickets'));
    }

}
