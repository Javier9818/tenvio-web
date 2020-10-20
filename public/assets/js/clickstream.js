 window.addEventListener("beforeunload", function (e) {
      let obj = {
        id: parseInt(sessionStorage.id),
        idEmpresa: sessionStorage.idEmpresa || 0,
        location: JSON.parse(sessionStorage.location || '[]'),
        device: sessionStorage.device || '',
        user: sessionStorage.user || 0,
        sessionTime: e.timeStamp,
        clicks: JSON.parse(sessionStorage.click || '[]'),
        path: sessionStorage.path,
        productsAddedToCart: JSON.parse(sessionStorage.productsAddedToCart || '[]'),
        productsRemovedFromCart: JSON.parse(sessionStorage.productsRemovedFromCart || '[]'),
        moneyInvested: sessionStorage.moneyInvested || 0,
        paymentMethod: sessionStorage.paymentMethod || 0,
      }
      axios.post(`https://tenvio.herokuapp.com/visit`, obj)
      var confirmationMessage = "\o/";
      (e || window.event).returnValue = confirmationMessage; //Gecko + IE
      return confirmationMessage;                            //Webkit, Safari, Chrome
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
  // loadBigData()
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

function isMobile(){
  return (
      (navigator.userAgent.match(/Android/i)) ||
      (navigator.userAgent.match(/webOS/i)) ||
      (navigator.userAgent.match(/iPhone/i)) ||
      (navigator.userAgent.match(/iPod/i)) ||
      (navigator.userAgent.match(/iPad/i)) ||
      (navigator.userAgent.match(/BlackBerry/i)) ||
      (navigator.userAgent.match(/Chrome/i)) ||
      (navigator.userAgent.match(/Edg/i)) ||
      (navigator.userAgent.match(/Mozilla/i)) ||
      (navigator.userAgent.match(/Safari/i))
  );
}

//***********************FUNCION MAGICA */

async function loadBigData(){
  const device = [
    'Android',
    'iPhone',
    'iPad',
    'BlackBerry',
    'Chrome',
    'Edg',
    'Mozilla',
    'Safari'
  ]
  // const paymentMethod = [
  //   1,//YAPE
  //   2,//PLIN
  //   3,//TUNKI
  //   4,//TRANFERENCIA BANCARIA
  //   5,// CULQI
  //   6,//CONTRA ENTREGA
  // ]

  let datajson = {
    id: 0,
    location: {
      lat: -8.1191,
      lng: -79.0355
    },
    device: '',
    sessionTime:0,
    clicks: [],
    path: '/empresa',
    productsAddedToCart: [],
    productsRemovedFromCart: [],
    moneyInvested: 0,
    paymentMethod: 0,
  }
  axios.get(`https://api.tenvioperu.com/empresa`).then(({data}) => {

    setInterval(() => {
      var productsAddedToCart = [], productsRemovedFromCart= []
      var moneyInvested = 0
      var paymentMethod = Math.floor(Math.random() * (6)) +1
      var {id} = data[Math.floor(Math.random() * (data.length))]
      axios.get(`https://api.tenvioperu.com/empresa/productos/${id}`).then((payload) => {
        var productos = payload.data.productos
        var prandon = Math.floor(Math.random() * 4), prandon_r = Math.floor(Math.random() * 4)
        console.log(prandon, prandon_r)
        for (let j = 0; j <prandon ; j++) {
          var productSelected = productos[Math.floor(Math.random() * (productos.length))]
          moneyInvested += productSelected.precio
          productsAddedToCart.push(productSelected)
        }
        for (let j = 0; j < prandon_r; j++) {
          var productRemoved = productos[Math.floor(Math.random() * (productos.length))]
          productsRemovedFromCart.push(productRemoved)
        }
      }).then(() => {
        axios.post(`https://tenvio.herokuapp.com/visit`, {
          id: (Math.random() * 80000) + 20000,
          idEmpresa: id,
          user: Math.round(Math.random()*100),
          location: {
            lat: -8.1191,
            lng: -79.0355
          },
          device: device[Math.round(Math.random() * device.length)],
          sessionTime: (Math.random() * 80000),
          clicks: [],
          path: '/empresa',
          productsAddedToCart,
          productsRemovedFromCart,
          moneyInvested,
          paymentMethod,
        }).then(() => { console.log('ok'); })
      }).then(() => {
        productsAddedToCart = []
        productsRemovedFromCart = []
      });
    }, 1000);
  });
}
