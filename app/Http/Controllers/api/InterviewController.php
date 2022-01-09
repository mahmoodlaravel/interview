<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateInterviewRequest;
use App\Http\Resources\InterviewResource;
use App\Models\interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InterviewController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => [
                'interviews' => InterviewResource::collection(interview::latest()->paginate(\request('per_page', 10)))
            ]
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */

    public function show(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['id' => 'required'],
            [
                'id.required' => 'شناسه مصاحبه اجباری ست',
            ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessage(),
                'data' => null
            ], 400);
        }
        $interview = interview::findOrFail($request->input('id'));
        return response()->json([
            'success' => true,
            'message' => '',
            'data' => new InterviewResource($interview)
        ]);
    }

    /**
     * @param CreateInterviewRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function create(CreateInterviewRequest $request)
    {
        try {
            $interview = interview::create($request->only(['title', 'description', 'date']));

            return response()->json([
                'success' => true,
                'message' => 'Interview has been Created Successfully!',
                'data' => new InterviewResource($interview)
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => null
            ],400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['id' => 'required'],
            [
                'id.required' => 'شناسه مصاحبه اجباری ست',
            ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessage(),
                'data' => null
            ], 400);
        }
        try {
            $interview = interview::findOrFail($request->input('id'));
            $interview->update($request->only('title', 'description', 'date'));
            return response()->json([
                'success' => true,
                'message' => '',
                'data' => new InterviewResource($interview)
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => null
            ],400);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function delete(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['id' => 'required'],
            [
                'id.required' => 'شناسه مصاحبه اجباری ست',
            ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->getMessage(),
                'data' => null
            ], 400);
        }

        try {
            $interview = interview::findOrFail($request->input('id'));
            $interview->delete();
            return response()->json([
                'success' => true,
                'message' => 'Interview has been deleted successfully!',
                'data' => null
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
                'data' => null
            ],400);
        }
    }
}
