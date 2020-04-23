<template>
  <div>
      <div class="row" v-if="search_firms!==null&&search_firms.length>0">
          <div v-show-slide:400:ease="detaliFirm&&firmModal!==null"
               :style="styleObject"
               class=" overflow-auto modal-comp border-dotted">
              <item v-if="firmModal!==null" :firm="firmModal" :modal="true"
                    @hiddeModal="detaliFirm=false"></item>
          </div>
          <div class="col-lg-6  wrapItemFirm " v-for="(firm,index) in search_firms">
              <div @click="showDetali(firm.id,$event)"
                   class="accordion-item border-dotted border-dotted border-dotted--block">
                  <div class="accordion-item__toggle">
                      {{firm.title}}
                  </div>
              </div>
          </div>
      </div>
      <div class="row" v-else>
          <div class="col-lg-12">
              <p class="text-warning">
                  {{$t('search_not_found')}}
              </p>
          </div>
      </div>
  </div>
</template>

<script>
    import Item from "~/components/Firm/Item.vue";
    export default {
        name: "ItemsLoop",
        components: {Item},
        data() {
            return {
                styleObject: {
                    left: '0px',
                    top: '0px'
                },
                firm_id: null,
                firmModal: null,
                detaliFirm: false
            }
        },
        props:{
            search_firms:{
                default:null
            }
        },
        methods: {
            showDetali(firm_id, event) {
                if (this.firm_id == firm_id) {
                    this.detaliFirm = false;
                    this.firm_id = null;
                    return false;
                }
                let loader = this.showLoader({
                    container: event.target,
                    loader: 'bars',
                    isFullPage: false
                });
                this.firm_id = firm_id;
                this.setPosition(event.target);
                let firm = this.$store.getters["firms/getFirmById"](this.firm_id);
                if (typeof firm == "undefined" || firm === null) {
                    this.$store.dispatch("firms/getFirm", this.firm_id).then(() => {
                        this.firmModal = this.$store.getters["firms/getFirmById"](this.firm_id);
                        this.detaliFirm = true;
                        loader.hide()
                    });
                } else {
                    this.firmModal = firm;
                    this.detaliFirm = true;
                    loader.hide()
                }
            },

            setPosition(el) {
                let $parent = $(el).parents('.wrapItemFirm');
                let position = $parent.position()
                let offset = $parent.offset()
                let height = $(el).innerHeight() + 12;
                let heigthTop = position.top + height;
                let padd = $(el).innerWidth() - $(el).width();

                let $body = $('.panel-block__body').innerHeight();
                if (heigthTop > $body / 2) {
                    this.styleObject = {
                        left: (position.left + padd / 2) + 'px',
                        bottom: height + 'px'
                    };
                } else {
                    this.styleObject = {
                        left: (position.left + padd / 2) + 'px',
                        top: heigthTop + 'px'
                    };
                }
            }
        }
    }
</script>
