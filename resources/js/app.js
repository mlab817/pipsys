/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

import { createApp } from 'vue';

import App from './components/App.vue'
import AppComponent from './components/AppComponent.vue'

const app = createApp(App)

app.component('AppComponent', AppComponent)

app.mount("#app")
