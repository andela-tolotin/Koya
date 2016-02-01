<?php

namespace Koya\Http\Controllers;

use Illuminate\Http\Request;

use Koya\Http\Requests;
use Koya\Http\Controllers\Controller;
use Koya\Libraries\Cloudinary;
use Koya\Repositories\CategoryRepository;
use Koya\Repositories\VideoRepository;

class CategoriesController extends Controller
{
    public function __construct(CategoryRepository $categoryRepository, Cloudinary $cloudinary, VideoRepository $videoRepo)
    {
        $this->categoryRepo = $categoryRepository;
        $this->cloudinary = $cloudinary;
        $this->videoRepo = $videoRepo;
    }

    public function index()
    {
        $highest_video_categories = 'PHP';
        $categories = $this->categoryRepo->getAllCategories();
        return view('categories.index', compact('categories', 'highest_video_categories'));
    }

    public function create(Request $request)
    {
        return view('categories.create');
    }

    /**
     * @param Requests\CategoryRequest $request
     */
    public function store(Requests\CategoryRequest $request)
    {
        $uploaded_file = $this->cloudinary->upload($request->image);
        $data = [
            'label' => $request->label,
            'cloudinary_id' => $uploaded_file['public_id']
        ];

        $this->categoryRepo->save($data);
        return redirect('/categories/create')->with('success', 'New category created');
    }

    public function show(Request $request)
    {
        $videos = $this->videoRepo->getVideosByCategory($request->category_id);
        $category = $this->categoryRepo->getCategoryById($request->category_id);
        return view('categories.show', compact('videos', 'category'));
    }
}
