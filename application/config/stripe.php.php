<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/* 
| ------------------------------------------------------------------- 
|  Stripe API Configuration 
| ------------------------------------------------------------------- 
| 
| You will get the API keys from Developers panel of the Stripe account 
| Login to Stripe account (https://dashboard.stripe.com/) 
| and navigate to the Developers >> API keys page 
| 
|  stripe_api_key            string   Your Stripe API Secret key. 
|  stripe_publishable_key    string   Your Stripe API Publishable key. 
|  stripe_currency           string   Currency code. 
*/ 
$config['stripe_api_key']         = 'pk_test_vJ4le6Wr7z1Xz57l4QzJLBxz00ttl0Q6bf'; 
$config['stripe_publishable_key'] = 'sk_test_m6ralmqBsA6ced5QaIyizpv400mdYo3UVO'; 
$config['stripe_currency']        = 'usd';