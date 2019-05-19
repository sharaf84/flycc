<?php

use App\Models\Transaction;

class FlypayBTransactionSeeder extends TransactionSeeder {
    
    
    public function setProvider(){
        $this->provider = Transaction::PROVIDER_FLYPAY_B;
    }
    
    public function setJsonFilePath(){
        $this->jsonFilePath = storage_path('json/transactions/flypay-b.json');
    }
    
    public function setMappedSchema(){
        $this->mappedSchema = [
            'value' => 'amount',
            'transactionCurrency' => 'currency',
            'statusCode' => 'status_code',
            'orderInfo' => 'order_reference',
            'paymentId' => 'transaction_id',
        ];
    }
    
    public function setMappedStatusCode(){
        $this->mappedStatusCode = [
            100 => Transaction::STATUS_CODE_AUTHORISED,
            200 => Transaction::STATUS_CODE_DECLINE,
            300 => Transaction::STATUS_CODE_REFUNDED
        ];
    }

}
