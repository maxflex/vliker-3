<template>
  <div>
    <div class='progress'>
      <div v-if='count === 0' class='text-center' style='align-self: flex-end'>
        <span>нажмите, чтобы начать накрутку</span>
        <div class='arrow-down-animated'>
          <ios-arrow-round-down-icon></ios-arrow-round-down-icon>
        </div>
      </div>
      <div class='progress' v-else>
        <HeartRed />
        <span class='progress__counter'>
          <span class='text-red' v-html='count'></span>
          накручено
        </span>
      </div>
    </div>
    <TaskItem />
  </div>
</template>

<script>
import TaskItem from './Item'
import { HeartRed } from '@/components/Icons'

export default {
  components: { TaskItem, HeartRed },
  data() {
    return {
      count: 0,
    }
  },
  
}
</script>

<style lang='scss'>

.progress {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100px;
  &__counter {
    position: relative;
    color: #828a99;
  }
  & svg {
    height: 26px;
    width: 26px;
    margin-right: 5px;
  }
}

.arrow-down-animated {
  position: relative;
  font-size: 24px;
  margin: 10px 0 5px;
  animation: arrowDown 1s infinite;
}

@keyframes arrowDown {
  0% {
    top: 0px;
  }
  50% {
    top: 10px;
  }
  100% {
    top: 0px;
  }
}
</style>