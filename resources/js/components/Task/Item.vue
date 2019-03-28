<template>
  <div>
    <div class='block' @click='like($event)'>
      <Spinner color='#5275A0' v-if='loading' />
      <component v-else :is='Icons.Like' />
      <!-- <vue-star v-else ref='VueStar' animate="animated bounceIn" color="#F05654">
        <i slot="icon" class="fa fa-heart"></i>
      </vue-star> -->
    </div>
    <div class='report' v-if='!reported && completedTask !== null'>
      <a class='grey-link' @click='report'>Страница была закрыта/недоступна</a>
    </div>
  </div>
</template>

<script>
import * as Icons from '@/components/Icons'
import VueStar from 'vue-star'
import { API_URL } from '@/components/Task'

export default {
  components: { VueStar, Spinner: Icons.Spinner },
  
  data() {
    return {
      Icons,
      loading: true,
      item: null,
      completedTask: null,
      reported: false,
    }
  },

  created() {
    this.loadNext()
  },

  methods: {
    like() {
      window.open(this.item.url, '_blank')
      this.loadNext()
    },

    loadNext() {
      this.loading = true
      if (this.item !== null) {
        this.completedTask = {
          task_id_from: this.$store.state.task.id,
          task_id_to: this.item.id,
        }
      }
      axios.post(apiUrl(API_URL, 'next'), { completedTask: this.completedTask }).then(r => {
        this.item = r.data
        this.loading = false
      })
    }
  },
}
</script>

<style lang="scss">
@import '~sass/_variables';

.block {
  width: 50%;
  width: 240px;
  height: 240px;
  text-align: center;
  border: 3px solid $blue;
  margin: 10px;
  border-radius: 18px;
  display: flex;
  padding: 30px;
  box-sizing: border-box;
  opacity: .4;
  cursor: pointer;
  transition: opacity ease-in .1s;
  align-items: center;
  justify-content: center;
  font-size: 72px;
  & > * {
    pointer-events: none;
  }
  &:hover {
    opacity: 1;
  }
  & svg {
    width: 100%;
  }
}

.report {
  text-align: center;
  font-size: 12px
}
</style>
