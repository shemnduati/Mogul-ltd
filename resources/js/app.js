require('./bootstrap');


import { createRouter, createWebHistory } from 'vue-router';
import { createApp } from 'vue';
//sweetalert
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
//Modal
import 'vue-universal-modal/dist/index.css'
import VueUniversalModal from 'vue-universal-modal'

let routes = [
    
    { path: '/orders', component: require('./components/Orders.vue').default },
    { path: '/fleet', component: require('./components/Fleet.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/location', component: require('./components/Location.vue').default },
    { path: '/vehicleStatus', component: require('./components/VehicleStatus.vue').default },
    { path: '/delivery', component: require('./components/Delivery.vue').default },
    { path: '/deliveryStatus', component: require('./components/DeliveryStatus.vue').default },
];
const router = createRouter({
    history: createWebHistory(),
    routes
  })



 
  const app = createApp({
    /* root component options */
  })


  // Make sure to _use_ the router instance to make the
  // whole app router-aware.
  app.use(router)
  app.use(VueSweetalert2);

  app.mount('#app')
  

