<?php

namespace JagdishJP\SBIPay\Constant;

class Response
{
	/**
	 * constant to name response parameters
	 */
	public const RESPONSE_PARAMETERS = [
		/*
			Merchant Reference Order no
		*/
		'merchantOrderNo',

		/*
			SBI Transactin ID
		*/
		'transaction_id',

		/*
			Transaction status [SUCCESS, FAIL, PENDING]
		*/
		'status',

		/*
			Transaction Amount
		*/
		'amount',

		/*
			Currency code
		*/
		'currency',

		/*
			Payment Mode [IMPS, NB, CC, DC]
		*/
		'payMode',

		/*
			Extra details sent while initiating transaction
		*/
		'extraDetails',

		/*
			Reason for transaction failure
		*/
		'reason',

		/*
			Bank code
		*/
		'bankCode',

		/*
			Bank reference number
		*/
		'bankReferenceNumber',

		/*
			Transaction date (Format: Y-m-d H:i:s)
		*/
		'transactionDate',

		/*
			Country code
		*/
		'country',

		/*
			Challan Identification number generated for Government merchant.
			Format:
			MerchantID (7CHAR)+date
			YYYYMMDD (8 CHAR)+running
			number(5 CHAR). It will be
			generated only for successful
			transactions. For failed
			transaction, its value would be
			“NA”
		*/
		'CIN',

		/*
			Reserve fields for future purpose [ref1 - ref9]
 		*/
		'ref1',
		'ref2',
		'ref3',
		'ref4',
		'ref5',
		'ref6',
		'ref7',
		'ref8',
		'ref9',
	];
}
