import './bootstrap';
import $ from 'jquery';
//import * as $ from 'jquery'

//import Vue3EasyDataTable from 'vue3-easy-data-table';
//import 'vue3-easy-data-table/dist/style.css';

//import Autocomplete from 'vue-autocomplete';

import SelectOption from 'vue3-select-option-search'
import "vue3-select-option-search/dist/style.css"

import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

import VueGoodTablePlugin from 'vue-good-table-next';

// import the styles 
import 'vue-good-table-next/dist/vue-good-table-next.css'

import Toaster from '@meforma/vue-toaster'
import 'admin-lte/plugins/jquery/jquery.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js';
import 'admin-lte/dist/js/adminlte.min.js';


import emitter from './eventLoader.js';
import DataTablesPlugin from './dataTablesPlugin.js';
import { createApp } from 'vue/dist/vue.esm-bundler.js';

import { createRouter, createWebHistory } from 'vue-router';
import LoaderComponent from './components/LoaderComponent.vue';

import sales from './components/items/sales.vue';
import products from './components/items/products.vue';
import dailysales from './components/salesreport/daily.vue';
import allSales from './components/salesreport/all.vue';
import dashboard from './components/items/dashboard.vue';



const routes = [

  
  {path:'/products' , component:products},
  {path:'/dailyreport', component:dailysales} ,
  {path:'/dailyreports', component:allSales} ,
  {path: '/sales', component:sales},
  {path: '/dashboard', component:dashboard},

];


const app = createApp({});

//var Emitter = require('tiny-emitter')
//window.emitter = new Emitter()
//export const emitter = new Emitter();
app.config.globalProperties.$emitter = emitter;


window.jQuery = window.$ = $
//window.Dropzone = Dropzone

const router = createRouter({
  history: createWebHistory(),
  routes,
});

app.use(DataTablesPlugin);
app.component('loader-component', LoaderComponent)
app.component("v-select", vSelect);
app.use(VueGoodTablePlugin);
app.use(SelectOption);

//app.component('v-autocomplete', Autocomplete);

//app.component('EasyDataTable', Vue3EasyDataTable);



app.use(Toast, {
  autoClose: 3000,
  position: 'top-right',
  theme: 'light',
  pauseOnFocusLoss: false,
} );

app.use(router);
app.mount('#app');
app.use(Toaster)