window.vue = require('vue');

require('lodash');

import Vue from 'vue';

import VueResource from 'vue-resource';

import ToggleButton from 'vue-js-toggle-button';

import VueSweetalert2 from 'vue-sweetalert2';

import Vuelidate from 'vuelidate';

import VueElementLoading from 'vue-element-loading';

//Bank Panel
import CodificarBankPanel from './components/CodificarBankPanel';
import bankpanel from "./pages/panel.vue";
import createbank from "./pages/create.vue";

import VueTheMask from 'vue-the-mask';

Vue.use(VueTheMask)

Vue.component('VueElementLoading', VueElementLoading);

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(VueResource);

Vue.use(VueSweetalert2);

Vue.use(ToggleButton);

Vue.use(Vuelidate);

Vue.use(VueResource);

Vue.component('pagination', require('laravel-vue-pagination'));

//Allows localization using trans()
Vue.prototype.trans = (key) => {
    return _.get(window.lang, key, key);
};
//Tells if an JSON parsed object is empty
Vue.prototype.isEmpty = (obj) => {
    return _.isEmpty(obj);
};

//Main vue instance
new Vue({
  el: "#VueJs",

  data: {},

  components: {
    CodificarBankPanel,
    bankpanel,
    createbank,
  },

  created: function() {
  },
});
