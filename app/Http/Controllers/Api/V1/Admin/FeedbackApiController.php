<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Http\Resources\Admin\FeedbackResource;
use App\Models\Feedback;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeedbackApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('feedback_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbackResource(Feedback::with(['user', 'transaction'])->get());
    }

    public function store(StoreFeedbackRequest $request)
    {
        $feedback = Feedback::create($request->all());

        if ($request->input('photo', false)) {
            $feedback->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return (new FeedbackResource($feedback))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Feedback $feedback)
    {
        abort_if(Gate::denies('feedback_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FeedbackResource($feedback->load(['user', 'transaction']));
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        $feedback->update($request->all());

        if ($request->input('photo', false)) {
            if (!$feedback->photo || $request->input('photo') !== $feedback->photo->file_name) {
                if ($feedback->photo) {
                    $feedback->photo->delete();
                }

                $feedback->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($feedback->photo) {
            $feedback->photo->delete();
        }

        return (new FeedbackResource($feedback))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Feedback $feedback)
    {
        abort_if(Gate::denies('feedback_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $feedback->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}