<template>

    <a
    v-if="banner!==null"
    class="panel-block__footer"
    target="_blank"
    :class="classNone"
    :href="banner.link"
  >
    <div class="panel-block__img-wrap">
      <img :src="banner.photosmall" alt />
    </div>

    <div class="panel-block__text">{{banner.description}}</div>
  </a>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "BannerBotom",
  props: {
    classNone: {
      type: String,
      default: ""
    }
  },
  computed: {
    ...mapGetters({
      banner: "firms/banner_bottom"
    })
  }
};
</script>

