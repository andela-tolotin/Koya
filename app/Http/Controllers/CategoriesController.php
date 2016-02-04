<?php

namespace Koya\Http\Controllers;

use Illuminate\Http\Request;

use Koya\Http\Requests;
use Koya\Http\Controllers\Controller;
use Koya\Libraries\Cloudinary;
use Koya\Repositories\CategoryRepository;
use Koya\Repositories\VideoRepository;

/**
 * Class CategoriesController
 * @package Koya\Http\Controllers
 */
class CategoriesController extends Controller
{
    /**
     * CategoriesController constructor. Initizialises dependencies via DI Injection
     * @param CategoryRepository $categoryRepository
     * @param Cloudinary $cloudinary
     * @param VideoRepository $videoRepo
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        Cloudinary $cloudinary,
        VideoRepository $videoRepo
    )
    {
        $this->categoryRepo = $categoryRepository;
        $this->cloudinary = $cloudinary;
        $this->videoRepo = $videoRepo;
    }

    /**
     * Displays all video categories
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepo->getAllCategories();
        return view('categories.index', compact('categories'));
    }

    /**
     * Displays view for creating a new category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Saves a new category to the database
     * @param Requests\CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Requests\CategoryRequest $request)
    {
        $uploaded_file = $this->cloudinary->upload($request->image);
        $data = [
            'label' => $request->label,
            'cloudinary_id' => $uploaded_file['public_id']
        ];

        //Use the category repository to save the newly created category
        $this->categoryRepo->save($data);
        return redirect('/categories/create')->with('success', 'New category created');
    }

    /**
     * Displays videos in a single category
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        //Gets all video in the category with category_id in the request
        $videos = $this->videoRepo->getVideosByCategory($request->category_id);

        //Gets information of the category being requested
        $category = $this->categoryRepo->getCategoryById($request->category_id);
        return view('categories.show', compact('videos', 'category'));
    }
}
