Nova.booting((Vue, router) => {
    Vue.component('IndexNovaKeyValue', require('./components/IndexField').default);
    Vue.component('DetailNovaKeyValue', require('./components/DetailField').default);
    Vue.component('FormNovaKeyValue', require('./components/FormField').default);
})
