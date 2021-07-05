<?php

namespace JagdishJP\SBIPay\Messages;

use JagdishJP\SBIPay\Constant\Type;
use JagdishJP\SBIPay\Contracts\Message as Contract;
use JagdishJP\SBIPay\Traits\Encryption;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthorizationRequest extends Message implements Contract
{
	use Encryption;

	/**
	 * Message code on the SBI side
	 */
	public const CODE = 'AR';


	/**
	 * Message Url
	 */
	public $url;


	public function __construct()
	{
		parent::__construct();

		$this->url = App::environment('production')
			? Config::get('sbi-pay.urls.production.initiate_payment')
			: Config::get('sbi-pay.urls.uat.initiate_payment');
	}

	/**
	 * handle a message
	 *
	 * @param array $options
	 * @return mixed
	 */
	public function handle($options)
	{
		$data = Validator::make($options, [
			'flow' => ['required', Rule::in([Type::FLOW_B2C])],
			'reference_id' => 'required',
			'datetime' => 'nullable',
			'currency' => 'nullable',
			'product_description' => 'required',
			'amount' => 'required',
			'customer_name' => 'required',
			'customer_email' => 'required',
			'bank_id' => 'required',
		])->validate();


		$this->type = self::CODE;
		$this->flow = $data['flow'];
		$this->reference = $data['reference_id'];
		$this->timestamp = $data['datetime'] ?? date("YmdHis");
		$this->currency = $data['currency'] ?? $this->currency;
		$this->productDescription = $data['product_description'];
		$this->amount = $data['amount'];
		$this->buyerEmail = $data['customer_email'];
		$this->buyerName = $data['customer_name'];
		$this->targetBankId = $data['bank_id'];
		$this->checkSum = $this->encrypt($this->format());

		return $this;
	}


	/**
	 * Format data for checksum
	 * @return string
	 */
	public function format()
	{
		$list = collect([
			$this->buyerAccountNumber ?? '',
			$this->targetBankBranch ?? '',
			$this->targetBankId ?? '',
			$this->buyerEmail ?? '',
			$this->buyerIBAN ?? '',
			$this->buyerId ?? '',
			$this->buyerName ?? '',
			$this->buyerMakerName ?? '',
			$this->flow ?? '',
			$this->type ?? '',
			$this->productDescription ?? '',
			$this->aggregatorId ?? '',
			$this->merchantId ?? '',
			$this->transactionId ?? '',
			$this->merchantKey ?? '',
			$this->reference ?? '',
			$this->timestamp ?? '',
			$this->amount ?? '',
			$this->currency ?? '',
			$this->version ?? '',
		]);

		return $list->join('|');
	}
}
