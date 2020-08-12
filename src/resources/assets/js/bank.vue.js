window.vue = require('vue');

require('lodash');

import Vue from 'vue';

import VueResource from 'vue-resource';

import ToggleButton from 'vue-js-toggle-button';

import VueSweetalert2 from 'vue-sweetalert2';

import VuePassword from 'vue-password';

import moment from 'moment';

import Vuelidate from 'vuelidate';
//Finance Account statement

import VueElementLoading from 'vue-element-loading';

//Bank Panel
import CodificarBankPanel from './components/CodificarBankPanel';
import bankpanel from "./pages/panel.vue";
import createbank from "./pages/create.vue";


import VueTheMask from 'vue-the-mask';

import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueTheMask)

Vue.component('VueElementLoading', VueElementLoading);

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('document', require('./components/document.vue'));

Vue.use(VueResource);

Vue.use(VueSweetalert2);

Vue.use(ToggleButton);

Vue.component(VuePassword);

Vue.use(Vuelidate);
Vue.use(VueGoogleMaps, {
    load: {
        key: window.settings ? window.settings.mapsApiKey : null,
        libraries: 'places', // This is required if you use the Autocomplete plugin
    },
    installComponents: true,
});
Vue.use(VueResource);

Vue.component('pagination', require('laravel-vue-pagination'));

//moment
Vue.prototype.moment = moment

//Allows localization using trans()
Vue.prototype.trans = (key) => {
    return _.get(window.lang, key, key);
};
//Tells if an JSON parsed object is empty
Vue.prototype.isEmpty = (obj) => {
    return _.isEmpty(obj);
};
//Works like php number_format
Vue.prototype.number_format = (number, decimals, dec_point, thousands_point) => {

    if (number == null || !isFinite(number)) {
        throw new TypeError("number is not valid");
    }

    if (!decimals) {
        var len = number.toString().split('.').length;
        decimals = len > 1 ? len : 0;
    }

    if (!dec_point) {
        dec_point = '.';
    }

    if (!thousands_point) {
        thousands_point = ',';
    }

    number = parseFloat(number).toFixed(decimals);

    number = number.replace(".", dec_point);

    var splitNum = number.split(dec_point);
    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
    number = splitNum.join(dec_point);

    return number;
}

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
      console.log('main');
  },
});
