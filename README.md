# Toptrans API wrapper

This wrapper is to simplify communication with Toptrans API:

* https://zp.toptrans.cz/docs/api.html
* https://zp.toptrans.cz/docs/data.html
* api requires the same login as: https://zp.toptrans.cz/

Implemented Toptrans endpoints:

* **/order/list** by `OrderListMethod::class`
* **/order/price** by `OrderPriceMethod::class`
* **/order/save** by `OrderSaveMethod::class`
* **/order/search** by `OrderSearchMethod::class`

Useage:

```php
    $order = new Order();
    $order->setLoading($loading)
        ->setDischarge($discharge)
        ->setPacks($packs)
        ->setOrderValue($orderValue)
    // build order entity here ...

    $method = new OrderSaveMethod($order)
    $request = new Request ('userName', 'password');

    try {
        $response = $method->sendRequest($request)
    } catch (ResponseStatusException $e) {
        // handle Exception
    }
```


