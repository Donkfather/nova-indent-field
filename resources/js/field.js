Nova.booting((Vue, router, store) => {
    Vue.component('detail-indent', require('./components/DetailField'))
    Vue.component('form-indent', require('./components/FormField'))
})
