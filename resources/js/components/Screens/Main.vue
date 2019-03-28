<template>
  <div class="main-screen">
    <div>
      <div class='main-screen__logo'>
        <img src="/img/logo.png">
      </div>
      <Bar 
        :loading='loading'
        :url.sync='task.original_url' 
        @click='start' 
        @clear='error = {}' 
      />
      <VError :item='error' />
      <TaskSelectType :type.sync='task.type' />
    </div>
  </div>
</template>

<script>

import Bar from '@/components/Bar'
import TaskSelectType from '@/components/Task/SelectType'
import { VError } from '@/components/UI'
import { API_URL as TASKS_API_URL } from '@/components/Task'
import { API_URL as USERS_API_URL } from '@/components/User'
import * as MUTATION from '@/store/mutation-types'
console.log(USERS_API_URL)
export default {
  components: { Bar, TaskSelectType, VError },

  props: {
    disabled: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      task: {
        original_url: null,
        type: null,
      },
      error: {},
      loading: false,
    }
  },

  created() {
    axios.get(apiUrl(USERS_API_URL)).then(r => {
      if (r.status === 200) {
        this.$store.commit(MUTATION.USER, r.data)
      }
    })
    axios.get(apiUrl(TASKS_API_URL, 9)).then(r => this.$store.commit(MUTATION.START, r.data))
  },
  
  methods: {
    async start() {
      console.log('%cStarting...', 'color:Turquoise')
      this.error = {}
      this.loading = true
      if (this.$store.state.user === null) {
        await axios.post(apiUrl(USERS_API_URL)).then(r => {
          this.$store.commit(MUTATION.USER, r.data)
        })
      }
      await axios.post(apiUrl(TASKS_API_URL), this.task).then(r => {
        this.$store.commit(MUTATION.START, r.data)
      }).catch(error => {
        this.error = error.response
      })
      this.loading = false
      // this.setState('started', true)
    }
  },
}
</script>

<style lang="scss">
@import '~sass/_variables';

.main-screen {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  &__logo {
    text-align: center;
    & img {
      width: 50%;
      margin-bottom: 5px;
    }
  }
}
</style>
