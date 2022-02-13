<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetCategoryRequest;
use App\Libraries\ResponseBase;
use App\Models\Category;
use App\Repository\CategoryRepository;

class CategoryController extends Controller
{

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(GetCategoryRequest $request)
    {
        try {

            $category = $this->categoryRepository->getData($request);
            if (!$category['status'])
                throw new \Exception($category['message']);

            $response = [
                'data' => $category['data']
            ];

            return ResponseBase::success($response);

        } catch (\Exception $e) {
            return ResponseBase::error(400, $e->getMessage());
        }
    }
}