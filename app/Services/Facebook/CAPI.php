<?php
namespace App\Services\Facebook;

use App\Constant\OrderPaymentMethodConstant;
use App\Models\Catalog\Product;
use App\Models\Order\OrderAdditionalInfo;
use FacebookAds\Api;
use FacebookAds\Exception\Exception;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;

class CAPI
{

    private $accessToken = null;
    private $pixelId = null;
    private $locale = null;

    public function __construct($locale)
    {
        $this->locale = $locale;
        $this->accessToken = setting_val('TYPE_FB_ACCESS_TOKEN', $locale);
        $this->pixelId = setting_val('TYPE_FB_PIXEL_ID', $locale);
    }

    /**
     * Retrieves tracking information for an array of order numbers
     *
     * @param $order
     * @param string $eventName
     * @param null $eventUrl
     * @return mixed
     */
    public function sendPurchaseEvent($order, $eventName = 'Purchase', $eventUrl = null)
    {
        try {
            $api = Api::init(null, null, $this->accessToken);
            $api->setLogger(new CurlLogger());

            $userData = (new UserData())
                ->setFirstName($order->delivery_first_name)
                ->setLastName($order->delivery_last_name)
                ->setEmail($order->client_email)
                ->setPhone($order->delivery_phone)
                ->setCountryCode($order->locale)
                ->setZipCode($order->delivery_postal_code);

            $deliveryCity = $order->deliveryCity()->first();
            if ($deliveryCity) {
                $userData->setCity($deliveryCity->getFullName());
            }

            $orderAdditionalInfo = OrderAdditionalInfo::where('order_id', '=', $order->id)->get()->first();
            if ($orderAdditionalInfo) {
                $data = json_decode($orderAdditionalInfo->data, 1);
                if (isset($data['fbc']) && !empty($data['fbc'])) {
                    $userData->setFbc($data['fbc']);
                }
                if (isset($data['fbp']) && !empty($data['fbp'])) {
                    $userData->setFbp($data['fbp']);
                }
                $userData->setClientIpAddress($data['ip']);
                $userData->setClientUserAgent($data['user_agent']);
            }

            $productPurchases = [];
            foreach ($order->orderProducts as $orderProduct) {
                $product = $orderProduct->product();
                $productIdentifier = $product->id ?? $orderProduct->model;

                $productPurchases[] = (new Content())
                    ->setProductId($productIdentifier)
                    ->setQuantity($orderProduct->quantity)
                    ->setTitle($orderProduct->title);
            }

            $customData = (new CustomData())
                ->setContents($productPurchases)
                ->setCurrency($order->currency)
                ->setOrderId($order->id)
                ->setValue($order->getTotalInOrderCurrency());

            if (empty($eventUrl)) {
                // if there is additional info ($data is parsed from $orderAdditionalInfo)
                if (isset($data)) {
                    if (isset($data['url_base'])) {
                        $eventUrl = $data['url_base'] . '/thank-you';
                    }
                }
                if (empty($eventUrl)) {
                    $eventUrl = \URL::to('/') . '/thank-you';
                }
            }

            $event = (new Event())
                ->setEventId($order->id)
                ->setEventName($eventName)
                ->setEventTime(time())
                ->setEventSourceUrl($eventUrl)
//                ->setActionSource(OrderPaymentMethodConstant::getActionSource($order->payment_method))
                ->setUserData($userData)
                ->setCustomData($customData);

            // we could use batch events sending for optimization (with cron job)
            $events = [];
            array_push($events, $event);
            $request = (new EventRequest($this->pixelId))
                ->setEvents($events);
            $response = $request->execute();

        } catch (Exception $exception) {

        }
    }

    public function sendAddToCartEvent($cartProduct, $price, $eventUrl, $eventId, $quantity)
    {
        try {
            $api = Api::init(null, null, $this->accessToken);
            $api->setLogger(new CurlLogger());

            $userData = (new UserData());

            $user = auth()->user();
            if ($user) {
                $userData->setEmail($user->email);
            }

            $userData->setClientIpAddress(client_ip());
            $userData->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);
            if (isset($_COOKIE['_fbc'])) {
                $userData->setFbc($_COOKIE['_fbc']);
            }

            if (isset($_COOKIE['_fbp'])) {
                $userData->setFbp($_COOKIE['_fbp']);
            }

            $product = Product::where('id', '=', $cartProduct->product_id)->first();
            $productPurchases = [];
            $productPurchases[] = (new Content())
                ->setProductId($cartProduct->product_id)
                ->setQuantity($quantity)
                ->setTitle($product->translate(locale())->title);

            $customData = (new CustomData())
                ->setContents($productPurchases)
                ->setCurrency(currency(true))
                ->setValue($price);

            $event = (new Event())
                ->setEventId($eventId)
                ->setEventName('AddToCart')
                ->setEventTime(time())
                ->setEventSourceUrl($eventUrl)
                ->setUserData($userData)
                ->setCustomData($customData)
                ->setActionSource(ActionSource::WEBSITE);

            // we could use batch events sending for optimization (with cron job)
            $events = [];

            array_push($events, $event);
            $request = (new EventRequest($this->pixelId))
                ->setEvents($events);
            $response = $request->execute();
        } catch (\Exception $e) {
            // do handling or logging of unsuccessfully sent events
        }
    }
}
