<?php

namespace JagdishJP\SBIPay\Messages;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use JagdishJP\SBIPay\Constant\Response;
use JagdishJP\SBIPay\Contracts\Message as Contract;

class RefundRequestMessage extends Message implements Contract
{
    protected $url;

    public function __construct()
    {
        parent::__construct();

        $this->url = app()->isLocal()
            ? Config::get('sbipay.urls.uat.initiate_refund')
            : Config::get('sbipay.urls.production.initiate_refund');

        // override URL if Refund Request to be encrypted
        if ($this->encryptRefundRequest) {
            $this->url = app()->isLocal()
                ? Config::get('sbipay.urls.uat.initiate_refund_enc')
                : Config::get('sbipay.urls.production.initiate_refund_enc');
        }
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
            'refund_order_no' => 'required',
            'sbi_transaction_id' => 'required',
            'merchant_order_no' => 'required',
            'refund_amount' => 'required|integer',
        ])->validate();

        $this->transactionId   = $data['sbi_transaction_id'];
        $this->merchantOrderNo = $data['merchant_order_no'];
        $this->refundOrderNo   = $data['refund_order_no'];
        $this->amount          = $data['refund_amount'];

        return $this;
    }

    public function post()
    {
        $client = new Client();
        $res    = $client->request('POST', $this->url, [
            'form_params' => $this->getParams(),
        ]);

        $response = $res->getBody();
        if($this->encryptRefundRequest)
            $response = $this->decrypt($response);

        $response = explode('|', $response);

        foreach ($response as $key => $value) {
            $response[Response::RESPONSE_PARAMETERS_REFUND[$key]] = $value;
            unset($response[$key]);
        }

        return $response;
    }

    public function getParams()
    {
        $params                     = [];
        $params['refundRequest']    = ($this->encryptRefundRequest
            ? $this->encrypt($this->format())
            : $this->format());
        $params['aggregatorId']     = $this->aggregatorId;
        $params['merchantId']       = $this->merchantId;

        return $params;
    }

    public function list()
    {
        return collect([
            'aggregator_id'      => $this->aggregatorId,
            'merchant_id'        => $this->merchantId,
            'refund_order_no' => $this->refundOrderNo,
            'sbi_transaction_id' => $this->transactionId,
            'refund_amount'      => $this->amount,
            'currency' => $this->currency,
            'merchant_order_no'  => $this->merchantOrderNo,
        ]);
    }

    public function format()
    {
        return $this->list()->join('|');
    }
}
