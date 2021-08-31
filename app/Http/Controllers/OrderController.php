<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Nft;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Vinkla\Hashids\Facades\Hashids;

class OrderController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $orders = Order::all();
        return OrderResource::collection($orders);
    }

    public function store(Request $request): JsonResponse
    {
        $nft = Nft::where('id', Hashids::decode($request->nft_id))->first();
        $nft->update([
            'supply' => $nft->supply - 1
        ]);

        Order::create([
            'nft_id' => $nft->id,
            'buyer_id' => $request->buyer_id,
            'transaction_id' => $request->tx_id
        ]);

        return response()->json([
            'message' => 'NFT purchased.'
        ], 200);
    }

    public function update(Request $request, string $order): JsonResponse
    {
        abort_unless($this->isMiddlemanAccount($request), 403, 'This action is unauthorized');

        $order = Order::where('id', Hashids::decode($order))->first();
        $order->update([
            'confirmed_at' => now()
        ]);

        return response()->json([
            'message' => 'Request successful'
        ], 200);
    }

    private function isMiddlemanAccount(Request $request): bool
    {
        return $request->network === 'testnet'
            ? $request->secret === env('MIDDLEMAN_TESTNET_PRIVATE')
            : $request->secret === env('MIDDLEMAN_MAINNET_PRIVATE');
    }
}
