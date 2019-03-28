<template>
  <div class="task-types">
        <div class='task-types__item' v-for='task_type in task_types'
          @click='type = task_type.type'
          :class="{'task-types__item_active': task_type.type === type}"
          :key='task_type.type'>
          <div class='task-types__title'>{{ task_type.title }}</div>
          <div class='task-types__img'>
            <component :is='Icons[task_type.type.capitalize()]'/>
          </div>
        </div>
      </div>
</template>

<script>

import * as Icons from '@/components/Icons'
import { TYPES } from './'

export default {
  components: { Icons },  

  data() {
    return {
      TYPES,
      Icons,
      task_types: [
        {
          type: TYPES.subscribe,
          title: 'Подписчики',
        },
        {
          type: TYPES.like,
          title: 'Лайки'
        },
        {
          type: TYPES.comment,
          title: 'Комментарии'
        },
      ],
      type: TYPES.like,
    }
  },

  created() {
    // чтобы установилось значение по умолчанию
    this.$emit('update:type', this.type)
  },

  watch: {
    type(newVal) {
      this.$emit('update:type', newVal)
    }
  }
}
</script>

<style lang="scss">
@import '~sass/_variables';

.task-types {
    margin-top: $spacing-5;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 5px;
    &__item {
      text-align: center;
      // border: 3px solid $grey;
      padding: 10px;
      border-radius: $border-radius;
      // margin: 0 20px;
      max-width: 250px;
      width: 25%;
      cursor: pointer;
      transition: all .2s linear;
      // &:first-child {
      //   margin-left: 0;
      // }
      // &:last-child {
      //   margin-right: 0;
      // }
      &:hover:not(.task-types__item_active) {
        background: $blue-very-light;
      }
      &_active {
        transform: scale(1.15);
        // border-color: transparent;
        // padding: 13px;
        box-shadow: 0 0 15px #FF416C;
        background: #FF416C;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to bottom, #FF4B2B, #FF416C);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to bottom, #FF4B2B, #FF416C); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        & .task-types__title {
          color: white;
        }
        & .task-types__img svg {
          opacity: 1 !important;
          fill: white !important;
        }
      }
    }
    &__title {
      margin-bottom: $spacing-1;
      color: $grey;
    }
    &__img {
      & svg {
        width: 100%;
        height: 60px;
        opacity: .5;
      }
    }
  }
</style>
