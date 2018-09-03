Nova.booting((Vue, router) => {
    Vue.component('index-nova-key-value', require('./components/IndexField'));
    Vue.component('detail-nova-key-value', require('./components/DetailField'));
    Vue.component('form-nova-key-value', require('./components/FormField'));
})
