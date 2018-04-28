{{-- Variables
  
  @params  $price_decimal     @type Number      Le décimal du prix
  @params  $price_centime     @type Number      Le centime

--}}
<span class="price">
  <span class="price__decimal">{{$price_decimal}}</span><span class="price__separator">.</span><span class="price__centime">{{$price_centime}}</span> <span class="price__devise">€</span>
</span>