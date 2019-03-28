import * as TYPES from './mutation-types'

export default {
  set(state, { field, value }) {
    state[field] = value
  },

  // Начать накрутку
  [TYPES.START] (state, task) {
    state.task = task
  },

  // Логин
  [TYPES.USER] (state, user) {
    state.user = user
  },

  loading(state, value) {
    state.loading = value
  }
}
