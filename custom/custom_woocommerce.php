<?php
  function custom_woocommerce_free_shipping($rates, $package){
    echo "<h1>AURELIO</h1>";
    $states = array("SP", "RJ");
    if(isset($rates['free_shipping']) && !in_array(WC()->customer->shipping_state, $states)){
      unset($rates['free_shipping']);
    }
    return $rates;
  }
add_filter("woocommerce_package_rates", "custom_woocommerce_free_shipping", 10, 2);
