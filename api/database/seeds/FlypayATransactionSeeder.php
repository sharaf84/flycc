<?php

use App\Models\Transaction;

class FlypayATransactionSeeder extends TransactionSeeder
{
    public function setProvider()
    {
        $this->provider = Transaction::PROVIDER_FLYPAY_A;
    }

    public function setJsonFilePath()
    {
        $this->jsonFilePath = storage_path('json/transactions/flypay-a.json');
    }

    public function setMappedSchema()
    {
        $this->mappedSchema = [
            'amount'         => 'amount',
            'currency'       => 'currency',
            'statusCode'     => 'status_code',
            'orderReference' => 'order_reference',
            'transactionId'  => 'transaction_id',
        ];
    }

    public function setMappedStatusCode()
    {
        $this->mappedStatusCode = [
            1 => Transaction::STATUS_CODE_AUTHORISED,
            2 => Transaction::STATUS_CODE_DECLINE,
            3 => Transaction::STATUS_CODE_REFUNDED,
        ];
    }
}
