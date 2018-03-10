<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Staging Environment
    |--------------------------------------------------------------------------
    |
    | Determines the environment that will be used by Mpesa.
    | can be either true(For live apps already vetted by safaricom and ready 
    | to handle live transactions) or false(For staging, testing and apps still in development) 
    |
    | Possible values: true | false
    | Default: false
    */
    'live' => false,

    /*
    |--------------------------------------------------------------------------
    | Credentials
    |--------------------------------------------------------------------------
    |
    | These are the credentials provided by safaricom to authenticate with the M-Pesa API 
    | so as to be able to transact
    */
    'consumer_key' => '',
    'consumer_secret' => '',
    'production_endpoint' => '',
    'initiator' => 'testapi0297',

    /*
    |--------------------------------------------------------------------------
    | STK Callback URL
    |--------------------------------------------------------------------------
    |
    | This is a fully qualified endpoint that will be be queried by Safaricom's
    | API on completion or failure of the transaction.
    |
    */
    'stk_callback' => '',

    /*
    |--------------------------------------------------------------------------
    | Identity Validation Callback URL
    |--------------------------------------------------------------------------
    |
    | This is a fully qualified endpoint that will be be queried by Safaricom's
    | API on completion or failure of the transaction.
    |
    */
    'identity_validation_callback' => '',

    /*
    |--------------------------------------------------------------------------
    | Callback Method
    |--------------------------------------------------------------------------
    |
    | This is the request method to be used on the Callback URL to enable Mpesa to respond to your server.
    |
    | e.g. GET | POST
    |
    */
    'callback_method' => 'POST',

    /*
    |--------------------------------------------------------------------------
    | Paybill Number
    |--------------------------------------------------------------------------
    |
    | This is a registered Paybill Number that will be used as the Merchant ID
    | on every transaction. This is also the account to be debited.
    |
    |
    */
    'short_code' => 174379,

    /*
    |--------------------------------------------------------------------------
    | SAG Passkey
    |--------------------------------------------------------------------------
    |
    | This is the secret SAG Passkey generated by Safaricom on registration
    | of the Merchant's Paybill Number.
    |
    */
    'passkey' => 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919',
    
    /*
    |--------------------------------------------------------------------------
    | Transaction ID Handler
    |--------------------------------------------------------------------------
    |
    | Provide a fully qualified class name of the Class that will be
    | used to generate the transaction number. This class must implement the
    | Transactable Interface.
    |
    | Default: '\SmoDav\Mpesa\Generator'
    |
    */
    'transaction_id_handler' => '\SmoDav\Mpesa\Generator',
];