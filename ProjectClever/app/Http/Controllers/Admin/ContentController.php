<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::latest()->paginate(10);
        return view('admin.contents.index', compact('contents'));
    }
    public function create()
    {
        return view('admin.contents.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:faq,guide,policy',
            'is_active' => 'boolean',
            'order' => 'integer|min:1'
        ]);
        Content::create($validated);
        return redirect()->route('admin.contents.index')
            ->with('success', 'Content created successfully');
    }
    public function edit(Content $content)
    {
        return view('admin.contents.edit', compact('content'));
    }
    public function update(Request $request, Content $content)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:faq,guide,policy',
            'is_active' => 'boolean',
            'order' => 'integer|min:1'
        ]);
        $content->update($validated);
        return redirect()->route('admin.contents.index')
            ->with('success', 'Content updated successfully');
    }
    public function destroy(Content $content)
    {
        $content->delete();
        return back()->with('success', 'Content deleted successfully');
    }
}