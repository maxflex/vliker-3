<template>
  <div class="bar">
    <div class="bar__controls">
      <!-- <input type="text" @input="setState('link', $event.target.value)"/> -->
      <div class='relative bar__controls__input'>
        <input type="text" v-model='link' />
        <div class="bar__controls__input__close-button opacity-hover opacity-animation" 
          :class="{'no-opacity': link.length === 0}" 
          @click="link = ''"
        >
          <ion-icon name="close"></ion-icon>
        </div>
      </div>
      <button @click="$emit('click')">накрутить</button>
    </div>
    <!-- <SelectTypeDialog v-if='dialog' /> -->
    <!-- <div class="bar__link-type opacity-animation" :class="{'no-opacity': link.length === 0}">
      <span class='text-red' v-if='type === null'>Ссылка должна быть с vk.com</span>
      <span v-else>{{ type }}</span>
    </div> -->
  </div>
</template>

<script>
// import SelectTypeDialog from '@/components/SelectTypeDialog'

// const typeRegExp = /(photo|video|wall)[-]?[0-9]+[_][0-9]+([\?]reply=[0-9]+)?/
// const vkRegExp = /^http[s]?\:\/\/[m]?[\.]?vk.com/

// const TYPES = {
//   LIKE: 'like',
//   SUBSCRIBE: 'subscribe',
//   COMMENT: 'comment',
// }

export default {
  props: {
    disabled: {
      type: Boolean,
      default: false,
    },
  },
  
  data() {
    return {
      link: '',
    }
  },

  watch: {
    link(newVal) {
      this.$emit('update:link', newVal)
    },
  },

  // computed: {
  //   type() {
  //     if (this.link.match(vkRegExp) !== null) {
  //       const result = this.link.match(typeRegExp)
  //       return (result === null ? TYPES.SUBSCRIBE : (result[2] === undefined ? TYPES.LIKE : TYPES.COMMENT))
  //     }
  //     return null
  //   }
  // },
}
</script>

<style lang="scss">
@import '~sass/_variables';

.bar {
  // max-width: 500px;
  width: 100%;
  &__controls {
    display: flex;
    &__input {
      width: 100%; 
      & input {
        width: 100%;
        outline: none;
        border : 3px solid $blue;
        box-sizing: border-box;
        flex: 1;
        padding: 8px 35px 8px 8px;
        border-right: 0;
        border-radius: 4px 0 0 4px;
      }
      &__close-button {
        position: absolute;
        right: 0;
        top: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        right: 5px;
        font-size: 28px;
      }
    }
    & button {
      background-color: $blue;
      color: white;
      border: none;
      text-transform: uppercase;
      border-left: 0;
      border-radius: 0 4px 4px 0;
    }
  }
}
</style>
