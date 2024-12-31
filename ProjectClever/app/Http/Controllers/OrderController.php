<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Project;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }


    public function create(Service $service)
    {
        return view('orders.create', [
            'service' => $service
        ]);
    }

    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'requirements' => 'required|string',
            'transaction_proof' => 'required|image|max:2048',
        ]);

        $transaction_proof = $this->fileUploadService->uploadImage(
            $request->file('transaction_proof'),
            'transaction_proofs'
        );

        $project = Project::create([
            'client_id' => Auth::id(),
            'freelancer_id' => $service->user_id,
            'service_id' => $service->id,
            'status' => 'pending',
            'amount' => $service->price,
            'requirements' => $validated['requirements'],
            'transaction_proof' => $transaction_proof,
            'start_date' => now(),
            'end_date' => now()->addDays($service->duration_days),
        ]);

        return redirect()->route('orders.success', $project)
            ->with('success', 'Order placed successfully!');
    }

    public function success(Project $project)
    {
        return view('orders.success', [
            'project' => $project
        ]);
    }

    public function index()
    {
        $orders = Project::where('client_id', Auth::id())
            ->with(['service', 'freelancer'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(Project $project)
    {
        if (Auth::id() !== $project->client_id && Auth::id() !== $project->freelancer_id) {
            abort(403);
        }

        $project->load(['service', 'freelancer', 'client']);

        return view('orders.show', compact('project'));
    }

    public function freelancerOrders()
    {
        $orders = Project::where('freelancer_id', Auth::id())
            ->with(['service', 'client'])
            ->latest()
            ->paginate(10);

        return view('orders.freelancer', compact('orders'));
    }

    public function updateStatus(Request $request, Project $project)
    {
        if (Auth::id() !== $project->freelancer_id) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:in_progress,completed,cancelled'
        ]);

        $project->update([
            'status' => $validated['status']
        ]);

        return back()->with('success', 'Order status updated successfully!');
    }
}