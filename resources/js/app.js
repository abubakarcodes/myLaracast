/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../../node_modules/holderjs/holder');
require('sweetalert2');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('login-modal', require('./components/LoginModal.vue').default);
Vue.component('registration-form', require('./components/RegistrationFormModal.vue').default);
Vue.component('logout', require('./components/Logout.vue').default);
Vue.component('series', require('./components/Series.vue').default);
Vue.component('series-lessons', require('./components/SeriesLessons.vue').default);
Vue.component('vimeo-player', require('./components/VimeoPlayer.vue').default);
Vue.component('checkout', require('./components/Checkout.vue').default);







/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
