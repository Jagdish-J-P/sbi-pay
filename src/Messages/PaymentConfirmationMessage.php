<?php

namespace JagdishJP\SBIPay\Messages;

use JagdishJP\SBIPay\Contracts\Message as Contract;
use JagdishJP\SBIPay\Exceptions\InvalidRequestException;

class PaymentConfirmationMessage extends Message implements Contract
{
    public const STATUS_SUCCESS = 'SUCCESS';

    public const STATUS_FAIL = 'FAIL';

    public const STATUS_PENDING = 'PENDING';

    /**
     * handle a message.
     *
     * @param array $options
     *
     * @return mixed
     */
    public function handle($options)
    {
        $this->checkSum = @$options['encData'];

        try {
            $this->response = $this->decrypt($this->checkSum);

            if ($this->response['status'] == self::STATUS_SUCCESS) {
                return [
                    'status'         => self::STATUS_SUCCESS,
                    'message'        => $this->response['reason'] ?? 'Payment is successfull',
                    'transaction_id' => $this->transaction_id,
                    'reference_id'   => $this->reference,
                ];
            }

            if ($this->response['status'] == self::STATUS_PENDING) {
                return [
                    'status'         => self::STATUS_PENDING,
                    'message'        => 'Payment confirmation isreason',
                    'transaction_id' => $this->transaction_id,
                    'reference_id'   => $this->reference,
                ];
            }

            return [
                'status'         => self::STATUS_FAIL,
                'message'        => $this->response['reason'] ?? 'Payment Request Failed',
                'transaction_id' => $this->transaction_id,
                'reference_id'   => $this->reference,
            ];
        } catch (InvalidRequestException $e) {
            return [
                'status'         => self::STATUS_FAIL,
                'message'        => 'Failed to verify the request origin',
                'transaction_id' => $this->transaction_id,
                'reference_id'   => $this->reference,
            ];
        }
    }

    /**
     * Format data for checksum.
     *
     * @return string
     */
    public function format()
    {
        return '';
    }
}
