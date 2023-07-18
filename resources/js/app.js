import.meta.glob([
    '../niceadmin/img/**'
]);

import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import '../niceadmin/vendor/bootstrap/css/bootstrap.css';

import '../niceadmin/vendor/bootstrap-icons/bootstrap-icons.css';
import '../niceadmin/vendor/boxicons/css/boxicons.css';
import '../niceadmin/vendor/remixicon/remixicon.css';

import '../niceadmin/css/style.css';
import '../css/app.css';

import { defineAsyncComponent } from 'vue'

import {createApp} from 'vue'
import pageComponent from './pages.js'

// Determine the pageName
const mountEl = document.querySelector("#app");
const pageName = ('pageName' in mountEl.dataset) ? mountEl.dataset.pageName : 'home';
const componentName = pageComponent[pageName];
createApp({
    components: {
        TargetPage: defineAsyncComponent(() =>
          import(`./pages/${componentName}.vue`)
        )
    }
}).mount("#app")
