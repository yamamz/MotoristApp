<template>
  <div :class="classList">
    <slot></slot>
  </div>
</template>

<script>
export default {
  props: {
    variant: {
      type: String
    }
  },
  computed: {
    classList () {
      return [
        'callouts',
        this.calloutVariant
      ]
    },
    calloutVariant () {
      return this.variant ? `callout-${this.variant}` : ''
    }
  }
}
</script>
