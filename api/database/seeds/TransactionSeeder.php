<?php

use App\Models\Transaction;
use Illuminate\Database\Seeder;

abstract class TransactionSeeder extends Seeder
{
    /**
     * Property to save the provider name.
     *
     * ex: Transaction::PROVIDER_FLYPAY_A
     *
     * @var string
     */
    protected $provider;

    /**
     * Property to save the path of the JSON file to be seeded.
     *
     * @var string
     */
    protected $jsonFilePath;

    /**
     * Property to save the mapped schema for the JSON file as [jsonKey => dbField, ...].
     *
     * ex: ['statusCode' => 'status_code', ...]
     *
     * @var array
     */
    protected $mappedSchema;

    /**
     * Property to save the mapped status code for the JSON file.
     *
     * ex: [1 => Transaction::STATUS_CODE_AUTHORISED, ...]
     *
     * @var array
     */
    protected $mappedStatusCode;

    /**
     * Property to save the JSON file transactions as an array.
     *
     * @var array
     */
    protected $transactions;

    public function __construct()
    {
        $this->setProvider();
        $this->setJsonFilePath();
        $this->setMappedSchema();
        $this->setMappedStatusCode();
        $this->setTransactions();
    }

    /**
     * Sets the $provider property.
     */
    abstract public function setProvider();

    /**
     * Sets the $jsonFilePath property.
     */
    abstract public function setJsonFilePath();

    /**
     * Sets the $mappedSchema property.
     */
    abstract public function setMappedSchema();

    /**
     * Sets the $mappedStatusCode property.
     */
    abstract public function setMappedStatusCode();

    /**
     * Sets the $transactions property.
     */
    public function setTransactions()
    {
        $this->transactions = json_decode(
                file_get_contents($this->jsonFilePath, true))->transactions;
    }

    /**
     * Maps the transaction data to be ready to save in the database.
     *
     * @param array $transaction
     *
     * @return array
     */
    public function getTransactionDataMapping($transaction)
    {
        $data = ['provider' => $this->provider];
        foreach ($this->mappedSchema as $jsonKey => $dbField) {
            $data[$dbField] = ($dbField === 'status_code')
                ? $this->mappedStatusCode[$transaction->$jsonKey]
                : $transaction->$jsonKey;
        }

        return $data;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $failed = 0;
        foreach ($this->transactions as $transaction) {
            try {
                Transaction::create($this->getTransactionDataMapping($transaction));
            } catch (Exception $exc) {
                $failed++;
                echo $exc->getTraceAsString();
                echo "\n # Failed to save transaction: \n";
                print_r($transaction);
            }
        }
        echo '# Transactions seeded: '.(count($this->transactions) - $failed)
                .' of total: '.count($this->transactions)."\n";
    }
}
