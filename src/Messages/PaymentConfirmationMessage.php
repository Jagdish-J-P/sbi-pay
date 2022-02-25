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
            return $this->decrypt($this->checkSum);
        } catch (InvalidRequestException $e) {
            return [
                'status'         => self::STATUS_FAIL,
                'message'        => 'Failed to verify the request origin',
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
