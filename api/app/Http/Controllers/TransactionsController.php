<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Transaction;


class TransactionsController extends Controller {

    /**
     * @api {get} /payment/transactions List/Filter Transactions
     * @apiName FilterTransactions
     * @apiGroup Payment
     * @apiParam {String} [provider] Filter transactions by provider.
     * @apiParam {String} [statusCode] Filter transactions by status code.
     * @apiParam {String} [currency] Filter transactions by currency.
     * @apiParam {Number} [amountMin] Filter transactions by min amount.
     * @apiParam {Number} [amountMax] Filter transactions by max amount.
     */
    public function index(Request $request) {
        $transaction = new Transaction();
        if ($request->get('provider')){
            $transaction = $transaction->where('provider', $request->get('provider'));
        }
        if ($request->get('statusCode')){
            $transaction = $transaction->where('status_code', $request->get('statusCode'));
        }
        if ($request->get('currency')){
            $transaction = $transaction->where('currency', $request->get('currency'));
        }
        if ($request->get('amountMin')){
            $transaction = $transaction->where('amount', '>=' ,$request->get('amountMin'));
        }
        if ($request->get('amountMax')){
            $transaction = $transaction->where('amount', '<=' ,$request->get('amountMax'));
        }
        return response()->json(['data' => $transaction->get()]);
    }

}
