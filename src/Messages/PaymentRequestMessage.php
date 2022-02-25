<?php

namespace JagdishJP\SBIPay\Messages;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use JagdishJP\SBIPay\Contracts\Message as Contract;
use JagdishJP\SBIPay\Traits\Encryption;

class PaymentRequestMessage extends Message implements Contract
{
    use Encryption;

    /** Request Url */
    public $url;

    public function __construct()
    {
        parent::__construct();
        //$this->init();

        $this->url = ! app()->isLocal()
            ? Config::get('sbipay.urls.production.initiate_payment')
            : Config::get('sbipay.urls.uat.initiate_payment');
    }

    /**
     * handle a message.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function handle($options)
    {
        $data = Validator::make($options, [
            'order_no'                       => 'required',
            'remark'                         => 'required',
            'amounts.*'                      => 'numeric|required',
            'account_identifiers.*'          => 'required',
        ])->validate();

        $this->merchantOrderNo          = $data['order_no'];
        $this->otherInformation         = $data['remark'];

        $this->amount                   = 0;
        foreach ($data['account_identifiers'] as $key => $accountIdentifier) {
            $this->multiAccountDetails[$key][]   = $data['amounts'][$key];
            $this->multiAccountDetails[$key][]   = $this->currency;
            $this->multiAccountDetails[$key][]   = $accountIdentifier;
            $this->amount += $data['amounts'][$key];
        }

        $this->checkSum                 = $this->encrypt($this->format());
        $this->multiAccountCheckSum     = $this->encrypt($this->formatMultiAccountData($this->multiAccountDetails));

        return $this;
    }

    /**
     * Format data for checksum.
     *
     * @return string
     */
    public function format()
    {
        $list = collect([
            $this->merchantId ?? '',
            $this->operatinMode ?? '',
            $this->country ?? '',
            $this->currency ?? '',
            $this->amount ?? '',
            $this->otherInformation ?? '',
            $this->successUrl ?? '',
            $this->failUrl ?? '',
            $this->aggregatorId ?? '',
            $this->merchantOrderNo ?? '',
            $this->merchantCustomerId ?? '',
            $this->payMode ?? '',
            $this->accessMedium ?? '',
            $this->transactionSource ?? '',
        ]);

        return $list->join('|');
    }

    /**
     * Format data for multiple account checksum.
     *
     * @param mixed $data
     *
     * @return string
     */
    public function formatMultiAccountData($data)
    {
        return collect($data)->map(function ($items) {
            return collect($items)->join('|');
        })->join('||');
    }
}
