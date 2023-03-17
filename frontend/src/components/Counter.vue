<template>
  <div class="counter">
    <button class="counter-btn"
            @click="counter = counter - 1">
      -1
    </button>
    <span class="counter-value">{{ counter }}</span>
    <button class="counter-btn"
            @click="counter = counter + 5">
      +5
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const counter = ref(0);

</script>

<style lang="scss" scoped>
  .counter {
    font-size: 40px;

    &-btn {
      font-size: 40px;
      width: 60px;
    }

    &-value {
      margin: 0 20px;
    }
  }
</style>