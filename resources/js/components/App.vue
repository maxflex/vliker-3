<template>
<div class='app-wrapper'>
  <MainScreen v-if='$store.state.task === null' />
  <StartedScreen v-else />
</div>
</template>

<script>
import MainScreen from '@/components/Screens/Main'
import StartedScreen from '@/components/Screens/Started'

export default {
  components: { StartedScreen, MainScreen }
}
</script>

<style lang="scss">
.app-wrapper {
  height: 100%;
  max-width: 700px;
  margin: 0 auto;
}
</style>
