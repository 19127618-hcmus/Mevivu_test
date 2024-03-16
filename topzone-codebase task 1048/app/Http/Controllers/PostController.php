<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // Save image to storage/app/public/images
            $imageUrl = 'storage/images/' . $imageName; // Generate image URL
        } else {
            $imageUrl = null;
        }

        // Create a new post
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->excerpt = $request->input('excerpt');
        $post->image = $imageUrl; // Save image URL to database
        $post->save();

        // Return a JSON response
        return response()->json(['success' => true, 'message' => 'Post created successfully', 'image_url' => $imageUrl]);
    }
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function getPostData(Request $request)
    {
        $columns = [
            // Các cột bạn muốn hiển thị trong DataTables
            'id',
            'title',
            'excerpt',
            // Thêm các cột khác nếu cần
        ];

        $posts = Post::select($columns);

        return datatables()->of($posts)->toJson();
    }
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }
    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ]);

        if ($request->hasFile('upload')) {
            $image = $request->file('upload');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // Lưu ảnh vào storage/app/public/images
            $imageUrl = asset('storage/images/' . $imageName); // Tạo URL cho ảnh

            // Trả về đường dẫn ảnh đã tải lên để CKFinder hiển thị
            return response()->json(['uploaded' => true, 'url' => $imageUrl]);
        }

        return response()->json(['uploaded' => false, 'error' => ['message' => 'Failed to upload image']]);
    }
    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $validatedData = $request->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images', $imageName); // Save image to storage/app/public/images
                $validatedData['image'] = 'storage/images/' . $imageName; // Save image path to database
            }

            if ($request->has('excerpt')) {
                $validatedData['excerpt'] = $request->excerpt;
            }

            // Update post with validated data
            $post->update($validatedData);

            return redirect('/posts')->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating post: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the post. Please try again.');
        }
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return Redirect::back()->with('success', 'Post deleted successfully!');
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    // public function search(Request $request)
    // {
    //     $query = $request->input('query');

    //     $posts = Post::where('title', 'like', "%$query%")
    //         ->orWhere('content', 'like', "%$query%")
    //         ->orWhere('excerpt', 'like', "%$query%")
    //         ->get();

    //     return view('posts.search', compact('posts', 'query'));
    // }
}
