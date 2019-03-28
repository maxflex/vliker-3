export const GlobalPlugin = {
  install(Vue, options) {
    Vue.prototype.setState = function(field, value) {
      this.$store.commit('set', { field, value })
    }

    // Vue.component('Loader', Loader)
  }
}
