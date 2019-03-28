<template>
  <div class='text-placeholder_with-icon mt-3'>
    <span v-if="Object.keys(item).length > 0" class='text-red flex-items' >
      <ios-alert-icon class='mr-2'></ios-alert-icon>
      {{ errorText }}
    </span>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true,
    }
  },

  computed: {
    errorText() {
      return Object.values(this.item.data.errors)[0][0]
    }
  }
}
</script>
