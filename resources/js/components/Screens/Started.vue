<template>
  <div class='started-screen'>
    <div style='width: 100%'>
      <Bar :value='$store.state.task.url' />
    </div>
    <TaskList />
    <div class='controls'>
        <v-button>
          <ios-square-icon slot='icon'></ios-square-icon>
          <span>Завершить накрутку</span>
        </v-button>
    </div>
  </div>
</template>

<script>
// import VueOdometer from 'v-odometer/src'
import Bar from '@/components/Bar'
import TaskList from '@/components/Task/List'
import { VButton } from '@/components/UI'

export default {
  components: { Bar, TaskList, VButton },

  data() {
    return {
      likes: 0,
    }
  },
  
}
</script>


<style lang="scss" scoped>
@import '~sass/_variables';

.started-screen {
  height: 100%;
  align-items: center;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.controls {
  display: flex;
  & i {
    margin-right: 5px;
    height: 0px;
    top: -13px;
    position: relative;
  }
}
</style>

