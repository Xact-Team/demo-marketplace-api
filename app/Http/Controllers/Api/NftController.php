<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NftResource;
use App\Models\Nft;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;
use Vinkla\Hashids\Facades\Hashids;

class NftController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $nfts = Nft::query()
            ->where(function ($query) use ($request) {
                if ($request->has('network')) {
                    $query->where('network', $request->get('network', 'testnet'));
                }
            })
            ->where('supply', '>=', 1)
            ->latest()
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
            'asset' => $request->file('asset')->storeAs('/', $this->getFileName($request)),
            'asset_type' => $this->getFileMimeType($request)
        ]);

        return response()->json([
            'message' => 'Nft created'
        ], 200);
    }

    public function show(string $nft): NftResource
    {
        $nft = Nft::query()
            ->where('id', Hashids::decode($nft))
            ->where('supply', '>=', 1)
            ->firstOrFail();

        return new NftResource($nft);
    }

    private function getFileMimeType(Request $request): string
    {
        return $this->is3DFile($request)
            ? 'model/gltf-binary'
            : $request->file('asset')->getMimeType();
    }

    private function getFileName(Request $request): string
    {
        return Str::random(40) . '.' . $this->getFileExtension($request);
    }

    private function is3DFile(Request $request): bool
    {
        $file = $this->getFileExtension($request);

        return $file === 'gltf' || $file === 'glb';
    }

    private function getFileExtension(Request $request): string
    {
        return $request->file('asset')->getClientOriginalExtension();
    }
}
