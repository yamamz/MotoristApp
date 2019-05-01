
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import App from './App.vue';
import router from './router/index';
import Vuex from 'vuex'
import store from './store/index';
import {initialize} from './helper/general';

Vue.component('App', require('./App.vue'));
Vue.use(BootstrapVue);
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import VueSweetalert2 from 'vue-sweetalert2';

Vue.use(Vuex);


import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'



// configure language
locale.use(lang)

import {ServerTable, ClientTable, Event} from 'vue-tables-2';
Vue.use(ClientTable, {}, false, 'bootstrap4');
Vue.use(ServerTable, {}, false, 'bootstrap4');
Vue.use(Event)


import VeeValidate from 'vee-validate';

const config = {
  aria: true,
  classNames: {},
  classes: false,
  delay: 0,
  dictionary: null,
  errorBagName: 'errors', // change if property conflicts
  events: 'input|blur',
  fieldsBagName: 'formFields',
  i18n: null, // the vue-i18n plugin instance
  i18nRootKey: 'validations', // the nested key under which the validation messages will be located
  inject: true,
  locale: 'en',
  validity: false,
  useConstraintAttrs: true
};

Vue.use(VeeValidate, config);





Vue.use(Vuetify)
const options = {
  confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674'
}

Vue.use(VueSweetalert2, options)

/* eslint-disable no-new */
initialize(store, router);
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  component: {
    App
  }
})
