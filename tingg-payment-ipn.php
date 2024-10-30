<?php
//accept these checkout statuses
define("REQUEST_WITH_FULL_PAYMENTS", 178);
define("REQUEST_WITH_ACCEPTABLE_PARTIAL_PAYMENTS", 176);

//reject these checkout statuses
define("REQUEST_HAS_A_FAILED_PAYMENT", 99);
define("REQUEST_EXPIRED_WITHOUT_PAYMENTS", 129);
define("REQUEST_EXPIRED_WITH_PARTIAL_PAYMENTS", 179);

//response statuses
define("UNDETERMINED", 189);
define("REJECT_FULL_PAYMENT", 180);
define("ACCEPT_FULL_PAYMENT", 183);

//load WordPress
$cwd = dirname(__FILE__, 4);
require_once($cwd . DIRECTORY_SEPARATOR . 'wp-load.php');

function sendJsonResponse($res)
{
    header('Content-Type: application/json');
    echo json_encode($res);
    die();
}

function changeOrderStatus($req, $status, $note)
{
    $res = array(
        "statusCode" => UNDETERMINED,
        "checkoutRequestID" => $req->checkoutRequestID,
        "merchantTransactionID" => $req->merchantTransactionID,
        "statusDescription" => "Unable to get the order on WooCommerce."
    );

    try {
        $orderID = str_replace("ORDER#", "", $req->merchantTransactionID);
        $order = new WC_Order($orderID);
        $isOrderUpdated = $order->update_status($status, $note);

        if (!$isOrderUpdated) {
            sendJsonResponse($res);
        }
    } catch (Exception $ex) {
        sendJsonResponse($res);
    }
}

function respond($req)
{
    $checkoutRequestID = $req->checkoutRequestID;
    $requestStatusCode = $req->requestStatusCode;
    $merchantTransactionID = $req->merchantTransactionID;

    $res = array(
        "checkoutRequestID" => $checkoutRequestID,
        "merchantTransactionID" => $merchantTransactionID
    );

    if (in_array($requestStatusCode, array(REQUEST_WITH_FULL_PAYMENTS, REQUEST_WITH_ACCEPTABLE_PARTIAL_PAYMENTS))) {
        changeOrderStatus($req, "processing", "Payment has been accepted.");

        sendJsonResponse(array_merge(
            $res,
            array(
                "statusCode" => ACCEPT_FULL_PAYMENT,
                "statusDescription" => "Payment has been accepted."
            )
        ));
    }

    if (in_array($requestStatusCode, array(REQUEST_HAS_A_FAILED_PAYMENT, REQUEST_EXPIRED_WITHOUT_PAYMENTS, REQUEST_EXPIRED_WITH_PARTIAL_PAYMENTS))) {
        changeOrderStatus($req, "on-hold", "Payment has been rejected.");

        sendJsonResponse(array_merge(
            $res,
            array(
                "statusCode" => REJECT_FULL_PAYMENT,
                "statusDescription" => "Payment has been rejected",
            )
        ));
    }
}

//get POST payload
$requestBody = file_get_contents('php://input');
$requestParams = json_decode($requestBody);
respond($requestParams);


