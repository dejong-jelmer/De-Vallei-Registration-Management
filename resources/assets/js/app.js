
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

const axios = window.axios.create({
        baseURL: 'http://de_vallei.test/api/v1',
        timeout: 5000
    });




const app = new Vue({
    el: '#app',
    data: {
        statuses: false,
        uri: '/dashboard/statuses'
    },

    methods: {
        getStatuses(uri) {
            self = this
            console.log('Getting statuses:')

            axios.get(
                uri
                ).then(
                    function(response) {
                    console.log('%c  success', 'color:green')
                        
                    self.statuses = response.data;
                    }
                ).catch(
                    function(error) {
                        console.error(error)
                   }
                );    
        }
    },

    mounted: 
     function() {
        self = this
        var uri = this.uri

        console.log('Getting statuses:')
        self.getStatuses(uri)
        
        setInterval(function () {
            self.getStatuses(uri)
            
        },5000);
    }
});