<template>
  <div class='blocks'>
    <Block v-for='n in 6' :key='n' />
  </div>
</template>

<script>
import Block from './Block'

export default {
  components: { Block }
}
</script>

<style lang='scss'>
.blocks {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}
</style>
