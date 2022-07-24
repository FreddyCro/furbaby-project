<template>
  <div class="fk-wc">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink"
      width="224"
      height="216"
      viewBox="0 0 224 216"
    >
      <defs>
        <clipPath id="clip-path">
          <rect
            id="Rectangle_14"
            data-name="Rectangle 14"
            width="217"
            height="197"
            fill="#fff"
            stroke="rgba(0,0,0,0)"
            stroke-width="1"
          />
        </clipPath>
        <clipPath id="clip-path-2">
          <rect
            id="imageMask"
            width="277"
            height="146"
            transform="translate(970 518)"
            fill="none"
          />
        </clipPath>
        <clipPath id="clip-_224_">
          <rect width="224" height="216" />
        </clipPath>
      </defs>
      <g id="fk-wc-group" class="fk-wc-group" transform="translate(0 6)">
        <g id="_224_" data-name="224_" clip-path="url(#clip-_224_)">
          <g id="fk-wc-back-cup" transform="translate(-1007 -394)">
            <g
              id="fk-wc-emty"
              data-name="fk-wc-emty"
              transform="translate(1030 421)"
              style="isolation: isolate"
            >
              <path
                id="Path_6"
                data-name="Path 6"
                d="M0,0,17.87,23.549,30.756,169h95.712L149,0Z"
                fill="rgba(185,185,185,0.65)"
              />
            </g>
            <g
              id="fk-wc-water"
              class="fk-wc-water"
              clip-path="url(#clip-path-2)"
              :transform="redTransform"
            >
              <g id="red-2" data-name="red">
                <g id="red-3" data-name="red" transform="translate(1030 421)">
                  <path
                    id="Path_7"
                    data-name="Path 7"
                    d="M0,0,17.87,23.549,30.756,169h95.712L149,0Z"
                    fill="#cecece"
                  />
                </g>
                <path
                  id="Color_Overlay"
                  data-name="Color Overlay"
                  d="M1060.756,590l-12.885-145.452L1030,421h149l-22.533,169Z"
                  fill="#e50000"
                />
              </g>
            </g>
            <g id="fk-wc-border" transform="translate(1010 407)">
              <g id="Group_22" data-name="Group 22">
                <g
                  id="Group_21"
                  data-name="Group 21"
                  clip-path="url(#clip-path)"
                >
                  <path
                    id="Path_5"
                    data-name="Path 5"
                    d="M8.183,4.141C4.42,4.141,3,6.757,5.031,9.954L22.808,37.966a34.706,34.706,0,0,1,4.383,12.679L40.852,185.993a7.784,7.784,0,0,0,7.534,6.866H150.095a8.052,8.052,0,0,0,7.726-6.844L177.472,34.057a8.052,8.052,0,0,1,7.726-6.844h1.368a6.892,6.892,0,0,1,6.841,6.9V97.448a6.892,6.892,0,0,0,6.841,6.9h5.809a6.892,6.892,0,0,0,6.841-6.9V11.043a6.892,6.892,0,0,0-6.841-6.9Z"
                    fill="transparent"
                    stroke="#cecece"
                    stroke-miterlimit="10"
                    stroke-width="8.245"
                  />
                </g>
              </g>
            </g>
          </g>
          <g
            id="fk-wc-text-group"
            class="fk-wc-text-group"
            :transform="textTransform"
          >
            <text
              id="fk-wc-text"
              data-name="fk-wc-text"
              fill="#fff"
              font-size="18"
              font-family="SegoeUI, Segoe UI"
            >
              <tspan x="-19.191" y="0">
                <tspan v-if="textIndex === 0 || textIndex === 1" opacity="0">0</tspan>
                <tspan v-if="textIndex !== 0">{{ table[textIndex] }}</tspan>
                <tspan v-if="textIndex !== 0">%</tspan>
              </tspan>
            </text>
          </g>
        </g>
        <g
          id="fk-wc-front-cup"
          class="fk-wc-front-cup"
          data-name="224_"
          clip-path="url(#clip-_224_)"
        >
          <g transform="translate(-1006 -393)">
            <g
              data-name="fk-wc-emty"
              transform="translate(1030 421)"
              style="isolation: isolate"
            >
              <path
                id="Path_6"
                data-name="Path 6"
                d="M0,0,17.87,23.549,30.756,169h95.712L149,0Z"
                fill="transparent"
                stroke="#fff"
                stroke-miterlimit="10"
                stroke-width="6"
                stroke-linecap="round"
              />
            </g>
          </g>
        </g>
      </g>
    </svg>
  </div>
</template>

<script>
export default {
  name: 'WaterCup',
  props: {
    data: {
      type: Number,
      default: 0,
    },
    tempData: {
      type: Number,
      default: 0,
    },
  },
  data() {
    return {
      table: {
        0: '0',
        1: '5',
        2: '15',
        3: '25',
        4: '35',
      },
    };
  },
  computed: {
    textIndex() {
      return this.tempData || this.data || 0;
    },
    redTransform() {
      const count = this.tempData || this.data || 1;

      return `translate(0, ${60 - count * 10})`;
    },
    textTransform() {
      const count = this.tempData || this.data || 1;

      return `translate(105, ${60 - count * 10 + 116 || 0})`;
    },
  },
};
</script>

<style>
.fk-wc {
  display: flex;
}

.fk-wc-text-group,
.fk-wc-water {
  transition: 0.5s ease-in-out;
}

.fk-wc-front-cup {
  transform: scale(1.06, 1.03);
  transform-origin: center center;
}
</style>
