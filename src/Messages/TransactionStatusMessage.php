<?php

namespace JagdishJP\SBIPay\Messages;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use JagdishJP\SBIPay\Constant\Response;
use JagdishJP\SBIPay\Contracts\Message as Contract;

class TransactionStatusMessage extends Message implements Contract
{
    protected $url;

    public function __construct()
    {
        parent::__construct();

        $this->url = app()->isLocal()
        ? Config::get('sbipay.urls.uat.transaction_status')
        : Config::get('sbipay.urls.production.transaction_status');
    }

    /**
     * handles message.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function handle($options)
    {
        $data = Validator::make($options, [
            'sbi_transaction_id' => 'required',
            'merchant_order_no'  => 'required',
        ])->validate();

        $this->transactionId   = $data['sbi_transaction_id'];
        $this->merchantOrderNo = $data['merchant_order_no'];

        return $this;
    }

    public function get()
    {
        $client = new Client();
        $res    = $client->request('POST', $this->url, [
            'form_params' => $this->getParams(),
        ]);

        $response = explode('|', $res->getBody());

        foreach ($response as $key => $value) {
            $response[Response::RESPONSE_PARAMETERS_STATUS[$key]] = $value;
            unset($response[$key]);
        }

        return $response;
    }

    public function getParams()
    {
        $params                    = [];
        $params['queryRequest']    = $this->format();
        $params['aggregatorId']    = $this->aggregatorId;
        $params['merchantId']      = $this->merchantId;

        return $params;
    }

    public function list()
    {
        return collect([
            'sbi_transaction_id' => $this->transactionId,
            'merchant_id'        => $this->merchantId,
            'merchant_order_no'  => $this->merchantOrderNo,
        ]);
    }

    public function format()
    {
        return $this->list()->join('|');
    }
}
