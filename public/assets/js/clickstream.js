 window.addEventListener("beforeunload", function (e) {
      let obj = {
        id: sessionStorage.id,
        location: JSON.parse(sessionStorage.location || '[]'),
        sessionTime: e.timeStamp,
        clicks: JSON.parse(sessionStorage.click || '[]'),
        path: sessionStorage.path,
        productsAddedToCart: sessionStorage.productsAddedToCart || [],
        productsRemovedFromCart: sessionStorage.productsRemovedFromCart || [],
        moneyInvested: sessionStorage.moneyInvested || 0,
      }

      axios.post(`/api/visit`, obj).then(() => { console.log('ok'); })
      // var confirmationMessage = "\o/";
      // (e || window.event).returnValue = confirmationMessage; //Gecko + IE
      // return confirmationMessage;                            //Webkit, Safari, Chrome
});

navigator.geolocation.watchPosition(function({coords}) {
  sessionStorage.location == undefined ? sessionStorage.location = JSON.stringify({lat: coords.latitude, lng: coords.longitude}): () => {};
});

function loadPage(){
  var path = window.location.href
  if (typeof(Storage) !== 'undefined') {
    clearStorage()
    sessionStorage.id == undefined ? sessionStorage.id = Date.now() : () => {}
    sessionStorage.path !== path ? sessionStorage.path = path : () => {}
  }else console.log('incompatible');  
}

function clickComponent(nameComponent){
  var click = { nameComponent, time:Date.now()}
  var data = sessionStorage.click == undefined ? [click] : [...JSON.parse(sessionStorage.click), click]
  sessionStorage.click = JSON.stringify(data)
}

function addToCartEvent(product){
  var productCart = { product, time:Date.now()}
  var data = sessionStorage.productsAddedToCart == undefined ? 
            [productCart] : [...JSON.parse(sessionStorage.productsAddedToCart), productCart]
  sessionStorage.productsAddedToCart = JSON.stringify(data)
}

function removeFromCartEvent(product){
  var productCart = { product, time:Date.now()}
  var data = sessionStorage.productsRemovedFromCart == undefined ? 
            [productCart] : [...JSON.parse(sessionStorage.productsRemovedFromCart), productCart]
  sessionStorage.productsRemovedFromCart = JSON.stringify(data)
}

function clearStorage(){
  sessionStorage.removeItem('click')
  sessionStorage.removeItem('productsAddedToCart')
  sessionStorage.removeItem('productsRemovedFromCart')
  sessionStorage.removeItem('moneyInvested')
}

function geLocation(){

}
