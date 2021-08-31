<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NftResource;
use App\Models\Nft;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Vinkla\Hashids\Facades\Hashids;

class NftController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $nfts = Nft::query()
            ->where('network', $request->get('network', 'testnet'))
            ->where('supply', '>=', 1)
            ->get();

        return NftResource::collection($nfts);
    }

    public function store(Request $request): JsonResponse
    {
        Nft::create([
            'user_id' => $request->user_id,
            'token_id' => $request->token_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'currency' => $request->currency,
            'supply' => $request->supply,
            'fil_address' => $request->fil_address,
            'network' => $request->network,
            'asset' => $request->file('asset')->store('/'),
            'asset_type' => $request->file('asset')->getMimeType()
        ]);

        return response()->json([
            'message' => 'Nft created'
        ], 200);
    }

    public function show(string $nft)
    {
        $nft = Nft::query()
            ->where('id', Hashids::decode($nft))
            ->where('supply', '>=', 1)
            ->firstOrFail();

        return new NftResource($nft);
    }
}
