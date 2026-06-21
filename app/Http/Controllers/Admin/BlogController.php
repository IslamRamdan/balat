<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'image'   => 'nullable|image',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('blogs', 'public');
        }

        BlogPost::create([
            'title'   => $request->title,
            'image'   => $image,
        ]);

        return redirect()->back()->with('success', 'تم إنشاء العمل بنجاح');
    }
    public function index()
    {
        $blogs = BlogPost::latest()->get();
        return view('admin.blog.index', compact('blogs'));
    }

    public function edit($id)
    {
        $blog = BlogPost::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = BlogPost::findOrFail($id);

        $request->validate([
            'title'   => 'required|string|max:255',
            'image'   => 'nullable|image',
        ]);

        $image = $blog->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('blogs', 'public');
        }

        $blog->update([
            'title'   => $request->title,
            'image'   => $image,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'تم تحديث العمل بنجاح');
    }
    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);

        // حذف الصورة من التخزين إذا موجودة
        if ($blog->image) {
            \Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')->with('success', 'تم حذف العمل بنجاح');
    }
    public function indexp()
    {
        $blogs = BlogPost::latest()->get();
        return view('mdwna', compact('blogs'));
    }
    public function show($id)
    {
        $blog = BlogPost::findOrFail($id);

        // $blogs = BlogPost::where('id', '!=', $blog->id)
        //     ->latest()
        //     ->take(5)
        //     ->get();
        $blogs = BlogPost::latest()->take(5)->get();



        return view('admin.blog.show', compact('blog', 'blogs'));
    }
}
