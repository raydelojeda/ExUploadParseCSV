<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once FCPATH . 'assets/stripe/stripe-php/init.php';

class StripeGateway
{
    public $key = '';

    function  __construct()
    {
        $this -> setApiKey('sk_test_m9gOeQi3n5faijwq0yKOEng600DyAlXQMd');
    }

    function setApiKey($key)
    {
        $this->$key = $key;
        \Stripe\Stripe::setApiKey($key);
    }

    function createProduct($arrData)
    {
        $arrProduct['name'] = $arrData['productName'];
        $arrProduct['type'] = $arrData['service'];

        $product = \Stripe\Product::create($arrProduct);

        return $product;
    }



    function createPlan($arrData)
    {
        $arrPlan['productID'] = $arrData['productID'];
        $arrPlan['nickname'] = $arrData['nickname'];
        $arrPlan['interval'] = $arrData['interval'];
        $arrPlan['currency'] = $arrData['currency'];
        $arrPlan['amount'] = $arrData['amount'];

        $plan = \Stripe\Plan::create($arrPlan);

        return $plan;
    }

    function getPlanBy($arrData)
    {
        $plan = \Stripe\Plan::all($arrData);//var_dump($plan);

        return $plan;
    }



    function createCustomer($arrData)
    {
        $arrPlan['email'] = $arrData['clientEmail'];

        $customer = \Stripe\Customer::create($arrPlan);

        return $customer;
    }

    function getCustomerBy($arrData)
    {
        $customers = \Stripe\Customer::all($arrData);

        return $customers;
    }

    function getCustomerSource($arrData)
    {
        $sources = \Stripe\Customer::allSources($arrData['customer'], array('limit' => 3, 'object' => 'card'));

        return $sources;
    }

    function retrieveCustomer($arrData)
    {
        $sources = \Stripe\Customer::retrieve($arrData['customer']);

        return $sources;
    }

    function updateCustomer($arrData)
    {
        $customer = \Stripe\Customer::update($arrData['customerID'], $arrData['extraData']);

        return $customer;
    }



    function createSubscription($arrData)
    {
        $arrSubscription['customer'] = $arrData['customerID'];
        $arrSubscription['items'] = $arrData['items'];

        $subscription = \Stripe\Subscription::create($arrSubscription);

        return $subscription;
    }

    function getSubscriptionBy($arrData)
    {
        $subscriptions = \Stripe\Subscription::all($arrData);

        return $subscriptions;
    }

    function retrieveSubscriptionBy($arrData)
    {
        $subscriptions = \Stripe\Subscription::retrieve($arrData);

        return $subscriptions;
    }

    function updateSubscription($ID, $arrData)
    {
        $subscription = \Stripe\Subscription::update($ID, $arrData);

        return $subscription;
    }



    function createPaymentMethod($arrData)
    {
        $plan = \Stripe\PaymentMethod::create($arrData);

        return $plan;
    }

    function attachPaymentMethodToCustomer($arrData)
    {
        $payment_method = \Stripe\PaymentMethod::retrieve($arrData['paymentMethod']);
        $attach = $payment_method->attach(array('customer' => $arrData['customerID']));

        return $attach;
    }

    function getPaymentMethodBy($arrData)
    {
        $paymentMethod = \Stripe\PaymentMethod::all($arrData);

        return $paymentMethod;
    }



    function createToken($arrData)
    {
        $token = \Stripe\Token::create($arrData);

        return $token;
    }



    function createCard($arrData)
    {
        $card = \Stripe\Customer::createSource($arrData['customer'], $arrData['card']);

        return $card;
    }

    function deleteCard($arrData)
    {
        $deletedCard = \Stripe\Customer::deleteSource($arrData['customer'], $arrData['card']);

        return $deletedCard;
    }

    function getCardBy($arrData)
    {
        $cards = \Stripe\Customer::allSources($arrData['customer'], $arrData['type']);

        return $cards;
    }
}

