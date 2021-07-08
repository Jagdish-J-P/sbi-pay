<?php

namespace JagdishJP\SBIPay\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use JagdishJP\SBIPay\Messages\AuthorizationRequest;

class PaymentController extends Controller {

	/**
	 * Initiate the request authorization message to SBI
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function handle(Request $request) {
		return view('SBIPay::redirect_to_bank', [
			'request' => (new AuthorizationRequest)->handle($request->all()),
		]);
	}
}
