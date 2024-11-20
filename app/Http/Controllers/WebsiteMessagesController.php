<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\ApiResponseClass;
use App\Models\WebsiteMessages;
use App\Http\Requests\BatchFetchMessageRequest;

class WebsiteMessagesController extends Controller
{
    public function fetchMessage(Request $request) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('fetch website messages')) {
            return ApiResponseClass::sendResponse([], 'You don\'t have permission to fetch website messages.', false, 401);
        }

        $name = $request->query('name');
        $message = WebsiteMessages::where('name', $name)->first();
        return ApiResponseClass::sendResponse($message, 'Message fetched successfully');
    }

    public function batchFetchMessages(BatchFetchMessageRequest $request) {
        $user = auth('sanctum')->user();

        if (!$user->hasPermissionTo('batch fetch website messages')) {
            return ApiResponseClass::sendResponse([], 'You don\'t have permission to batch fetch website messages.', false, 401);
        }

        $validated = $request->validated();
        $messages = WebsiteMessages::whereIn('name', $validated['names'])->get();
        return ApiResponseClass::sendResponse($messages, 'Messages fetched successfully');
    }
}
