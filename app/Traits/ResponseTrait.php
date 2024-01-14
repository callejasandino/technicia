<?php

namespace App\Traits;

function forbiddenResponse($message) {
    return response()->json([
        'error' => $message,
    ], 403);
}

function okayResponse($identifier, $message) {
    return response()->json([
        "$identifier" => $message,
    ], 200);
}

function queryResponse($identifier, $result) {
    return response()->json([
        "$identifier" => $result,
    ], 200);
}

function notFoundResponse($message) {
    return response()->json([
        'message' => $message,
    ], 404);
}
