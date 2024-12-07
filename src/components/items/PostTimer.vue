<template>


  <div class="center__content-item">
                <div class="center__content-item-top">
                   <div class="center__content-item-prediction">
                  {{ post.textDate }}
                   </div> 
                   <div class="center__content-item-timer-description"><span>дней</span><span>часов</span><span>минут</span><span>секунд</span></div>
                   <div class="center__content-item-timer" v-html="timeRemaining"></div>
                </div>
             <div class="center__content-item-title">
              <h2>{{post.title}}</h2>
             </div>  
             <div class="center__content-item-accuracy">Точность прогноза: <span>{{post.accuracy}} </span></div>
        </div>




</template>

<script lang="ts">
import { defineComponent, PropType, computed } from 'vue';
import { useTimer } from 'vue-timer-hook';

export default defineComponent({
  props: {
    post: {
      type: Object as PropType<{ id: number; title: string; event_date?: Date, textDate: string, accuracy: string }>,
      required: true
    }
  },
  setup(props) {
    const event_date = props.post.event_date;
    const { seconds, minutes, hours, days } = useTimer( event_date.getTime());

    const formatTime = (value: number) => {
      return value < 10 ? `0${value}` : value.toString();
    };


    const timeRemaining = computed(() => {
      return `<span>${formatTime(days.value)}</span> <span>${formatTime(hours.value)}</span> <span>${formatTime(minutes.value)}</span> <span>${formatTime(seconds.value)}</span>`;
    });

    return {
      timeRemaining
    };
  }
});
</script>

<style lang="scss">
.center__content-items {
   display: flex;
   flex-wrap: wrap;
   margin-top: 20px;
  //  justify-content: space-between;
}
.center__content-item {
   background-color: #161616;
   padding: 10px;
   position: relative;
   border-radius: 10px;
   min-height: 130px;
   box-shadow: 0 1px 30px rgba(255, 255, 255, .05);
   border: 1px solid #222222;

   margin-right: 30px;
   margin-bottom: 30px;
}
.center__content-item-prediction {
   color: #fff;
   font-size: 20px;
   position: relative;
   &::before {
    content: '';
    position: absolute;
    width: 100%;
    left: 0;
    top: -8px;
    background-color: #BCC121;
    height: 1px;
   }
}
.center__content-item-timer {
  display: flex;
  align-items: center;
  margin-left: 10px;
   span {
    background-color: #BCC121;
      display: flex;
      margin-right: 6px;
      width: 32px;
      // letter-spacing: 6px;
      height: 20px;
      justify-content: center;
      align-items: center;
      line-height: 1;
  // padding-left: 3px;
      font-size: 18px;
      font-weight: bold;
      // border-radius: 4px;
      position: relative;
      &:before {
        content: '';
        position: absolute;
        width: 3px;
        // background-color: rgba(0, 0, 0, 0.8);
        height: 100%;
        left: 15px;
        top: 0;
      }
   }
}
.center__content-item-title {
  margin-top: 6px;
  h2 {
    font-size: 20px;
    font-weight: 300;
    color: #fff;
    font-weight: 300;
    line-height: 23px;;
  }
}

.center__content-item-top {
  display: flex;
  position: relative;
  margin-top: 6px;
  align-items: center;
  justify-content: space-between;
}

.center__content-item-accuracy {
  position: absolute;
  bottom: 4px;
  font-size: 12px;
  color: #fff;
  span {
    color: #BCC121;
  }
 
}

.center__content-item-timer-description {
  position: absolute;
  right: -13px;
  top: -20px;
  color: #fff;

  span {
    margin-right: 5px;
    font-size: 12px;
  }
}
@media all and (max-width:768px) {
  .center__content-item {
        width: 100%;
        max-width: 100%;
    }
}


</style>