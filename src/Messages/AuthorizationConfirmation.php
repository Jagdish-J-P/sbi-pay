<?php

namespace JagdishJP\SBIPay\Messages;

use JagdishJP\SBIPay\Constant\Response;
use JagdishJP\SBIPay\Contracts\Message as Contract;
use JagdishJP\SBIPay\Exceptions\InvalidCertificateException;
use JagdishJP\SBIPay\Exceptions\InvalidRequestException;

class AuthorizationConfirmation extends Message implements Contract {

	public const STATUS_SUCCESS = 'SUCCESS';
	public const STATUS_FAIL = 'FAIL';
	public const STATUS_PENDING = 'PENDING';


	/**
	 * handle a message
	 *
	 * @param array $options
	 * @return mixed
	 */
	public function handle($options) {
		$this->checkSum = @$options['encData'];

		try {
			$this->response = $this->decrypt($this->checkSum);

			if ($this->response['status'] == self::STATUS_SUCCESS) {
				return [
					'status' => self::STATUS_SUCCESS,
					'message' => $this->response['reason']??'Payment is successfull',
					'transaction_id' => $this->foreignId,
					'reference_id' => $this->reference,
				];
			}
			else
			if ($this->response['status'] == self::STATUS_PENDING) {
				return [
					'status' => self::STATUS_PENDING,
					'message' => 'Payment confirmation isreason',
					'transaction_id' => $this->foreignId,
					'reference_id' => $this->reference,
				];
			}

			return [
				'status' => self::STATUS_FAIL,
				'message' => $this->response['reason'] ?? 'Payment Request Failed',
				'transaction_id' => $this->foreignId,
				'reference_id' => $this->reference,
			];
		} catch(InvalidRequestException $e) {
			return [
				'status' => self::STATUS_FAIL,
				'message' => "Failed to verify the request origin",
				'transaction_id' => $this->foreignId,
				'reference_id' => $this->reference,
			];
		}
	}

	/**
	 * Format data for checksum
	 * @return string
	 */
	public function format() {
		$list = collect([
			$this->targetBankBranch ?? '',
			$this->targetBankId ?? '',
			$this->buyerIBAN ?? '',
			$this->buyerId ?? '',
			$this->buyerName ?? '',
			$this->creditResponseStatus ?? '',
			$this->creditResponseNumber ?? '',
			$this->response['status'] ?? '',
			$this->debitResponseNumber ?? '',
			$this->foreignId ?? '',
			$this->foreignTimestamp ?? '',
			$this->makerName ?? '',
			$this->flow ?? '',
			$this->type ?? '',
			$this->merchantId ?? '',
			$this->transactionId ?? '',
			$this->merchantKey ?? '',
			$this->reference ?? '',
			$this->timestamp ?? '',
			$this->amount ?? '',
			$this->currency ?? '',
		]);

		return $list->join('|');
	}
}
